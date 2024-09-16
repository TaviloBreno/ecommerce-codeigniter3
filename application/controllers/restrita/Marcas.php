<?php
defined('BASEPATH') or exit('Ação não permitida');

class Marcas extends CI_Controller
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
			'titulo' => 'Marcas cadastradas',
			'styles' => array(
				'assets/bundles/datatables/datatables.min.css',
				'assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css',
			),
			'scripts' => array(
				'assets/bundles/datatables/datatables.min.js',
				'assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
				'assets/bundles/jquery-ui/jquery-ui.min.js',
				'assets/js/page/datatables.js',
			),
			'marcas' => $this->core_model->get_all('marcas'),
		);

		$this->load->view('restrita/layout/header', $data);
		$this->load->view('restrita/marcas/index');
		$this->load->view('restrita/layout/footer');
	}

}
