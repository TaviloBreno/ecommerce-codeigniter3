<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Usuarios extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data = [
			'usuarios' => $this->ion_auth->users()->result(),
		];

		$this->load->view('restrita/layout/header');
		$this->load->view('restrita/usuarios/index');
		$this->load->view('restrita/layout/footer');
	}
}
