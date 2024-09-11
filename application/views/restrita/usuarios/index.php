<?php $this->load->view('restrita/layout/navbar'); ?>
<?php $this->load->view('restrita/layout/sidebar'); ?>
<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-body">
			<!-- add content here -->

			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header d-block">
							<h4><?php echo $titulo; ?></h4>
							<a href="<?php echo base_url('restrita/usuarios/core'); ?>" class="btn btn-primary float-right">Cadastrar</a>
						</div>
						<div class="card-body">

							<?php if($mensagem = $this->session->flashdata('erro')): ?>

							<div class="alert alert-danger alert-has-icon alert-dismissible show fade">
								<div class="alert-icon">
									<i class="fas fa-exclamation-circle fa-lg"></i>
								</div>
								<div class="alert-body">
									<div class="alert-title">Erro!</div>
									<button class="close" data-dismiss="alert">
										<span>&times;</span>
									</button>
									<?php echo $mensagem; ?>
								</div>
							</div>

							<?php endif; ?>

							<?php if($mensagem = $this->session->flashdata('sucesso')): ?>

							<div class="alert alert-success alert-has-icon alert-dismissible show fade">
								<div class="alert-icon">
									<i class="fas fa-check-circle fa-lg"></i>
								</div>
								<div class="alert-body">
									<div class="alert-title">Sucesso!</div>
									<button class="close" data-dismiss="alert">
										<span>&times;</span>
									</button>
									<?php echo $mensagem; ?>
								</div>
							</div>

							<?php endif; ?>

							<?php if($mensagem = $this->session->flashdata('atencao')): ?>

							<div class="alert alert-warning alert-has-icon alert-dismissible show fade">
								<div class="alert-icon">
									<i class="fas fa-exclamation-circle fa-lg"></i>
								</div>
								<div class="alert-body">
									<div class="alert-title">Atenção!</div>
									<button class="close" data-dismiss="alert">
										<span>&times;</span>
									</button>
									<?php echo $mensagem; ?>
								</div>
							</div>


							<?php endif; ?>

							<?php if($mensagem = $this->session->flashdata('info')): ?>

							<div class="alert alert-info alert-has-icon alert-dismissible show fade">
								<div class="alert-icon">
									<i class="fas fa-info-circle fa-lg"></i>
								</div>
								<div class="alert-body">
									<div class="alert-title">Informação!</div>
									<button class="close" data-dismiss="alert">
										<span>&times;</span>
									</button>
									<?php echo $mensagem; ?>
								</div>
							</div>

							<?php endif; ?>

							<div class="table-responsive">
								<table class="table table-striped data-table">
									<thead>
									<tr>
										<th class="text-center">#</th>
										<th>Nome completo</th>
										<th>E-mail</th>
										<th>Usuário</th>
										<th>Perfil de Acesso</th>
										<th>Status</th>
										<th class="nosort">Ações</th>
									</tr>
									</thead>
									<tbody>
									<?php if (isset($usuarios)): ?>
										<?php foreach ($usuarios as $usuario): ?>
											<tr> <!-- Aqui começa a linha de cada usuário -->
												<td><?php echo $usuario->id; ?></td>
												<td><?php echo $usuario->first_name . ' ' . $usuario->last_name; ?></td>
												<td><?php echo $usuario->email; ?></td>
												<td><?php echo $usuario->username; ?></td>
												<td><?php echo ($this->ion_auth->is_admin($usuario->id) ? 'Administrador' : 'Cliente'); ?></td>
												<td><?php echo($usuario->active == 1 ? '<div class="badge badge-success">Ativo</div>' : '<div class="badge badge-danger">Inativo</div>'); ?></td>
												<td>
													<a href="<?php echo base_url('restrita/usuarios/core/' . $usuario->id); ?>" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Editar usuário">
														<i class="fas fa-edit"></i>
													</a>
													<a href="<?php echo base_url('restrita/usuarios/excluir/' . $usuario->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este usuário?');" data-toggle="tooltip" title="Excluir usuário">
														<i class="fas fa-trash-alt"></i>
													</a>
												</td>
											</tr> <!-- Aqui termina a linha de cada usuário -->
										<?php endforeach; ?>
									<?php else: ?>
										<tr>
											<td colspan="7" class="text-center">Nenhum usuário encontrado</td>
										</tr>
									<?php endif; ?>
									</tbody>
								</table>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php $this->load->view('restrita/layout/sidebar_settings'); ?>
</div>

