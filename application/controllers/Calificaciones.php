<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calificaciones extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Calificacion_model');
        $this->load->library(array('session', 'saes_access', 'saes_grades'));
    }

    private function mostrar($vista, $datos) {
        $this->load->view('header/header', $datos);
        $this->load->view('navegacion/navegacion');
        $this->load->view($vista, $datos);
        $this->load->view('footer/footer');
    }

    private function catalogos() {
        return array(
            'alumnos' => $this->Calificacion_model->obtener_alumnos(),
            'profesores' => $this->Calificacion_model->obtener_profesores(),
            'materias' => $this->Calificacion_model->obtener_materias(),
            'grupos' => $this->Calificacion_model->obtener_grupos()
        );
    }

    private function autorizar_profesor($id_prof) {
        if ($this->saes_access->role() === 'profesor' &&
            (int) $id_prof !== $this->saes_access->teacher()) {
            show_error('No tienes permiso para modificar calificaciones de otro profesor.', 403);
            exit;
        }
    }

    private function validar_nota($nota) {
        return is_numeric($nota) && $nota >= 0 && $nota <= 10;
    }

    private function validar_catalogos($id_prof, $id_mat, $id_grup) {
        $p = $this->db->where('id_prof', $id_prof)
            ->where('estatus_prof', 'alta')
            ->count_all_results('profesores');

        $m = $this->db->where('id_mat', $id_mat)
            ->where('estatus_mat', 'alta')
            ->count_all_results('materias');

        $g = $this->db->where('id_grup', $id_grup)
            ->where('estatus_grup', 'alta')
            ->count_all_results('grupos');

        return $p == 1 && $m == 1 && $g == 1;
    }

    private function guardar_lote($id_prof, $id_mat, $id_grup, $notas) {
        $rol = $this->saes_access->role();
        $clave = $this->saes_grades->key($id_prof, $id_mat, $id_grup);

        return $this->saes_grades->with_lock(function (&$confirmaciones) use (
            $rol, $clave, $id_prof, $id_mat, $id_grup, $notas
        ) {
            if ($rol === 'profesor' && !empty($confirmaciones[$clave])) {
                return 'confirmado';
            }

            $this->db->trans_begin();

            foreach ($notas as $id_alumn => $nota) {
                $cantidad = $this->Calificacion_model->contar_calificaciones(
                    $id_alumn, $id_prof, $id_mat, $id_grup
                );

                if ($cantidad > 1) {
                    $this->db->trans_rollback();
                    return 'duplicado';
                }

                if ($cantidad === 1) {
                    $this->Calificacion_model->actualizar(
                        $id_alumn, $id_prof, $id_mat, $id_grup, $nota
                    );
                } else {
                    $this->Calificacion_model->guardar(array(
                        'id_alumn' => $id_alumn,
                        'id_prof' => $id_prof,
                        'id_mat' => $id_mat,
                        'id_grup' => $id_grup,
                        'calif' => $nota
                    ));
                }
            }

            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
                return 'error';
            }

            $this->db->trans_commit();

            return 'ok';
        });
    }

    public function lista() {
        $this->saes_access->require_role(array('admin', 'profesor'));

        $datos['titulo'] = 'Calificaciones';
        $datos['calificaciones'] = $this->Calificacion_model->obtener_calificaciones();

        if ($this->saes_access->role() === 'profesor') {
            $id_prof = $this->saes_access->teacher();

            $datos['calificaciones'] = array_values(array_filter(
                $datos['calificaciones'],
                function ($c) use ($id_prof) {
                    return (int) $c->id_prof === $id_prof;
                }
            ));
        }

        $this->mostrar('Calificaciones/lista', $datos);
    }

    public function registro() {
        $this->saes_access->require_role(array('admin', 'profesor'));

        $datos = $this->catalogos();
        $datos['titulo'] = 'Registrar Calificación';

        if ($this->saes_access->role() === 'profesor') {
            $id_prof = $this->saes_access->teacher();

            $datos['profesores'] = array_values(array_filter(
                $datos['profesores'],
                function ($p) use ($id_prof) {
                    return (int) $p->id_prof === $id_prof;
                }
            ));
        }

        $this->mostrar('Calificaciones/registro', $datos);
    }

    public function guardar() {
        $this->saes_access->require_role(array('admin', 'profesor'));

        if ($this->input->method() !== 'post') {
            show_error('Método no permitido.', 405);
            return;
        }

        $id_alumn = (int) $this->input->post('id_alumn');
        $id_prof = (int) $this->input->post('id_prof');
        $id_mat = (int) $this->input->post('id_mat');
        $id_grup = (int) $this->input->post('id_grup');
        $nota = $this->input->post('calif');

        $this->autorizar_profesor($id_prof);

        $datos = array(
            'id_alumn' => $id_alumn,
            'id_prof' => $id_prof,
            'id_mat' => $id_mat,
            'id_grup' => $id_grup,
            'calif' => $nota
        );

        if (
            $id_alumn <= 0 ||
            $id_prof <= 0 ||
            $id_mat <= 0 ||
            $id_grup <= 0 ||
            !$this->validar_nota($nota) ||
            !$this->Calificacion_model->opciones_validas($datos)
        ) {
            show_error('Los datos no son válidos.', 400);
            return;
        }

        $resultado = $this->guardar_lote(
            $id_prof, $id_mat, $id_grup,
            array($id_alumn => $nota)
        );

        if ($resultado !== 'ok') {
            show_error('No se pudo guardar la calificación: ' . $resultado, 409);
            return;
        }

        redirect('calificaciones/lista');
    }

    public function editar($id_alumn, $id_prof, $id_mat, $id_grup) {
        $this->saes_access->require_role(array('admin', 'profesor'));
        $this->autorizar_profesor($id_prof);

        if (
            $this->saes_access->role() === 'profesor' &&
            $this->saes_grades->confirmed($id_prof, $id_mat, $id_grup)
        ) {
            show_error('Estas calificaciones ya fueron confirmadas.', 403);
            return;
        }

        $cantidad = $this->Calificacion_model->contar_calificaciones(
            $id_alumn, $id_prof, $id_mat, $id_grup
        );

        if ($cantidad !== 1) {
            show_error('No se encontró una calificación única.', 404);
            return;
        }

        $datos = $this->catalogos();
        $datos['titulo'] = 'Editar Calificación';

        $datos['calificacion'] = $this->Calificacion_model->obtener_calificacion(
            $id_alumn, $id_prof, $id_mat, $id_grup
        );

        $this->mostrar('Calificaciones/editar', $datos);
    }

    public function actualizar($id_alumn, $id_prof, $id_mat, $id_grup) {
        $this->saes_access->require_role(array('admin', 'profesor'));

        if ($this->input->method() !== 'post') {
            show_error('Método no permitido.', 405);
            return;
        }

        $this->autorizar_profesor($id_prof);

        $cantidad = $this->Calificacion_model->contar_calificaciones(
            $id_alumn, $id_prof, $id_mat, $id_grup
        );

        if ($cantidad !== 1) {
            show_error('No se encontró una calificación única.', 404);
            return;
        }

        $nota = $this->input->post('calif');

        if (!$this->validar_nota($nota)) {
            show_error('La calificación debe estar entre 0 y 10.', 400);
            return;
        }

        $resultado = $this->guardar_lote(
            $id_prof, $id_mat, $id_grup,
            array((int) $id_alumn => $nota)
        );

        if ($resultado !== 'ok') {
            show_error('No se pudo actualizar: ' . $resultado, 409);
            return;
        }

        redirect('calificaciones/lista');
    }

    public function masiva() {
        $this->saes_access->require_role(array('admin', 'profesor'));

        $datos = $this->catalogos();
        $datos['titulo'] = 'Captura Masiva';
        $datos['role'] = $this->saes_access->role();

        $datos['seleccion'] = array(
            'id_prof' => (int) $this->input->get('id_prof'),
            'id_mat' => (int) $this->input->get('id_mat'),
            'id_grup' => (int) $this->input->get('id_grup')
        );

        $datos['filas'] = array();
        $datos['confirmado'] = false;

        if ($datos['role'] === 'profesor') {
            $id_prof = $this->saes_access->teacher();

            $datos['profesores'] = array_values(array_filter(
                $datos['profesores'],
                function ($p) use ($id_prof) {
                    return (int) $p->id_prof === $id_prof;
                }
            ));

            if ($datos['seleccion']['id_prof'] === 0) {
                $datos['seleccion']['id_prof'] = $id_prof;
            }
        }

        $id_prof = $datos['seleccion']['id_prof'];
        $id_mat = $datos['seleccion']['id_mat'];
        $id_grup = $datos['seleccion']['id_grup'];

        if ($id_prof && $id_mat && $id_grup) {
            $this->autorizar_profesor($id_prof);

            if (!$this->validar_catalogos($id_prof, $id_mat, $id_grup)) {
                show_error('La selección no es válida.', 400);
                return;
            }

            $datos['confirmado'] = $this->saes_grades->confirmed(
                $id_prof, $id_mat, $id_grup
            );

            $alumnos = $this->Calificacion_model->obtener_alumnos();

            foreach ($alumnos as $alumno) {
                $alumno->calif = null;

                $cantidad = $this->Calificacion_model->contar_calificaciones(
                    $alumno->id_alumn, $id_prof, $id_mat, $id_grup
                );

                if ($cantidad > 1) {
                    show_error('Existen calificaciones duplicadas para un alumno.', 409);
                    return;
                }

                if ($cantidad === 1) {
                    $existente = $this->Calificacion_model->obtener_calificacion(
                        $alumno->id_alumn, $id_prof, $id_mat, $id_grup
                    );

                    $alumno->calif = $existente->calif;
                }

                $datos['filas'][] = $alumno;
            }
        }

        $this->mostrar('Calificaciones/masiva', $datos);
    }

    public function guardar_masiva() {
        $this->saes_access->require_role(array('admin', 'profesor'));

        if ($this->input->method() !== 'post') {
            show_error('Método no permitido.', 405);
            return;
        }

        $id_prof = (int) $this->input->post('id_prof');
        $id_mat = (int) $this->input->post('id_mat');
        $id_grup = (int) $this->input->post('id_grup');
        $notas = $this->input->post('calif');

        $this->autorizar_profesor($id_prof);

        if (
            !$this->validar_catalogos($id_prof, $id_mat, $id_grup) ||
            !is_array($notas) ||
            empty($notas)
        ) {
            show_error('Los datos recibidos no son válidos.', 400);
            return;
        }

        $alumnos = $this->Calificacion_model->obtener_alumnos();
        $permitidos = array();

        foreach ($alumnos as $alumno) {
            $permitidos[(int) $alumno->id_alumn] = true;
        }

        foreach ($notas as $id_alumn => $nota) {
            if (
                !ctype_digit((string) $id_alumn) ||
                !isset($permitidos[(int) $id_alumn]) ||
                !$this->validar_nota($nota)
            ) {
                show_error('Hay alumnos o calificaciones no válidos.', 400);
                return;
            }
        }

        $resultado = $this->guardar_lote(
            $id_prof, $id_mat, $id_grup, $notas
        );

        if ($resultado !== 'ok') {
            show_error('No se pudieron guardar las calificaciones: ' . $resultado, 409);
            return;
        }

        redirect(
            'calificaciones/masiva?id_prof=' . $id_prof .
            '&id_mat=' . $id_mat .
            '&id_grup=' . $id_grup
        );
    }

    public function confirmar_masiva() {
    $this->saes_access->require_role(array('admin', 'profesor'));

    if ($this->input->method() !== 'post') {
        show_error('Método no permitido.', 405);
        return;
    }

    $id_prof = (int) $this->input->post('id_prof');
    $id_mat = (int) $this->input->post('id_mat');
    $id_grup = (int) $this->input->post('id_grup');

    $this->autorizar_profesor($id_prof);

    if (!$this->validar_catalogos($id_prof, $id_mat, $id_grup)) {
        show_error('La selección no es válida.', 400);
        return;
    }

    $alumnos = $this->Calificacion_model->obtener_alumnos();

    if (empty($alumnos)) {
        show_error('No hay alumnos disponibles para confirmar.', 400);
        return;
    }

    foreach ($alumnos as $alumno) {
        $cantidad = $this->Calificacion_model->contar_calificaciones(
            $alumno->id_alumn,
            $id_prof,
            $id_mat,
            $id_grup
        );

        if ($cantidad !== 1) {
            show_error(
                'No se puede confirmar. Hay alumnos sin calificación o con registros duplicados.',
                409
            );
            return;
        }
    }

    $this->saes_grades->confirm($id_prof, $id_mat, $id_grup);

    redirect(
        'calificaciones/masiva?id_prof=' . $id_prof .
        '&id_mat=' . $id_mat .
        '&id_grup=' . $id_grup
    );
}

    public function exportar_excel() {
        $this->saes_access->require_role(array('admin'));

        $calificaciones = $this->Calificacion_model->obtener_calificaciones();

        header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
        header('Content-Disposition: attachment; filename=Calificaciones_SAES.xls');

        echo "\xEF\xBB\xBF";
        echo '<table border="1">';
        echo '<tr><th>Matricula</th><th>Alumno</th><th>Profesor</th><th>Materia</th><th>Grupo</th><th>Calificacion</th></tr>';

        foreach ($calificaciones as $c) {
            echo '<tr>';
            echo '<td>' . html_escape($c->matricula_al) . '</td>';
            echo '<td>' . html_escape($c->nombre_al . ' ' . $c->apaterno_al . ' ' . $c->amaterno_al) . '</td>';
            echo '<td>' . html_escape($c->nombre_prof . ' ' . $c->apellidop_prof . ' ' . $c->apellidom_prof) . '</td>';
            echo '<td>' . html_escape($c->descripcion_mat) . '</td>';
            echo '<td>' . html_escape($c->descripcion_grup) . '</td>';
            echo '<td>' . html_escape($c->calif) . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    }
}