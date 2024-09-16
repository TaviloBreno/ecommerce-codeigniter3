<?php
// Carregar as views da barra de navegação e barra lateral
$this->load->view('restrita/layout/navbar');
$this->load->view('restrita/layout/sidebar');
?>
<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-body">
			<!-- Add content here -->

			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h4><?php echo $titulo; ?></h4>
						</div>

						<?php
						$atributos = array('name' => 'form_core');

						$categoria_id = isset($categoria) ? $categoria->categoria_id : '';
						?>

						<?php echo form_open('restrita/categorias/core/' . $categoria_id, $atributos); ?>

						<div class="card-body">
							<div class="form-row">
								<div class="form-group <?php echo isset($categoria) ? 'col-md-3' : 'col-md-4'; ?>">
									<label>Nome da Categoria</label>
									<input type="text" class="form-control" name="categoria_nome"
										   value="<?php echo isset($categoria) ? $categoria->categoria_nome : set_value('categoria_nome'); ?>">
									<?php echo form_error('categoria_nome', '<div class="text-danger">', '</div>'); ?>
								</div>

								<div class="form-group <?php echo isset($categoria) ? 'col-md-3' : 'col-md-4'; ?>">
									<label>Categoria Pai</label>
									<select class="form-control" name="categoria_pai_id">
										<option value="">-- Selecione --</option>
										<?php foreach ($masters as $master): ?>
											<option value="<?php echo $master->categoria_pai_id; ?>"
												<?php echo isset($categoria) && $master->categoria_pai_id == $categoria->categoria_pai_id ? 'selected' : ''; ?>>
												<?php echo $master->categoria_pai_nome; ?>
											</option>
										<?php endforeach; ?>
									</select>
									<?php echo form_error('categoria_pai_id', '<div class="text-danger">', '</div>'); ?>
								</div>

								<?php if (isset($categoria)): ?>
									<div class="form-group col-md-3">
										<label>Meta Link da Categoria</label>
										<input type="text" class="form-control" readonly name="categoria_meta_link"
											   value="<?php echo $categoria->categoria_meta_link; ?>">
										<?php echo form_error('categoria_meta_link', '<div class="text-danger">', '</div>'); ?>
									</div>
								<?php endif; ?>

								<div class="form-group <?php echo isset($categoria) ? 'col-md-3' : 'col-md-4'; ?>">
									<label>Ativa</label>
									<select class="form-control" name="categoria_ativa">
										<option value="0" <?php echo isset($categoria) && $categoria->categoria_ativa == 0 ? 'selected' : ''; ?>>Não</option>
										<option value="1" <?php echo isset($categoria) && $categoria->categoria_ativa == 1 ? 'selected' : ''; ?>>Sim</option>
									</select>
								</div>
							</div>

							<?php if (isset($categoria)): ?>
								<input type="hidden" name="categoria_id" value="<?php echo $categoria->categoria_id; ?>">
							<?php endif; ?>

							<button class="btn btn-primary mr-2">Salvar</button>
							<a href="<?php echo base_url('restrita/categorias'); ?>" class="btn btn-dark">Voltar</a>

							<?php echo form_close(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php $this->load->view('restrita/layout/sidebar_settings'); ?>
</div>
