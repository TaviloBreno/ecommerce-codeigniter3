<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Login extends CI_Controller{
	public function index()
	{
		$data = array(
			'titulo' => 'Login na área restrita',
		);

		$this->load->view('restrita/layout/header', $data);
		$this->load->view('restrita/login/index');
		$this->load->view('restrita/layout/footer');
	}

	public function auth()
	{
		$identity = $this->input->post('email');
		$password = $this->input->post('password');
		$remember = ($this->input->post('remember') == 'on' ? TRUE : FALSE);


		if($this->ion_auth->login($identity, $password, $remember)){
			$this->session->set_flashdata('sucesso', 'Seja bem-vindo(a)!');
			redirect('restrita');
		}else{
			$this->session->set_flashdata('erro', 'E-mail ou senha inválidos');
			redirect('restrita/login');
		}
	}

	public function logout()
	{
		$this->ion_auth->logout();
		redirect('restrita/login');
	}
}
