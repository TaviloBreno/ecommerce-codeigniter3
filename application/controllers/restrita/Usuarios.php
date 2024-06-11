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
			'titulo' => 'Usuários cadastrados',
			'styles' => [
				'bundles/datatables/datatables.min.css',
				'bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css',
			],
			'scripts' => [
				'bundles/datatables/datatables.min.js',
				'bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
				'bundles/jquery-ui/jquery-ui.min.js',
				'js/page/datatables.js',
			],
		];

		$this->load->view('restrita/layout/header', $data);
		$this->load->view('restrita/usuarios/index');
		$this->load->view('restrita/layout/footer');
	}

	public function core($usuarioId = null)
	{
		if (!$usuarioId) {
			// Cadastrando
			$data = [
				'titulo' => 'Cadastrar usuário',
			];

			$this->load->view('restrita/layout/header', $data);
			$this->load->view('restrita/usuarios/core');
			$this->load->view('restrita/layout/footer');
		} else {
			if (!$usuario = $this->ion_auth->user($usuarioId)->row()) {
				$this->session->set_flashdata('erro', 'Usuário não encontrado');
				redirect('restrita/usuarios');
			} else {
				$data = [
					'titulo' => 'Atualizar usuário',
					'usuario' => $usuario,
				];

				$this->load->view('restrita/layout/header', $data);
				$this->load->view('restrita/usuarios/core');
				$this->load->view('restrita/layout/footer');
			}
		}
	}
}
