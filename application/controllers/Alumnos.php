<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alumnos extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->model('Alumno_model');
    }

    public function registro() {

        $data['titulo'] = 'Registro de Alumnos';

        $this->load->view('header/header', $data);
        $this->load->view('navegacion/navegacion');
        $this->load->view('alumnos/registro');
        $this->load->view('footer/footer');
    }

    public function guardar() {

        $datos = array(
            'nombre_al'    => $this->input->post('nombre_al'),
            'apaterno_al'  => $this->input->post('apaterno_al'),
            'amaterno_al'  => $this->input->post('amaterno_al'),
            'matricula_al' => $this->input->post('matricula_al'),
            'tel_al'       => $this->input->post('tel_al'),
            'dom_al'       => $this->input->post('dom_al'),
            'estatus_al'   => 'alta'
        );

        $this->Alumno_model->guardar_alumno($datos);

        redirect('alumnos/lista');
    }

    public function lista() {
        $data['titulo'] = 'Alumnos';
        $data['alumnos'] = $this->Alumno_model->obtener_alumnos();

        $this->load->view('header/header', $data);
        $this->load->view('navegacion/navegacion');
        $this->load->view('alumnos/lista', $data);
        $this->load->view('footer/footer');
    }

    public function editar($id) {

        $data['titulo'] = 'Editar Alumno';
        $data['alumno'] = $this->Alumno_model->obtener_alumno($id);

        $this->load->view('header/header', $data);
        $this->load->view('navegacion/navegacion');
        $this->load->view('alumnos/editar', $data);
        $this->load->view('footer/footer');
    }


    public function actualizar($id) {

        $datos = array(
            'nombre_al'    => $this->input->post('nombre_al'),
            'apaterno_al'  => $this->input->post('apaterno_al'),
            'amaterno_al'  => $this->input->post('amaterno_al'),
            'matricula_al' => $this->input->post('matricula_al'),
            'tel_al'       => $this->input->post('tel_al'),
            'dom_al'       => $this->input->post('dom_al')
        );

        $this->Alumno_model->actualizar_alumno($id, $datos);

        redirect('alumnos/lista');
    }


    public function exportar_excel() {

        $alumnos = $this->Alumno_model->obtener_alumnos();

        header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
        header("Content-Disposition: attachment; filename=Alumnos_SAES.xls");
        header("Pragma: no-cache");
        header("Expires: 0");

        echo "\xEF\xBB\xBF";

        echo '<table border="1">';

        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Matricula</th>';
        echo '<th>Nombre</th>';
        echo '<th>Apellido Paterno</th>';
        echo '<th>Apellido Materno</th>';
        echo '<th>Telefono</th>';
        echo '<th>Domicilio</th>';
        echo '</tr>';

        foreach ($alumnos as $alumno) {

            echo '<tr>';

            echo '<td>' . $alumno->id_alumn . '</td>';
            echo '<td>' . $alumno->matricula_al . '</td>';
            echo '<td>' . $alumno->nombre_al . '</td>';
            echo '<td>' . $alumno->apaterno_al . '</td>';
            echo '<td>' . $alumno->amaterno_al . '</td>';
            echo '<td>' . $alumno->tel_al . '</td>';
            echo '<td>' . $alumno->dom_al . '</td>';

            echo '</tr>';
        }

        echo '</table>';
    }


    public function eliminar($id) {

        $this->Alumno_model->eliminar_alumno($id);

        redirect('alumnos/lista');
    }
}