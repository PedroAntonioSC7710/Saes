<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index()
    {
        $data['titulo'] = 'Registro de Alumnos';

        // Carga las vistas en orden desde application/views/
        $this->load->view('header/header', $data);
        $this->load->view('navegacion/navegacion');
        $this->load->view('alumnos/registro');
        $this->load->view('footer/footer');
    }
}
