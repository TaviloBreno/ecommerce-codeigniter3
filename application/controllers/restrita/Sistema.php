<?php
defined('BASEPATH') or exit('Ação não permitida');

class Sistema extends CI_Controller
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
		$this->form_validation->set_rules('sistema_razao_social', 'Razão Social', 'trim|required|min_length[5]|max_length[145]');
		$this->form_validation->set_rules('sistema_nome_fantasia', 'Nome Fantasia', 'trim|required|min_length[5]|max_length[145]');
		$this->form_validation->set_rules('sistema_cnpj', 'CNPJ', 'trim|required|exact_length[18]');
		$this->form_validation->set_rules('sistema_ie', 'Inscrição Estadual', 'trim|required|min_length[5]|max_length[25]');
		$this->form_validation->set_rules('sistema_telefone_fixo', 'Telefone Fixo', 'trim|required|min_length[14]|max_length[15]');
		$this->form_validation->set_rules('sistema_telefone_movel', 'Celular', 'trim|required|min_length[14]|max_length[15]');
		$this->form_validation->set_rules('sistema_cep', 'CEP', 'trim|required|exact_length[9]');
		$this->form_validation->set_rules('sistema_endereco', 'Endereço', 'trim|required|min_length[5]|max_length[145]');
		$this->form_validation->set_rules('sistema_numero', 'Número', 'trim|required|max_length[25]');
		$this->form_validation->set_rules('sistema_cidade', 'Cidade', 'trim|required|min_length[4]|max_length[50]');
		$this->form_validation->set_rules('sistema_estado', 'Estado', 'trim|required|exact_length[2]');
		$this->form_validation->set_rules('sistema_site_url', 'URL do Site', 'trim|required|valid_url');
		$this->form_validation->set_rules('sistema_email', 'E-mail de contato', 'trim|required|valid_email');
		$this->form_validation->set_rules('sistema_produtos_destaques', 'Produtos em destaque', 'trim|required|integer');

		if($this->form_validation->run()){
			$data = elements(
				array(
					'sistema_razao_social',
					'sistema_nome_fantasia',
					'sistema_cnpj',
					'sistema_ie',
					'sistema_telefone_fixo',
					'sistema_telefone_movel',
					'sistema_cep',
					'sistema_endereco',
					'sistema_numero',
					'sistema_cidade',
					'sistema_estado',
					'sistema_site_url',
					'sistema_email',
					'sistema_produtos_destaques',
				),
				$this->input->post()
			);

			$data = html_escape($data);

			$this->core_model->update('sistema', $data, array('sistema_id' => 1));
			redirect('restrita/sistema');
		}

		$data = array(
			'titulo' => 'Editar informações do sistema',
			'scripts' => array(
				'mask/jquery.mask.min.js',
				'mask/custom.js',
			),
			'sistema' => $this->core_model->get_by_id('sistema', array('sistema_id' => 1)),
		);

		$this->load->view('restrita/layout/header', $data);
		$this->load->view('restrita/sistema/index');
		$this->load->view('restrita/layout/footer');
	}

	public function correios()
	{
		$this->form_validation->set_rules('config_cep_origem', 'CEP de origem', 'trim|required|exact_length[9]');
		$this->form_validation->set_rules('config_codigo_pac', 'Código PAC', 'trim|required|exact_length[5]');
		$this->form_validation->set_rules('config_codigo_sedex', 'Código SEDEX', 'trim|required|exact_length[5]');
		$this->form_validation->set_rules('config_somar_frete', 'Valor a somar no frete', 'trim|required');
		$this->form_validation->set_rules('config_valor_declarado', 'Valor declarado', 'trim|required');

		if($this->form_validation->run()){
			$data = elements(
				array(
					'config_cep_origem',
					'config_codigo_pac',
					'config_codigo_sedex',
					'config_somar_frete',
					'config_valor_declarado',
				),
				$this->input->post()
			);

			$data['config_somar_frete'] = str_replace(',', '', $data['config_somar_frete']);
			$data['config_valor_declarado'] = str_replace(',', '', $data['config_valor_declarado']);

			$data = html_escape($data);

			$this->core_model->update('config_correios', $data, array('config_id' => 1));
			redirect('restrita/sistema/correios');
		}else{
			$data = array(
				'titulo' => 'Configurações dos Correios',
				'scripts' => array(
					'mask/jquery.mask.min.js',
					'mask/custom.js',
				),
				'correios' => $this->core_model->get_by_id('config_correios', array('config_id' => 1)),
			);

			$this->load->view('restrita/layout/header', $data);
			$this->load->view('restrita/sistema/correios');
			$this->load->view('restrita/layout/footer');
		}
	}
}
