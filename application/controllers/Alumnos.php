<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alumnos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    public function registro() {
        $data['titulo'] = 'Registro de Alumnos';

        // Cargas tus 3 vistas base + la vista del formulario
        $this->load->view('header/header', $data);       // Si está dentro de la carpeta header
        $this->load->view('navegacion/navegacion');   // Si está dentro de la carpeta navegacion
        $this->load->view('alumnos/registro');        // Formulario de registro
        $this->load->view('footer/footer');           // Si está dentro de la carpeta footer
    }
}