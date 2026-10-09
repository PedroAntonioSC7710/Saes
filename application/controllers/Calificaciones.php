<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calificaciones extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Calificacion_model');
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

    private function datos_formulario() {
        return array(
            'id_alumn' => (int) $this->input->post('id_alumn'),
            'id_prof' => (int) $this->input->post('id_prof'),
            'id_mat' => (int) $this->input->post('id_mat'),
            'id_grup' => (int) $this->input->post('id_grup'),
            'calif' => $this->input->post('calif')
        );
    }

    private function validar($datos) {
        if (
            $datos['id_alumn'] <= 0 ||
            $datos['id_prof'] <= 0 ||
            $datos['id_mat'] <= 0 ||
            $datos['id_grup'] <= 0 ||
            !is_numeric($datos['calif'])
        ) {
            return false;
        }

        if ($datos['calif'] < 0 || $datos['calif'] > 10) {
            return false;
        }

        return $this->Calificacion_model->opciones_validas($datos);
    }

    public function lista() {
        $datos['titulo'] = 'Calificaciones';
        $datos['calificaciones'] = $this->Calificacion_model->obtener_calificaciones();

        $this->mostrar('Calificaciones/lista', $datos);
    }

    public function registro() {
        $datos = $this->catalogos();
        $datos['titulo'] = 'Registro de Calificaciones';

        $this->mostrar('Calificaciones/registro', $datos);
    }

    public function guardar() {
        $datos = $this->datos_formulario();

        if (!$this->validar($datos)) {
            show_error('Verifica los datos de la calificación.', 400);
            return;
        }

        $cantidad = $this->Calificacion_model->contar_calificaciones(
            $datos['id_alumn'],
            $datos['id_prof'],
            $datos['id_mat'],
            $datos['id_grup']
        );

        if ($cantidad > 0) {
            show_error('Ya existe una calificación para esta combinación de alumno, profesor, materia y grupo.', 409);
            return;
        }

        if (!$this->Calificacion_model->guardar($datos)) {
            show_error('No se pudo guardar la calificación.', 500);
            return;
        }

        redirect('calificaciones/lista');
    }

    public function editar($id_alumn, $id_prof, $id_mat, $id_grup) {
        $cantidad = $this->Calificacion_model->contar_calificaciones(
            $id_alumn, $id_prof, $id_mat, $id_grup
        );

        if ($cantidad != 1) {
            show_error('No se encontró una calificación única para editar.', 404);
            return;
        }

        $datos = $this->catalogos();

        $datos['calificacion'] = $this->Calificacion_model->obtener_calificacion(
            $id_alumn, $id_prof, $id_mat, $id_grup
        );

        $datos['titulo'] = 'Editar Calificación';

        $this->mostrar('Calificaciones/editar', $datos);
    }

    public function actualizar($id_alumn, $id_prof, $id_mat, $id_grup) {
        $cantidad = $this->Calificacion_model->contar_calificaciones(
            $id_alumn, $id_prof, $id_mat, $id_grup
        );

        if ($cantidad != 1) {
            show_error('No se encontró una calificación única para actualizar.', 404);
            return;
        }

        $calif = $this->input->post('calif');

        if (!is_numeric($calif) || $calif < 0 || $calif > 10) {
            show_error('La calificación debe estar entre 0 y 10.', 400);
            return;
        }

        if (!$this->Calificacion_model->actualizar(
            $id_alumn, $id_prof, $id_mat, $id_grup, $calif
        )) {
            show_error('No se pudo actualizar la calificación.', 500);
            return;
        }

        redirect('calificaciones/lista');
    }

    public function exportar_excel() {
        $calificaciones = $this->Calificacion_model->obtener_calificaciones();

        header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
        header('Content-Disposition: attachment; filename=Calificaciones_SAES.xls');
        header('Pragma: no-cache');
        header('Expires: 0');

        echo "\xEF\xBB\xBF";
        echo '<table border="1">';
        echo '<tr><th>Matricula</th><th>Alumno</th><th>Profesor</th><th>Materia</th><th>Grupo</th><th>Calificacion</th></tr>';

        foreach ($calificaciones as $c) {
            $alumno = $c->nombre_al . ' ' . $c->apaterno_al . ' ' . $c->amaterno_al;
            $profesor = $c->nombre_prof . ' ' . $c->apellidop_prof . ' ' . $c->apellidom_prof;

            echo '<tr>';
            echo '<td>' . html_escape($c->matricula_al) . '</td>';
            echo '<td>' . html_escape($alumno) . '</td>';
            echo '<td>' . html_escape($profesor) . '</td>';
            echo '<td>' . html_escape($c->descripcion_mat) . '</td>';
            echo '<td>' . html_escape($c->descripcion_grup) . '</td>';
            echo '<td>' . html_escape($c->calif) . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    }
}