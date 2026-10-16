<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index() {

        $data['titulo'] = 'SAES - Inicio';

        $this->load->view('header/header', $data);
        $this->load->view('navegacion/navegacion');
        $this->load->view('inicio/inicio');
        $this->load->view('footer/footer');
    }
}