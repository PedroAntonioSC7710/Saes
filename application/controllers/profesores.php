<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profesores extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->model('Profesor_model');
    }


    // MOSTRAR LISTA DE PROFESORES
    public function lista() {

        $data['titulo'] = 'Profesores';
        $data['profesores'] = $this->Profesor_model->obtener_profesores();

        $this->load->view('Profesores/lista', $data);
    }


    // MOSTRAR FORMULARIO DE REGISTRO
    public function registro() {

        $data['titulo'] = 'Registro de Profesores';

        $this->load->view('header/header', $data);
        $this->load->view('navegacion/navegacion');
        $this->load->view('Profesores/registro');
        $this->load->view('footer/footer');
    }


    // GUARDAR NUEVO PROFESOR
    public function guardar() {

        $datos = array(
            'nocontrol_prof' => $this->input->post('nocontrol_prof'),
            'nombre_prof'    => $this->input->post('nombre_prof'),
            'apellidop_prof' => $this->input->post('apellidop_prof'),
            'apellidom_prof' => $this->input->post('apellidom_prof'),
            'tel_prof'       => $this->input->post('tel_prof'),
            'dom_prof'       => $this->input->post('dom_prof'),
            'estatus_prof'   => $this->input->post('estatus_prof')
        );

        $this->Profesor_model->guardar($datos);

        redirect('profesores/lista');
    }


    // MOSTRAR FORMULARIO PARA EDITAR
    public function editar($id) {

        $data['titulo'] = 'Editar Profesor';
        $data['profesor'] = $this->Profesor_model->obtener_profesor($id);

        $this->load->view('header/header', $data);
        $this->load->view('navegacion/navegacion');
        $this->load->view('Profesores/editar', $data);
        $this->load->view('footer/footer');
    }


    // ACTUALIZAR PROFESOR
    public function actualizar($id) {

        $datos = array(
            'nocontrol_prof' => $this->input->post('nocontrol_prof'),
            'nombre_prof'    => $this->input->post('nombre_prof'),
            'apellidop_prof' => $this->input->post('apellidop_prof'),
            'apellidom_prof' => $this->input->post('apellidom_prof'),
            'tel_prof'       => $this->input->post('tel_prof'),
            'dom_prof'       => $this->input->post('dom_prof'),
            'estatus_prof'   => $this->input->post('estatus_prof')
        );

        $this->Profesor_model->actualizar($id, $datos);

        redirect('profesores/lista');
    }


    // EXPORTAR PROFESORES A EXCEL
    public function exportar_excel() {

        $profesores = $this->Profesor_model->obtener_profesores();

        header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
        header("Content-Disposition: attachment; filename=Profesores_SAES.xls");
        header("Pragma: no-cache");
        header("Expires: 0");

        echo "\xEF\xBB\xBF";

        echo '<table border="1">';

        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>No. Control</th>';
        echo '<th>Nombre</th>';
        echo '<th>Apellido Paterno</th>';
        echo '<th>Apellido Materno</th>';
        echo '<th>Telefono</th>';
        echo '<th>Domicilio</th>';
        echo '<th>Estatus</th>';
        echo '</tr>';

        foreach ($profesores as $profesor) {

            echo '<tr>';

            echo '<td>' . $profesor->id_prof . '</td>';
            echo '<td>' . $profesor->nocontrol_prof . '</td>';
            echo '<td>' . $profesor->nombre_prof . '</td>';
            echo '<td>' . $profesor->apellidop_prof . '</td>';
            echo '<td>' . $profesor->apellidom_prof . '</td>';
            echo '<td>' . $profesor->tel_prof . '</td>';
            echo '<td>' . $profesor->dom_prof . '</td>';
            echo '<td>' . $profesor->estatus_prof . '</td>';

            echo '</tr>';
        }

        echo '</table>';
    }


    // ELIMINAR PROFESOR
    public function eliminar($id) {

        $this->Profesor_model->eliminar($id);

        redirect('profesores/lista');
    }
}