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
									<h4><?php echo $titulo; ?></h4>
								</div>
								<div class="card-body">
									<div class="card-body">
										<div class="form-row">
											<div class="form-group col-md-6">
												<label>Nome</label>
												<input type="text" name="first_name" class="form-control">
											</div>
											<div class="form-group col-md-6">
												<label>Sobrenome</label>
												<input type="text" class="form-control" name="last_name">
											</div>
										</div>
										<div class="form-row">
											<div class="form-group col-md-6">
												<label>Email</label>
												<input type="email" class="form-control" name="email">
											</div>
											<div class="form-group col-md-6">
												<label>Usuário</label>
												<input type="text" class="form-control" name="username">
											</div>
										</div>
										<div class="form-row">
											<div class="form-group col-md-6">
												<label>Senha</label>
												<input type="password" class="form-control" name="password">
											</div>
											<div class="form-group col-md-6">
												<label>Confirmação da Senha</label>
												<input type="password" class="form-control" name="password_confirm">
											</div>
										</div>

										<div class="form-row">
											<div class="form-group col-md-6">
												<label>Perfil de acesso</label>
												<select class="form-control" name="perfil_usuario">
													<option value="2">Cliente</option>
													<option value="1">Administrador</option>
												</select>
											</div>
											<div class="form-group col-md-6">
												<label>Status</label>
												<select class="form-control" name="active">
													<option value="0">Inativo</option>
													<option value="1">Ativo</option>
												</select>
											</div>
										</div>

									</div>
									<div class="card-footer">
										<button class="btn btn-primary">Submit</button>
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

