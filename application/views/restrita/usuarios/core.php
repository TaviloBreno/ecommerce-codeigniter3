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

						if(isset($usuario)){
							$usuario_id = $usuario->id;
						}else{
							$usuario_id = '';
						} ?>

						<?php echo form_open('restrita/usuarios/core/'.$usuario_id, $atributos); ?>

						<div class="card-body">
							<div class="form-row">
								<div class="form-group col-md-6">
									<label>Nome</label>
									<input type="text" name="first_name" class="form-control" value="<?php echo isset($usuario->first_name) ? $usuario->first_name : set_value('first_name'); ?>">
									<?php echo form_error('first_name', '<div class="text-danger">', '</div>'); ?>
								</div>
								<div class="form-group col-md-6">
									<label>Sobrenome</label>
									<input type="text" class="form-control" name="last_name" value="<?php echo isset($usuario->last_name) ? $usuario->last_name : set_value('last_name'); ?>">
									<?php echo form_error('last_name', '<div class="text-danger">', '</div>'); ?>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label>E-mail</label>
									<input type="text" class="form-control" name="email" value="<?php echo isset($usuario->email) ? $usuario->email : set_value('email'); ?>">
									<?php echo form_error('email', '<div class="text-danger">', '</div>'); ?>
								</div>
								<div class="form-group col-md-6">
									<label>Usuário</label>
									<input type="text" class="form-control" name="username" value="<?php echo isset($usuario->username) ? $usuario->username : set_value('username'); ?>">
									<?php echo form_error('username', '<div class="text-danger">', '</div>'); ?>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label>Ativo</label>
									<select class="form-control" name="ativo">
										<?php if(isset($usuario->active)): ?>
											<option value="1" <?php echo($usuario->active == 1 ? 'selected' : ''); ?>>Sim</option>
											<option value="0" <?php echo($usuario->active == 0 ? 'selected' : ''); ?>>Não</option>
										<?php else: ?>
											<option value="1">Sim</option>
											<option value="0">Não</option>
										<?php endif; ?>
									</select>
								</div>
								<div class="form-group col-md-6">
									<label>Perfil de acesso</label>
									<select class="form-control" name="perfil">
										<?php foreach ($grupos as $grupo): ?>

											<?php if(isset($usuario)): ?>
												<option value="<?php echo $grupo->id; ?>" <?php echo ($grupo->id == $perfil->id ? 'selected' : ''); ?>><?php echo $grupo->name; ?></option>
											<?php else: ?>

												<option value="<?php echo $grupo->id; ?>"><?php echo $grupo->name; ?></option>

											<?php endif; ?>

										<?php endforeach; ?>
									</select>
								</div>

								<?php if(isset($usuario)): ?>

									<input type="hidden" name="usuario_id" value="<?php echo $usuario->id; ?>">

								<?php endif; ?>

							</div>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label>Senha</label>
									<input type="password" name="password" class="form-control">
								</div>
								<div class="form-group col-md-6">
									<label>Confirmação de senha</label>
									<input type="password" name="password_confirm" class="form-control">
								</div>
							</div>
						</div>
						<div class="card-footer">
							<button class="btn btn-primary mr-2">Salvar</button>
							<a href="<?php echo base_url('restrita/usuarios'); ?>" class="btn btn-dark">Voltar</a>
						</div>

						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php $this->load->view('restrita/layout/sidebar_settings'); ?>
</div>
