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
							<a href="<?php echo base_url('restrita/marcas/core'); ?>" class="btn btn-primary float-right">Cadastrar</a>
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
										<th>#</th>
										<th>Nome da Marca</th>
										<th>Meta Link da Marca</th>
										<th>Data de criação</th>
										<th>Ativa</th>
										<th class="nosort">Ações</th>
									</tr>
									</thead>
									<tbody>
									<?php if (isset($marcas)): ?>
										<?php foreach ($marcas as $marca): ?>
											<tr>
												<td><?php echo $marca->marca_id; ?></td>
												<td><?php echo $marca->marca_nome; ?></td>
												<td><i data-feather="link-2"></i>&nbsp;<?php echo $marca->marca_meta_link; ?></td>
												<td><?php echo formata_data_banco_com_hora($marca->marca_data_criacao);?></td>
												<td><?php echo ($marca->marca_ativa == 1 ? '<div class="badge badge-success">Sim</div>' : '<div class="badge badge-danger">Não</div>'); ?></td>
												<td>
													<a href="<?php echo base_url('restrita/marcas/core/' . $marca->marca_id); ?>" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Editar Marca <?php echo $marca->marca_nome; ?>">
														<i class="fas fa-edit"></i>
													</a>
													<a href="<?php echo base_url('restrita/marcas/delete/' . $marca->marca_id); ?>" class="btn btn-danger btn-sm delete" data-confirm="Tem certeza da exclusão do(a) <?php echo $marca->marca_nome;?>?" data-toggle="tooltip" title="Excluir Marca <?php echo $marca->marca_nome; ?>">
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

