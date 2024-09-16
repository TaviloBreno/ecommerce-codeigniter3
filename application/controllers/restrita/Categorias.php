<?php
defined('BASEPATH') or exit('Ação não permitida');

class Categorias extends CI_Controller
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
			'titulo' => 'Categorias filhas cadastradas',
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
			'categorias' => $this->core_model->get_all('categorias'),
		);

		$this->load->view('restrita/layout/header', $data);
		$this->load->view('restrita/categorias/index');
		$this->load->view('restrita/layout/footer');
	}

	public function core($categoria_id = null)
	{
		$categoria_id = (int) $categoria_id;

		if(!$categoria_id){
			// Cadastrando
			$this->form_validation->set_rules('categoria_nome', 'Nome da categoria', 'trim|required|min_length[4]|max_length[45]|callback_valida_nome_categoria');
			if($this->form_validation->run()){
				$data = elements(
					array(
						'categoria_nome',
						'categoria_ativa',
					),
					$this->input->post()
				);

				$data['categoria_meta_link'] = url_amigavel($data['categoria_nome']);

				$data = html_escape($data);

				$this->core_model->insert('categorias', $data);
				redirect('restrita/categorias');
			}else{
				$data = array(
					'titulo' => 'Cadastrar categoria filha',
					'masters' => $this->core_model->get_all('categorias_pai'),
				);

				$this->load->view('restrita/layout/header', $data);
				$this->load->view('restrita/categorias/core');
				$this->load->view('restrita/layout/footer');
			}
		}else{
			if(!$this->core_model->get_by_id('categorias', array('categoria_id' => $categoria_id))){
				$this->session->set_flashdata('erro', 'Categoria não encontrada');
				redirect('restrita/categorias');
			}else{
				$this->form_validation->set_rules('categoria_nome', 'Nome da categoria', 'trim|required|min_length[4]|max_length[45]|callback_valida_nome_categoria');
				if($this->form_validation->run()){
					$data = elements(
						array(
							'categoria_nome',
							'categoria_ativa',
						),
						$this->input->post()
					);

					$data['categoria_meta_link'] = url_amigavel($data['categoria_nome']);

					$data = html_escape($data);

					$this->core_model->update('categorias', $data, array('categoria_id' => $categoria_id));
					redirect('restrita/categorias');
				}else{
					$data = array(
						'titulo' => 'Editar categoria filha',
						'categoria' => $this->core_model->get_by_id('categorias', array('categoria_id' => $categoria_id)),
						'masters' => $this->core_model->get_all('categorias_pai'),
					);

					$this->load->view('restrita/layout/header', $data);
					$this->load->view('restrita/categorias/core');
					$this->load->view('restrita/layout/footer');
				}
			}
		}
	}

	public function valida_nome_categoria($categoria_nome)
	{
		$categoria_id = $this->input->post('categoria_id');

		if(!$categoria_id){
			// Cadastrando
			if($this->core_model->get_by_id('categorias', array('categoria_nome' => $categoria_nome))){
				$this->form_validation->set_message('valida_nome_categoria', 'Essa categoria já existe');
				return false;
			}else{
				return true;
			}
		}else{
			// Editando
			if($this->core_model->get_by_id('categorias', array('categoria_nome' => $categoria_nome, 'categoria_id !=' => $categoria_id))){
				$this->form_validation->set_message('valida_nome_categoria', 'Essa categoria já existe');
				return false;
			}else{
				return true;
			}
		}
	}

	public function delete($categoria_id = null)
	{
		$categoria_id = (int) $categoria_id;

		if(!$categoria_id || !$this->core_model->get_by_id('categorias', array('categoria_id' => $categoria_id))){
			$this->session->set_flashdata('erro', 'Categoria não encontrada');
			redirect('restrita/categorias');
		}

		if($this->core_model->get_by_id('produtos', array('produto_categoria_id' => $categoria_id))){
			$this->session->set_flashdata('erro', 'Essa categoria não pode ser excluída, pois está sendo utilizada em produtos cadastrados');
			redirect('restrita/categorias');
		}

		$this->core_model->delete('categorias', array('categoria_id' => $categoria_id));
		redirect('restrita/categorias');
	}
}
