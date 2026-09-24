<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profesores extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    public function lista() {
        $data['titulo'] = 'Profesores';

        $this->load->view('Profesores/lista', $data);
    }
}