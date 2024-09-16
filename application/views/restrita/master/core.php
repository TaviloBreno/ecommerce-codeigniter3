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

						if(isset($categoria_pai)){
							$categoria_pai_id = $categoria_pai->categoria_pai_id;
						}else{
							$categoria_pai_id = '';
						} ?>

						<?php echo form_open('restrita/master/core/'.$categoria_pai_id, $atributos); ?>

						<div class="card-body">
							<div class="form-row">
								<div class="form-group <?php echo (isset($categoria_pai) ? "col-md-4" : "col-md-6"); ?>">
									<label>Nome da Categoria</label>
									<input type="text" class="form-control" name="categoria_pai_nome" value="<?php echo isset($categoria_pai) ? $categoria_pai->categoria_pai_nome : set_value('categoria_pai_nome'); ?>">
									<?php echo form_error('categoria_pai_nome', '<div class="text-danger">', '</div>'); ?>
								</div>
								<?php if(isset($categoria_pai)): ?>
									<div class="form-group col-md-4">
										<label>Meta Link da Categoria</label>
										<input type="text" class="form-control" name="categoria_pai_meta_link" value="<?php echo $categoria_pai->categoria_pai_meta_link; ?>">
										<?php echo form_error('categoria_pai_meta_link', '<div class="text-danger">', '</div>'); ?>
									</div>
								<?php endif; ?>
								<div class="form-group <?php echo (isset($categoria_pai) ? "col-md-4" : "col-md-6"); ?>">
									<label>Ativa</label>
									<select class="form-control" name="categoria_pai_ativa">
										<?php if(isset($categoria_pai)): ?>
											<option value="1" <?php echo ($categoria_pai->categoria_pai_ativa == 1 ? 'selected' : ''); ?>>Sim</option>
											<option value="0" <?php echo ($categoria_pai->categoria_pai_ativa == 0 ? 'selected' : ''); ?>>Não</option>
										<?php else: ?>
											<option value="1">Sim</option>
											<option value="0">Não</option>
										<?php endif; ?>
									</select>
								</div>
							</div>

							<?php if(isset($categoria_pai)): ?>

								<input type="hidden" name="categoria_pai_id" value="<?php echo $categoria_pai->categoria_pai_id; ?>">

							<?php endif; ?>

							<button class="btn btn-primary mr-2">Salvar</button>
							<a href="<?php echo base_url('restrita/master'); ?>" class="btn btn-dark">Voltar</a>

						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php $this->load->view('restrita/layout/sidebar_settings'); ?>
</div>
