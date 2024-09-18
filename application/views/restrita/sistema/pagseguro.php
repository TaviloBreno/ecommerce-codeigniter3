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

						<?php echo form_open('restrita/sistema/pagseguro'); ?>

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
								<div class="form-group col-md-4">
									<label>E-mail de acesso</label>
									<input type="text" name="config_email" class="form-control" value="<?php echo isset($pagseguro->config_email) ? $pagseguro->config_email : set_value('config_email'); ?>">
									<?php echo form_error('config_email', '<div class="text-danger">', '</div>'); ?>
								</div>
								<div class="form-group col-md-4">
									<label>Token</label>
									<input type="text" name="config_token" class="form-control" value="<?php echo isset($pagseguro->config_token) ? $pagseguro->config_token : set_value('config_token'); ?>">
									<?php echo form_error('config_token', '<div class="text-danger">', '</div>'); ?>
								</div>
								<div class="form-group col-md-4">
									<label>Ambiente</label>
									<?php if(isset($pagseguro)): ?>
										<select name="config_ambiente" class="form-control">
											<option value="1" <?php echo($pagseguro->config_ambiente == 1 ? 'selected' : ''); ?>>Produção</option>
											<option value="0" <?php echo($pagseguro->config_ambiente == 0 ? 'selected' : ''); ?>>Sandbox</option>
										</select>
									<?php else: ?>
										<select name="config_ambiente" class="form-control">
											<option value="1">Produção</option>
											<option value="0">Sandbox</option>
										</select>
									<?php endif; ?>
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
