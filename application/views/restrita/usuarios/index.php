		<?php $this->load->view('restrita/layout/navbar'); ?>
		<?php $this->load->view('restrita/layout/sidebar'); ?>
		<!-- Main Content -->
		<div class="main-content">
			<section class="section">
				<div class="section-body">

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h4>Basic DataTables</h4>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-striped data-table">
											<thead>
											<tr>
												<th class="text-center">
													#
												</th>
												<th>Nome Completo</th>
												<th>E-mail</th>
												<th>Usuário</th>
												<th>Status</th>
												<th>Ações</th>
											</tr>
											</thead>
											<tbody>
											<tr>
												<?php foreach ($usuarios as $usuario): ?>

													<td class="text-center">
														<?php echo $usuario->id; ?>
													</td>
													<td><?php echo $usuario->first_name . ' ' . $usuario->last_name; ?></td>
													<td><?php echo $usuario->email; ?></td>
													<td><?php echo $usuario->username; ?></td>
													<td><?php echo ($usuario->active == 1 ? '<div class="badge badge-success">Ativo</div>' : '<div class="badge badge-danger">Inativo</div>'); ?></td>
													<td>
														<a href="<?php echo base_url('restrita/usuarios/core/' . $usuario->id); ?>" class="btn btn-info btn-icon">
															<i class="fas fa-user-edit"></i>
														</a>
														<a href="<?php echo base_url('restrita/usuarios/delete/' . $usuario->id); ?>" class="btn btn-danger btn-icon">
															<i class="fas fa-user-times"></i>
														</a>
													</td>

												<?php endforeach; ?>
											</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>


				</div>
			</section>
			<div class="settingSidebar">
				<a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
				</a>
				<?php $this->load->view('restrita/layout/sidebar-settings'); ?>
			</div>
		</div>

