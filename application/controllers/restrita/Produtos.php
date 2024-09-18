<?php
defined('BASEPATH') or exit('Ação não permitida');

class Produtos extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if (!$this->ion_auth->logged_in()) {
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

	public function core($produto_id = NULL)
	{
		$produto_id = (int)$produto_id;

		if (!$produto_id) {

		} else {
			if (!$produto = $this->core_model->get_by_id('produtos', array('produto_id' => $produto_id))) {
				$this->session->set_flashdata('erro', 'Produto não encontrado');
				redirect('restrita/produtos');
			} else {
				$this->form_validation->set_rules('produto_nome', 'Nome do produto', 'trim|required|min_length[4]|max_length[145]|callback_valida_nome_produto');
				$this->form_validation->set_rules('produto_categoria_id', 'Categoria do produto', 'trim|required');
				$this->form_validation->set_rules('produto_marca_id', 'Marca do produto', 'trim|required');
				$this->form_validation->set_rules('produto_valor', 'Valor do produto', 'trim|required');
				$this->form_validation->set_rules('produto_peso', 'Peso do produto', 'trim|required|integer');
				$this->form_validation->set_rules('produto_altura', 'Altura do produto', 'trim|required|integer');
				$this->form_validation->set_rules('produto_largura', 'Largura do produto', 'trim|required|integer');
				$this->form_validation->set_rules('produto_comprimento', 'Comprimento do produto', 'trim|required|integer');
				$this->form_validation->set_rules('produto_quantidade_estoque', 'Quantidade em estoque', 'trim|required|integer');
				$this->form_validation->set_rules('produto_descricao', 'Descrição do produto', 'trim|required|min_length[4]|max_length[500]');


				if ($this->form_validation->run()) {
					$data = elements(
						array(
							'produto_nome',
							'produto_categoria_id',
							'produto_marca_id',
							'produto_valor',
							'produto_peso',
							'produto_altura',
							'produto_largura',
							'produto_comprimento',
							'produto_quantidade_estoque',
							'produto_ativo',
							'produto_descricao',
						),
						$this->input->post()
					);

					$data['produto_valor'] = str_replace(',', '', $data['produto_valor']);
					$data['produto_meta_link'] = url_amigavel($data['produto_nome']);

					$data = html_escape($data);

					$this->core_model->update('produtos', $data, array('produto_id' => $produto_id));

					$fotos_produtos = $this->input->post('fotos_produtos');
					$total_fotos = count($fotos_produtos);

					for($i = 0; $i < $total_fotos; $i++){
						$data = array(
							'foto_produto_id' => $produto_id,
							'foto_caminho' => $fotos_produtos[$i],
						);

						$this->core_model->insert('produtos_fotos', $data);
					}

					redirect('restrita/produtos');

				} else {
					$data = array(
						'titulo' => 'Editar produto',
						'styles' => array(
							'jquery-upload-file/css/uploadfile.css',
						),
						'scripts' => array(
							'sweetalert2/sweetalert2.all.min.js',
							'jquery-upload-file/js/jquery.uploadfile.min.js',
							'jquery-upload-file/js/produtos.js',
							'mask/custom.js',
						),
						'produto' => $produto,
						'fotos_produto' => $this->core_model->get_all('produtos_fotos', array('foto_produto_id' => $produto_id)),
						'categorias' => $this->core_model->get_all('categorias', array('categoria_ativa' => 1)),
						'marcas' => $this->core_model->get_all('marcas', array('marca_ativa' => 1)),
					);

					// Carregando as views de layout e conteúdo
					$this->load->view('restrita/layout/header', $data);
					$this->load->view('restrita/produtos/core');
					$this->load->view('restrita/layout/footer');
				}
			}

		}
	}

	public function valida_nome_produto($produto_nome)
	{
		$produto_id = (int) $this->input->post('produto_id');

		if (!$produto_id) {
			// Cadastrando
			if ($this->core_model->get_by_id('produtos', array('produto_nome' => $produto_nome))) {
				$this->form_validation->set_message('valida_nome_produto', 'Esse produto já existe');
				return FALSE;
			} else {
				return TRUE;
			}
		} else {
			// Editando
			if ($this->core_model->get_by_id('produtos', array('produto_nome' => $produto_nome, 'produto_id !=' => $produto_id))) {
				$this->form_validation->set_message('valida_nome_produto', 'Esse produto já existe');
				return FALSE;
			} else {
				return TRUE;
			}
		}
	}

	public function upload()
	{
		// Configurações de upload
		$config['upload_path'] = './uploads/produtos/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['max_size'] = 2048; // 2MB
		$config['max_width'] = 1000;
		$config['max_height'] = 1000;
		$config['max_filename'] = 200;
		$config['encrypt_name'] = TRUE; // Nome do arquivo criptografado
		$config['file_ext_tolower'] = TRUE; // Extensão minúscula

		// Carrega a biblioteca de upload com as configurações definidas
		$this->load->library('upload', $config);

		// Verifica se o upload foi bem-sucedido
		if ($this->upload->do_upload('foto_produto')) {
			$upload_data = $this->upload->data(); // Dados do upload

			// Resposta de sucesso
			$data = array(
				'upload_data' => $upload_data,
				'mensagem' => 'Imagem enviada com sucesso',
				'foto_caminho' => $upload_data['file_name'], // Nome do arquivo
				'erro' => 0, // Sem erro
			);

			// Configurações para redimensionamento da imagem
			$resize_config['image_library'] = 'gd2';
			$resize_config['source_image'] = './uploads/produtos/' . $upload_data['file_name']; // Caminho original
			$resize_config['new_image'] = './uploads/produtos/small/' . $upload_data['file_name']; // Caminho redimensionado
			$resize_config['maintain_ratio'] = TRUE; // Mantém a proporção da imagem
			$resize_config['width'] = 300;
			$resize_config['height'] = 300;

			// Carrega a biblioteca de manipulação de imagens
			$this->load->library('image_lib', $resize_config);

			// Tenta redimensionar a imagem
			if (!$this->image_lib->resize()) {
				// Se falhar, adiciona o erro ao array de dados
				$data['erro'] = 1;
				$data['mensagem'] = $this->image_lib->display_errors('<span class="text-danger">', '</span>');
			}

		} else {
			// Caso o upload falhe, retorna os erros
			$data = array(
				'mensagem' => $this->upload->display_errors('<span class="text-danger">', '</span>'),
				'erro' => 5, // Código de erro para falha no upload
			);
		}

		// Retorna a resposta como JSON
		echo json_encode($data);
	}


}
