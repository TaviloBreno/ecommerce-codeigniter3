<?php
defined('BASEPATH') or exit('Ação não permitida');

class Usuarios extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data = array(
			'titulo' => 'Usuários Cadastrados',
			'usuarios' => $this->ion_auth->users()->result(),
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
		);

		$this->load->view('restrita/layout/header', $data);
		$this->load->view('restrita/usuarios/index');
		$this->load->view('restrita/layout/footer');
	}

	public function core($ususario_id = null)
	{
		if(!$ususario_id){
			// Cadastrando
			$this->form_validation->set_rules('first_name', 'Nome', 'trim|required');
			$this->form_validation->set_rules('last_name', 'Sobrenome', 'trim|required');
			$this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email|is_unique[users.email]');
			$this->form_validation->set_rules('username', 'Usuário', 'trim|required|is_unique[users.username]');
			$this->form_validation->set_rules('password', 'Senha', 'required|min_length[6]');
			$this->form_validation->set_rules('confirmacao', 'Confirmação de senha', 'required|matches[password]');

			if($this->form_validation->run()){
				$data = array(
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'email' => $this->input->post('email'),
					'username' => $this->input->post('username'),
					'password' => $this->input->post('password'),
					'ativo' => $this->input->post('ativo'),
				);

				$data['password'] = $this->ion_auth->hash_password($data['password']);
				$data = $this->security->xss_clean($data);

				$this->ion_auth->register($data);
			} else {
				$data = array(
					'titulo' => 'Cadastrar usuário',
				);

				$this->load->view('restrita/layout/header', $data);
				$this->load->view('restrita/usuarios/core');
				$this->load->view('restrita/layout/footer');
			}
		} else {
			// Editando
			if(!$usuario = $this->ion_auth->user($ususario_id)->row()){
				$this->session->set_flashdata('erro', 'Usuário não encontrado');
				redirect('restrita/usuarios');
			} else {
				$this->form_validation->set_rules('first_name', 'Nome', 'trim|required');
				$this->form_validation->set_rules('last_name', 'Sobrenome', 'trim|required');
				$this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email|callback_valida_email');
				$this->form_validation->set_rules('username', 'Usuário', 'trim|required|callback_valida_username');
				$this->form_validation->set_rules('password', 'Senha', 'min_length[6]');
				$this->form_validation->set_rules('password_confirm', 'Confirmação de senha', 'matches[password]');

				if($this->form_validation->run()){
					$data = array(
						'first_name' => $this->input->post('first_name'),
						'last_name' => $this->input->post('last_name'),
						'email' => $this->input->post('email'),
						'username' => $this->input->post('username'),
						'password' => $this->input->post('password'),
						'active' => $this->input->post('ativo'),
					);

					$data = $this->security->xss_clean($data);

					$password = $this->input->post('password');

					if(!$password){
						unset($data['password']);
					}

					if($this->ion_auth->update($usuario->id, $data)) {
						$perfil = $this->input->post('perfil');

						if($perfil){
							$this->ion_auth->remove_from_group(NULL, $usuario->id);
							$this->ion_auth->add_to_group($perfil, $usuario->id);
						}

						$this->session->set_flashdata('sucesso', 'Usuário atualizado com sucesso');
					}else{
						$this->session->set_flashdata('erro', 'Erro ao atualizar usuário');
					}

					redirect('restrita/usuarios');
				} else {
					$data = array(
						'titulo' => 'Editar usuário',
						'usuario' => $usuario,
						'perfil' => $this->ion_auth->get_users_groups($ususario_id)->row(),
						'grupos' => $this->ion_auth->groups()->result(),
					);

					$this->load->view('restrita/layout/header', $data);
					$this->load->view('restrita/usuarios/core');
					$this->load->view('restrita/layout/footer');
				}
			}
		}
	}

	public function valida_email($email)
	{
		$usuario_id = $this->input->post('usuario_id');

		if(!$usuario_id){
			//Cadastrando
			if($this->core_model->get_by_id('users', array('email' => $email))){
				$this->form_validation->set_message('valida_email', 'Esse e-mail já existe');
				return false;
			}else{
				return true;
			}
		}else{
			//Editando
			if($this->core_model->get_by_id('users', array('email' => $email, 'id !=' => $usuario_id))){
				$this->form_validation->set_message('valida_email', 'Esse e-mail já existe');
				return false;
			}else{
				return true;
			}
		}
	}

	public function valida_username($username)
	{
		$usuario_id = $this->input->post('usuario_id');

		if(!$usuario_id){
			//Cadastrando
			if($this->core_model->get_by_id('users', array('username' => $username))){
				$this->form_validation->set_message('valida_username', 'Esse usuário já existe');
				return false;
			}else{
				return true;
			}
		}else{
			//Editando
			if($this->core_model->get_by_id('users', array('username' => $username, 'id !=' => $usuario_id))){
				$this->form_validation->set_message('valida_username', 'Esse usuário já existe');
				return false;
			}else{
				return true;
			}
		}
	}
}
