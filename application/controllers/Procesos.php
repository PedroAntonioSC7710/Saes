<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Procesos extends CI_Controller {

    private $modulos = array(
    'asignmat' => array(
        'titulo' => 'Asignación de materias',
        'pk' => 'id_asignmat',
        'campos' => array(
            'id_mat' => 'Materia',
            'id_alumn' => 'Alumno',
            'id_prof' => 'Profesor'
        )
    ),
    'inscripciongrup' => array(
        'titulo' => 'Inscripción a grupos',
        'pk' => 'id_insg',
        'campos' => array(
            'id_grupo' => 'Grupo',
            'id_alumno' => 'Alumno',
            'estatus_insg' => 'Estatus'
        )
    ),
    'unidad' => array(
        'titulo' => 'Unidades',
        'pk' => 'id_unidad',
        'campos' => array(
            'descripcion_uni' => 'Unidad'
        )
    ),
    'captcal' => array(
        'titulo' => 'Captura de calificaciones por unidad',
        'pk' => 'id_captcal',
        'campos' => array(
            'id_alumn' => 'Alumno',
            'id_mat' => 'Materia',
            'id_unidad' => 'Unidad',
            'id_prof' => 'Profesor',
            'calif' => 'Calificación'
        )
    )
);

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('url', 'form'));
    }

    private function configurar($tabla) {
        if (!isset($this->modulos[$tabla])) {
            show_404();
        }

        return $this->modulos[$tabla];
    }

    private function opciones() {
        $opciones = array();

        $configuracion = array(
            'id_alumn' => array('alumnos', 'id_alumn'),
            'id_prof' => array('profesores', 'id_prof'),
            'id_mat' => array('materias', 'id_mat'),
            'id_grupo' => array('grupos', 'id_grup'),
            'id_unidad' => array('unidad', 'id_unidad')
        );

        foreach ($configuracion as $campo => $config) {
            $opciones[$campo] = array();

            foreach ($this->db->get($config[0])->result() as $fila) {
                switch ($campo) {
                    case 'id_alumn':
                        $texto = $fila->matricula_al . ' - ' .
                            $fila->nombre_al . ' ' .
                            $fila->apaterno_al . ' ' .
                            $fila->amaterno_al;
                        break;

                    case 'id_prof':
                        $texto = $fila->nombre_prof . ' ' .
                            $fila->apellidop_prof . ' ' .
                            $fila->apellidom_prof;
                        break;

                    case 'id_mat':
                        $texto = $fila->descripcion_mat;
                        break;

                    case 'id_grupo':
                        $texto = $fila->descripcion_grup;
                        break;

                    default:
                        $texto = $fila->descripcion_uni;
                }

                $opciones[$campo][$fila->{$config[1]}] = $texto;
            }
        }

        $opciones['id_alumno'] = $opciones['id_alumn'];

        $opciones['estatus_insg'] = array(
            'alta' => 'Alta',
            'baja' => 'Baja'
        );

        return $opciones;
    }

    private function mostrar($tabla, $registro = NULL, $error = '') {
        $config = $this->configurar($tabla);

        $data = array(
            'titulo' => $config['titulo'],
            'tabla' => $tabla,
            'config' => $config,
            'registro' => $registro,
            'error' => $error,
            'opciones' => $this->opciones(),
            'registros' => $this->db
                ->order_by($config['pk'], 'DESC')
                ->get($tabla)
                ->result()
        );

        $this->load->view('header/header', $data);
        $this->load->view('navegacion/navegacion');
        $this->load->view('procesos/panel', $data);
        $this->load->view('footer/footer');
    }

    public function registro($tabla) {
        $this->mostrar($tabla);
    }

    public function lista($tabla) {
        $this->mostrar($tabla);
    }

    public function editar($tabla, $id) {
        $config = $this->configurar($tabla);

        $registro = $this->db
            ->get_where($tabla, array($config['pk'] => (int) $id))
            ->row();

        if (!$registro) {
            show_404();
        }

        $this->mostrar($tabla, $registro);
    }

    public function guardar($tabla, $id = NULL) {
        if ($this->input->method() !== 'post') {
            show_error('Método no permitido.', 405);
            return;
        }

        $config = $this->configurar($tabla);
        $datos = array();
        $opciones = $this->opciones();

        if ($id !== NULL) {
            $existente = $this->db
                ->get_where($tabla, array($config['pk'] => (int) $id))
                ->row();

        if (!$existente) {
            show_404();
            return;
        }
            }

        foreach ($config['campos'] as $campo => $etiqueta) {
            $valor = $this->input->post($campo);

        if (!is_string($valor)) {
            show_error('Valor inválido para ' . $etiqueta . '.', 400);
            return;
        }

        $valor = trim($valor);

        if ($valor === '') {
            show_error('Completa el campo ' . $etiqueta . '.', 400);
            return;
        }

        if ($campo === 'calif') {
            if (
                !preg_match('/^\d{1,3}(\.\d{1,2})?$/D', $valor) ||
                (float) $valor < 0 ||
                (float) $valor > 100
            ) {
                show_error(
                    'La calificación debe estar entre 0 y 100 y tener máximo 2 decimales.',
                    400
                );
                return;
            }

            $valor = number_format((float) $valor, 2, '.', '');
        } elseif ($campo === 'descripcion_uni') {
            if (mb_strlen($valor, 'UTF-8') > 2) {
                show_error('La unidad admite un máximo de 2 caracteres.', 400);
                return;
            }
        } else {
            if (!isset($opciones[$campo][$valor])) {
                show_error(
                    'Selecciona una opción válida para ' . $etiqueta . '.',
                    400
                );
                return;
            }
        }

        $datos[$campo] = $valor;
    }

    $duplicado = $datos;

    if ($tabla === 'inscripciongrup') {
        unset($duplicado['estatus_insg']);
    }

    if ($tabla === 'captcal') {
        unset($duplicado['calif']);
    }

    $this->db->where($duplicado);

    if ($id !== NULL) {
        $this->db->where($config['pk'] . ' !=', (int) $id);
    }

    if ($this->db->count_all_results($tabla) > 0) {
        $registro = (object) $datos;

        if ($id !== NULL) {
            $registro->{$config['pk']} = (int) $id;
        }

        $this->mostrar(
            $tabla,
            $registro,
            'Este registro ya existe. Utiliza Editar para modificarlo.'
        );
        return;
    }

    if ($id === NULL) {
        $guardado = $this->db->insert($tabla, $datos);
    } else {
        $guardado = $this->db
            ->where($config['pk'], (int) $id)
            ->update($tabla, $datos);
    }

    if (!$guardado) {
        show_error('No se pudo guardar el registro.', 500);
        return;
    }

    redirect('procesos/lista/' . $tabla);
    }

    public function eliminar($tabla, $id) {
        if ($this->input->method() !== 'post') {
            show_error('Método no permitido.', 405);
            return;
        }

        $config = $this->configurar($tabla);
        $id = (int) $id;

        $registro = $this->db
            ->get_where($tabla, array($config['pk'] => $id))
            ->row();

        if (!$registro) {
            show_404();
        }

        if ($tabla === 'inscripciongrup') {
            $this->db
                ->where($config['pk'], $id)
                ->update($tabla, array('estatus_insg' => 'baja'));
        } else {
            if ($tabla === 'unidad') {
                $usos = $this->db
                    ->where('id_unidad', $id)
                    ->count_all_results('captcal');

                if ($usos > 0) {
                    $this->mostrar(
                        $tabla,
                        NULL,
                        'La unidad tiene capturas registradas y no se puede eliminar.'
                    );
                    return;
                }
            }

            $this->db
                ->where($config['pk'], $id)
                ->delete($tabla);
        }

        redirect('procesos/lista/' . $tabla);
    }
}