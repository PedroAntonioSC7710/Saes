<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grupos extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->model('Grupo_model');
    }

    public function lista() {
        $data['titulo'] = 'Grupos';
        $data['grupos'] = $this->Grupo_model->obtener_grupos();

        $this->load->view('header/header', $data);
        $this->load->view('navegacion/navegacion');
        $this->load->view('Grupos/lista', $data);
        $this->load->view('footer/footer');
    }

    public function registro() {

        $data['titulo'] = 'Registro de Grupos';

        $this->load->view('header/header', $data);
        $this->load->view('navegacion/navegacion');
        $this->load->view('Grupos/registro');
        $this->load->view('footer/footer');
    }

    public function guardar() {

        $datos = array(
            'descripcion_grup' => $this->input->post('descripcion_grup'),
            'estatus_grup'     => $this->input->post('estatus_grup')
        );

        $this->Grupo_model->guardar($datos);

        redirect('grupos/lista');
    }

    public function editar($id) {

        $data['titulo'] = 'Editar Grupo';
        $data['grupo'] = $this->Grupo_model->obtener_grupo($id);

        $this->load->view('header/header', $data);
        $this->load->view('navegacion/navegacion');
        $this->load->view('Grupos/editar', $data);
        $this->load->view('footer/footer');
    }

    public function actualizar($id) {

        $datos = array(
            'descripcion_grup' => $this->input->post('descripcion_grup'),
            'estatus_grup'     => $this->input->post('estatus_grup')
        );

        $this->Grupo_model->actualizar($id, $datos);

        redirect('grupos/lista');
    }

    public function exportar_excel() {

        $grupos = $this->Grupo_model->obtener_grupos();

        header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
        header("Content-Disposition: attachment; filename=Grupos_SAES.xls");
        header("Pragma: no-cache");
        header("Expires: 0");

        echo "\xEF\xBB\xBF";

        echo '<table border="1">';

        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Grupo</th>';
        echo '<th>Estatus</th>';
        echo '</tr>';

        foreach ($grupos as $grupo) {

            echo '<tr>';

            echo '<td>' . $grupo->id_grup . '</td>';
            echo '<td>' . $grupo->descripcion_grup . '</td>';
            echo '<td>' . $grupo->estatus_grup . '</td>';

            echo '</tr>';
        }

        echo '</table>';
    }

    public function eliminar($id) {

        $this->Grupo_model->eliminar($id);

        redirect('grupos/lista');
    }
}