<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Materias extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->model('Materia_model');
    }

    public function lista() {
        $data['titulo'] = 'Materias';
        $data['materias'] = $this->Materia_model->obtener_materias();

        $this->load->view('header/header', $data);
        $this->load->view('navegacion/navegacion');
        $this->load->view('Materias/lista', $data);
        $this->load->view('footer/footer');
    }

    public function registro() {

        $data['titulo'] = 'Registro de Materias';

        $this->load->view('header/header', $data);
        $this->load->view('navegacion/navegacion');
        $this->load->view('Materias/registro');
        $this->load->view('footer/footer');
    }

    public function guardar() {

        $datos = array(
            'descripcion_mat' => $this->input->post('descripcion_mat'),
            'estatus_mat' => 'alta'
        );

        $this->Materia_model->guardar($datos);

        redirect('materias/lista');
    }

    public function editar($id) {

        $data['titulo'] = 'Editar Materia';
        $data['materia'] = $this->Materia_model->obtener_materia($id);

        $this->load->view('header/header', $data);
        $this->load->view('navegacion/navegacion');
        $this->load->view('Materias/editar', $data);
        $this->load->view('footer/footer');
    }

    public function actualizar($id) {

        $datos = array(
            'descripcion_mat' => $this->input->post('descripcion_mat')
        );

        $this->Materia_model->actualizar($id, $datos);

        redirect('materias/lista');
    }

    public function exportar_excel() {

        $materias = $this->Materia_model->obtener_materias();

        header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
        header("Content-Disposition: attachment; filename=Materias_SAES.xls");
        header("Pragma: no-cache");
        header("Expires: 0");

        echo "\xEF\xBB\xBF";

        echo '<table border="1">';

        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Materia</th>';
        echo '</tr>';

        foreach ($materias as $materia) {

            echo '<tr>';

            echo '<td>' . $materia->id_mat . '</td>';
            echo '<td>' . $materia->descripcion_mat . '</td>';

            echo '</tr>';
        }

        echo '</table>';
    }

    public function eliminar($id) {

        $this->Materia_model->eliminar($id);

        redirect('materias/lista');
    }
}