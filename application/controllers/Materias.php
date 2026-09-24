<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Materias extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    public function lista() {
        $data['titulo'] = 'Materias';

        $this->load->view('materias/lista', $data);
    }
}