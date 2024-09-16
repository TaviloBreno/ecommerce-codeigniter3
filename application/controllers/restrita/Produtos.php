<?php
defined('BASEPATH') or exit('Ação não permitida');

class Produtos extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if(!$this->ion_auth->logged_in()){
			redirect('restrita/login');
		}
	}

	public function index()
	{
		$data = array(
			'titulo' => 'Produtos cadastrados',
			'styles' => array(
				'bundles/datatables/datatables.min.css',
				'bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css',
			),
			'scripts' => array(
				'bundles/datatables/datatables.min.js',
				'bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
				'bundles/jquery-ui/jquery-ui.min.js',
				'js/page/datatables.js',
			),
			'produtos' => $this->produtos_model->get_all(), // Certificar-se de que o método correto está sendo chamado
			'marcas' => $this->core_model->get_all('marcas'),
			'categorias' => $this->core_model->get_all('categorias'),
		);

		$this->load->view('restrita/layout/header', $data);
		$this->load->view('restrita/produtos/index');
		$this->load->view('restrita/layout/footer');
	}

}
