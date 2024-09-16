<?php
defined('BASEPATH') or exit('Ação não permitida');

class Master extends CI_Controller
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
			'titulo' => 'Categorias pai cadastradas',
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
			'master' => $this->core_model->get_all('categorias_pai'),
		);

		$this->load->view('restrita/layout/header', $data);
		$this->load->view('restrita/master/index');
		$this->load->view('restrita/layout/footer');
	}

}
