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

						<?php echo form_open('restrita/sistema/correios'); ?>

						<div class="card-body">

							<?php if($message = $this->session->flashdata('sucesso')): ?>
								<div class="alert alert-success alert-has-icon alert-dismissible show fade">
									<div class="alert-icon"><i class="fa fa-check-circle fa-lg"></i></div>
									<div class="alert-body">
										<div class="alert-title">Perfeito!</div>
										<button class="close" data-dismiss="alert">
											<span>&times;</span>
										</button>
										<?php echo $message; ?>
									</div>
								</div>
							<?php endif; ?>

							<?php if($message = $this->session->flashdata('erro')): ?>
								<div class="alert alert-danger alert-has-icon alert-dismissible show fade">
									<div class="alert-icon"><i class="fa fa-times-circle fa-lg"></i></div>
									<div class="alert-body">
										<div class="alert-title">Atenção!</div>
										<button class="close" data-dismiss="alert">
											<span>&times;</span>
										</button>
										<?php echo $message; ?>
									</div>
								</div>
							<?php endif; ?>



							<div class="form-row">
								<div class="form-group col-md-6">
									<label>CEP de Origem</label>
									<input type="text" name="config_cep_origem" class="form-control cep" value="<?php echo isset($correios->config_cep_origem) ? $correios->config_cep_origem : set_value('config_cep_origem'); ?>">
									<?php echo form_error('config_cep_origem', '<div class="text-danger">', '</div>'); ?>
								</div>
								<div class="form-group col-md-6">
									<label>Código PAC</label>
									<input type="text" name="config_codigo_pac" class="form-control" value="<?php echo isset($correios->config_codigo_pac) ? $correios->config_codigo_pac : set_value('config_codigo_pac'); ?>">
									<?php echo form_error('config_codigo_pac', '<div class="text-danger">', '</div>'); ?>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label>Código SEDEX</label>
									<input type="text" name="config_codigo_sedex" class="form-control" value="<?php echo isset($correios->config_codigo_sedex) ? $correios->config_codigo_sedex : set_value('config_codigo_sedex'); ?>">
									<?php echo form_error('config_codigo_sedex', '<div class="text-danger">', '</div>'); ?>
								</div>
								<div class="form-group col-md-6">
									<label>Valor a somar no frete</label>
									<input type="text" name="config_somar_frete" class="form-control money2" value="<?php echo isset($correios->config_somar_frete) ? $correios->config_somar_frete : set_value('config_somar_frete'); ?>">
									<?php echo form_error('config_somar_frete', '<div class="text-danger">', '</div>'); ?>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label>Valor declarado</label>
									<input type="text" name="config_valor_declarado" class="form-control money2" value="<?php echo isset($correios->config_valor_declarado) ? $correios->config_valor_declarado : set_value('config_valor_declarado'); ?>">
									<?php echo form_error('config_valor_declarado', '<div class="text-danger">', '</div>'); ?>
								</div>
							</div>

						</div>
						<div class="card-footer">
							<button class="btn btn-primary mr-2">Salvar</button>
						</div>

						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php $this->load->view('restrita/layout/sidebar_settings'); ?>
</div>
