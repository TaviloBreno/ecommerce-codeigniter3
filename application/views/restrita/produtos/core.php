<?php
// Corrigir a abertura da tag PHP
$this->load->view('restrita/layout/navbar');
$this->load->view('restrita/layout/sidebar');
?>
<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-body">
			<!-- add content here -->

			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h4><?php echo $titulo; ?></h4>
						</div>

						<?php
						$atributos = array(
							'name' => 'form_core',
						);

						if(isset($produto)){
							$produto_id = $produto->produto_id;
						}else{
							$produto_id = '';
						} ?>

						<?php echo form_open('restrita/produtos/core/' . $produto_id, $atributos); ?>

						<div class="card-body">

							<?php if (isset($produto)): ?>
								<div class="form-row">
									<div class="col-md-12">
										<label>Meta link do produto</label>
										<input type="text" class="form-control border-0" value="<?php echo $produto->produto_meta_link; ?>" readonly>
									</div>
								</div>
							<?php endif; ?>

							<div class="form-row">
								<div class="form-group col-md-4">
									<label>Código do Produto</label>
									<input type="text" class="form-control" name="produto_codigo" value="<?php echo isset($produto) ? $produto->produto_codigo : set_value('produto_codigo'); ?>" <?php echo isset($produto) ? '' : 'readonly'; ?>>
									<?php echo form_error('produto_codigo', '<div class="text-danger">', '</div>'); ?>
								</div>

								<div class="form-group col-md-4">
									<label>Nome do Produto</label>
									<input type="text" class="form-control" name="produto_nome" value="<?php echo isset($produto) ? $produto->produto_nome : set_value('produto_nome'); ?>">
									<?php echo form_error('produto_nome', '<div class="text-danger">', '</div>'); ?>
								</div>

								<div class="form-group col-md-4">
									<label>Marcas</label>
									<select class="form-control" name="produto_marca_id">
										<option value="">Escolha uma marca</option>
										<?php foreach ($marcas as $marca): ?>
											<option value="<?php echo $marca->marca_id; ?>" <?php echo isset($produto) && $marca->marca_id == $produto->produto_marca_id ? 'selected' : ''; ?>>
												<?php echo $marca->marca_nome; ?>
											</option>
										<?php endforeach; ?>
									</select>
									<?php echo form_error('produto_marca_id', '<div class="text-danger">', '</div>'); ?>
								</div>
							</div>

							<div class="form-row">
								<div class="form-group col-md-4">
									<label>Categorias</label>
									<select class="form-control" name="produto_categoria_id">
										<option value="">Escolha uma categoria</option>
										<?php foreach ($categorias as $categoria): ?>
											<option value="<?php echo $categoria->categoria_id; ?>" <?php echo isset($produto) && $categoria->categoria_id == $produto->produto_categoria_id ? 'selected' : ''; ?>>
												<?php echo $categoria->categoria_nome; ?>
											</option>
										<?php endforeach; ?>
									</select>
									<?php echo form_error('produto_categoria_id', '<div class="text-danger">', '</div>'); ?>
								</div>

								<div class="form-group col-md-4">
									<label>Valor do Produto</label>
									<input type="text" class="form-control money2" name="produto_valor" value="<?php echo isset($produto) ? $produto->produto_valor : set_value('produto_valor'); ?>">
									<?php echo form_error('produto_valor', '<div class="text-danger">', '</div>'); ?>
								</div>

								<div class="form-group col-md-4">
									<label>Ativo</label>
									<select class="form-control" name="produto_ativo">
										<option value="0" <?php echo isset($produto) && $produto->produto_ativo == 0 ? 'selected' : ''; ?>>Não</option>
										<option value="1" <?php echo isset($produto) && $produto->produto_ativo == 1 ? 'selected' : ''; ?>>Sim</option>
									</select>
									<?php echo form_error('produto_ativo', '<div class="text-danger">', '</div>'); ?>
								</div>
							</div>

							<div class="form-row">
								<div class="form-group col-md-6">
									<label>Peso do produto</label>
									<input type="text" class="form-control money2" name="produto_peso" value="<?php echo isset($produto) ? $produto->produto_peso : set_value('produto_peso'); ?>">
									<?php echo form_error('produto_peso', '<div class="text-danger">', '</div>'); ?>
								</div>
								<div class="form-group col-md-6">
									<label>Altura do produto</label>
									<input type="text" class="form-control money2" name="produto_altura" value="<?php echo isset($produto) ? $produto->produto_altura : set_value('produto_altura'); ?>">
									<?php echo form_error('produto_altura', '<div class="text-danger">', '</div>'); ?>
								</div>
							</div>

							<div class="form-row">
								<div class="form-group col-md-4">
									<label>Largura do produto</label>
									<input type="text" class="form-control money2" name="produto_largura" value="<?php echo isset($produto) ? $produto->produto_largura : set_value('produto_largura'); ?>">
									<?php echo form_error('produto_largura', '<div class="text-danger">', '</div>'); ?>
								</div>
								<div class="form-group col-md-4">
									<label>Comprimento do produto</label>
									<input type="text" class="form-control money2" name="produto_comprimento" value="<?php echo isset($produto) ? $produto->produto_comprimento : set_value('produto_comprimento'); ?>">
									<?php echo form_error('produto_comprimento', '<div class="text-danger">', '</div>'); ?>
								</div>
								<div class="form-group col-md-4">
									<label>Quantidade em Estoque</label>
									<input type="number" class="form-control" name="produto_quantidade_estoque" value="<?php echo isset($produto) ? $produto->produto_quantidade_estoque : set_value('produto_quantidade_estoque'); ?>">
									<?php echo form_error('produto_quantidade_estoque', '<div class="text-danger">', '</div>'); ?>
								</div>
							</div>

							<div class="form-row">
								<div class="form-group col-md-12">
									<label>Descrição do Produto</label>
									<textarea class="form-control" name="produto_descricao" rows="4"><?php echo isset($produto) ? $produto->produto_descricao : set_value('produto_descricao'); ?></textarea>
									<?php echo form_error('produto_descricao', '<div class="text-danger">', '</div>'); ?>
								</div>
							</div>

							<div class="form-row">
								<div class="form-group col-md-8">
									<label for="fileuploader">Imagens do produto</label>
									<div id="fileuploader"></div>
									<!-- Div para exibir os erros de upload -->
									<div id="erro_uploaded" class="text-danger"></div>
									<!-- Tratamento de erro de validação PHP -->
									<?php if (form_error('fotos_produtos')): ?>
										<div class="text-danger">
											<?php echo form_error('fotos_produtos'); ?>
										</div>
									<?php endif; ?>
								</div>
							</div>


							<div class="form-row">
								<div class="form-group col-md-12">
									<?php if (isset($produto)): ?>
										<div id="uploaded_image" class="text-danger">
											<?php foreach ($fotos_produto as $foto): ?>
												<ul style="list-style: none; display: inline-block;">
													<li>
														<img src="<?php echo base_url('uploads/produtos/' . $foto->foto_caminho); ?>" alt="" width="80" class="img-thumbnail mr-1 mb-2">
														<input type="hidden" name="foto_produtos[]" value="<?php echo $foto->foto_caminho; ?>">
														<a href="javascript:void(0)" class="btn btn-danger d-block btn-icon mx-auto mb-30 btn-remove"><i class="fas fa-times"></i></a>
													</li>
												</ul>
											<?php endforeach; ?>
										</div>
									<?php else: ?>
										<div id="uploaded_image" class="text-danger"></div>
									<?php endif; ?>
								</div>
							</div>



							<?php if(isset($produto)): ?>
								<input type="hidden" name="produto_id" value="<?php echo $produto->produto_id; ?>">
							<?php endif; ?>

							<button class="btn btn-primary mr-2">Salvar</button>
							<a href="<?php echo base_url('restrita/produtos'); ?>" class="btn btn-dark">Voltar</a>

						</div>

						<?php echo form_close(); ?>


					</div>
				</div>
			</div>
		</div>
	</section>
	<?php $this->load->view('restrita/layout/sidebar_settings'); ?>
</div>
