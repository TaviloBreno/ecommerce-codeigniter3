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

						if(isset($marca)){
							$marca_id = $marca->marca_id;
						}else{
							$marca_id = '';
						} ?>

						<?php echo form_open('restrita/marcas/core/'.$marca_id, $atributos); ?>

						<div class="card-body">
							<div class="form-row">
								<div class="form-group <?php echo (isset($marca) ? "col-md-4" : "col-md-6"); ?>">
									<label>Nome da Marca</label>
									<input type="text" class="form-control" name="marca_nome" value="<?php echo isset($marca->marca_nome) ? $marca->marca_nome : set_value('marca_nome'); ?>">
									<?php echo form_error('marca_nome', '<div class="text-danger">', '</div>'); ?>
								</div>
								<?php if(isset($marca)): ?>
									<div class="form-group col-md-4">
										<label>Meta Link da Marca</label>
										<input type="text" readonly class="form-control" name="marca_meta_link" value="<?php echo isset($marca->marca_meta_link) ? $marca->marca_meta_link : set_value('marca_meta_link'); ?>">
										<?php echo form_error('marca_meta_link', '<div class="text-danger">', '</div>'); ?>
									</div>
								<?php endif; ?>
								<div class="form-group <?php echo (isset($marca) ? "col-md-4" : "col-md-6"); ?>">
									<label>Ativa</label>
									<select class="form-control" name="marca_ativa">
										<?php if(isset($marca)): ?>
											<option value="1" <?php echo($marca->marca_ativa == 1 ? 'selected' : ''); ?>>Sim</option>
											<option value="0" <?php echo($marca->marca_ativa == 0 ? 'selected' : ''); ?>>Não</option>
										<?php else: ?>
											<option value="1">Sim</option>
											<option value="0">Não</option>
										<?php endif; ?>
									</select>
								</div>
							</div>

							<?php if(isset($marca)): ?>

								<input type="hidden" name="marca_id" value="<?php echo $marca->marca_id; ?>">

							<?php endif; ?>

							<button class="btn btn-primary mr-2">Salvar</button>
							<a href="<?php echo base_url('restrita/marcas'); ?>" class="btn btn-dark">Voltar</a>

						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php $this->load->view('restrita/layout/sidebar_settings'); ?>
</div>
