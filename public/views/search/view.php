<div class="wrapper">
	<?php importComponent("header");?>
	<!-- pd-left-none no-pd -->
	<main>
		<div class="main-section">
			<div class="container">
				<div class="main-section-data">
					<div class="row">
						<div class="col-lg-3 col-md-4 pd-left-none no-pd">
							<div class="main-left-sidebar no-margin">
								<div class="user-data full-width">
									<div class="user-profile">
										<div class="username-dt">
											<div class="usr-pic">
												<img src="<?php echo getImage("profilePlaceholder.jpg"); ?>" alt="">
											</div>
										</div>
										<div class="user-specs">
											<h3><?php echo $data['dispayName']?></h3>
											<span><?php echo $data['occupation']?></span>
										</div>
									</div>
									<ul class="user-fw-status">
										<li>
											<h4>Amigos</h4>
											<span><?php echo (!empty($data['friends']) ? count($data['friends']) : 0); ?></span>
										</li>
									</ul>
								</div>
								<?php if ($data['createPost']): ?>
									<div class="tags-sec full-width">
										<ul>
											<li><a href="<?php echo PROJECT_PATH."/start/profile/$data[loggedUser]" ?>" title="">Meu perfil</a></li>
											<li><a href="" title="" class="btn-logOut">Sair</a></li>
										</ul>
									</div>
								<?php endif; ?>
							</div>
						</div>
						<div class="col-lg-6 col-md-8 no-pd">
							<div class="main-ws-sec">
								<div class="posts-section bg-light p-4">
									<?php if (!empty($data['search_results'])): ?>
										<?php foreach($data['search_results'] as $key => $result) : ?>
											<div class="card mx-auto mt-3" style="width: 90%;">
												<div class="card-body">
													<h5 class="card-title"><?php echo $result['name'] ?></h5>
													<p class="card-text mb-3"><?php echo $result['occupation'] ?></p>

													<?php if ($result['friend_status'] == 'self'): ?>
														<a href="<?php echo PROJECT_PATH."/start/profile/$result[id]" ?>" class="float-right btn btn-primary">Veja seu perfil</a>

													<?php elseif($result['friend_status'] == 'friend'): ?>
														<a disabled href="#" class="btn btn-secondary">Amigo</a>
														<a href="<?php echo PROJECT_PATH."/start/profile/$result[id]" ?>" class="float-right btn btn-primary">Veja o perfil</a>

													<?php elseif($result['friend_status'] == 'pending'): ?>
														<a href="<?php echo PROJECT_PATH."/start/acceptFriend/".$result['relation_id'] ?>" class="btn btn-info">Aceitar amizade</a>
														<a href="<?php echo PROJECT_PATH."/start/profile/$result[id]" ?>" class="float-right btn btn-primary">Veja o perfil</a>

													<?php elseif($result['friend_status'] == 'waiting'): ?>
														<a disabled href="#" class="btn btn-secondary">Pedido já enviado</a>
														<a href="<?php echo PROJECT_PATH."/start/profile/$result[id]" ?>" class="float-right btn btn-primary">Veja o perfil</a>

													<?php else: ?>
														<a href="#" class="btn btn-primary">Adicionar Amigo</a>
														<a href="<?php echo PROJECT_PATH."/start/profile/$result[id]" ?>" class="float-right btn btn-primary">Veja o perfil</a>

													<?php endif; ?>
												</div>
											</div>
										<?php endforeach;?>
									<?php else: ?>
										<div class="container text-center"><h4>A pesquisa não retornou resultados</h4></div>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
</div>
