<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();

		if (!$this->ion_auth->logged_in()) {
			redirect('restrita/login');
		}
	}

	public function index() {
		$data = array(
			'titulo' => 'Página Home',
		);

		$this->load->view('restrita/layout/header', $data);
		$this->load->view('restrita/home/index');
		$this->load->view('restrita/layout/footer');
	}
}
