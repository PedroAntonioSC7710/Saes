<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alumnos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    public function registro() {
        $data['titulo'] = 'Registro de Alumnos';

        $this->load->view('header/header', $data);
        $this->load->view('navegacion/navegacion');
        $this->load->view('alumnos/registro');
        $this->load->view('footer/footer');
    }

    public function lista() {
        $data['titulo'] = 'Alumnos';

        $this->load->view('alumnos/lista', $data);
    }
}