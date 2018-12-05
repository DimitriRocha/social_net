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
								<div class="tags-sec full-width">
									<ul>
										<li><a href="<?php echo PROJECT_PATH."/start/profile/$data[loggedUser]" ?>" title="">Meu perfil</a></li>
										<li><a href="" title="" class="btn-logOut">Sair</a></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-8 no-pd">
							<div class="main-ws-sec">
								<?php if($data['createPost']): ?>
									<div class="post-topbar">
										<div class="user-picy">
											<img src="<?php echo getImage("profilePlaceholder.png"); ?>" alt="">
										</div>
										<div class="post-st">
											<ul>
												<li><a class="post-jb active" href="#" title="">Criar um post</a></li>
											</ul>
										</div>
									</div>
								<?php endif; ?>
								<div class="posts-section">
									<?php if (!empty($data['result'])): ?>
										<?php foreach($data['result'] as $key => $result) : ?>
											<div class="post-bar">
												<div class="post_topbar">
													<div class="usy-dt">
														<a href="<?php echo PROJECT_PATH."/start/profile/$result[user_id]" ?>">
															<img class="profile-postImg" src="<?php echo getImage("profilePlaceholder.jpg"); ?>" alt="">
															<div class="usy-name">
																<h3><?php print_r($result['name']); ?></h3>
																<span><img src="images/clock.png" alt=""><?php echo date("d/m/Y", strtotime($result['date'])); ?></span>
															</div>
														</a>
													</div>
													<div class="ed-opts">
														<a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
														<ul class="ed-options">
															<li><a href="#" title="">Em construção</a></li>
														</ul>
													</div>
												</div>
												<div class="job_descp">
													<p><?php echo $result['content']?></p>
													<img class="w-100" src="<?php echo getImage($result['post_img_path']); ?>" alt="">
												</div>
												<div class="job-status-bar">
													<ul class="like-com">
														<li>
															<a class="btn-like">
																<i class="la la-heart"
																data-user_liked="<?php echo ( $result['user_liked'] ? 1 : 0 ) ?>"
																style="color:<?php echo ( $result['user_liked'] ? '#ff5555' : '#000' ) ?>"></i>
																Like
															</a>
														</li>
														<li>
															<a class="btn-comment"><i class="la la-globe"></i> Commentar</a>
														</li>
													</ul>
													<a class="total_likes" data-toggle="tooltip" data-placement="top" title="Número de Likes">
														<i class="la la-heart"></i>
														Likes <span class="likes_num"><?php echo $result['num_likes']?></span>
													</a>
												</div>
												<div class="comment-section">
													<div class="comment-sec" hidden>
														<ul class="comment-list">

															<?php foreach ($result['comments'] as $key => $comment) :?>
																<li class="comment">
																	<h3><?php echo $comment['name'] ?></h3>
																	<p>&nbsp <?php echo $comment['comment'] ?></p>
																	<span><img src="images/clock.png" alt=""><?php echo date("d/m/Y", strtotime($comment['comment_date'])); ?></span>
																</li>
															<?php endforeach; ?>
														</ul>
													</div>
													<div id="<?php echo $result['post_id'];?>" class="comment_box">
														<input type="text" class="text_comment">
														<button type="button" class="btn btn-secondary submit-comment">Comment</button>
													</div>

												</div>
											</div>
										<?php endforeach;?>
									<?php else: ?>
										<div class="container text-center"><h4>Não há posts disponíveis</h4></div>
									<?php endif; ?>
								</div>
							</div>
						</div>
						<div class="col-lg-3 pd-right-none no-pd">
							<div class="right-sidebar">
								<div class="widget widget-jobs">
									<?php if (!$data['addCurrentFriend']): ?>
										<div class="sd-title clearfix">
											<div class="clearfix">
												<h3 class="mb-2">Recomendações de amigos</h3>
												<i class="la la-ellipsis-v"></i>
											</div>
											<?php if (!empty($data['sugested'])): ?>
												<?php foreach ($data['sugested'] as $key => $user): ?>
													<div class="mt-3 clearfix">
														<span class="d-none user_id"><?php echo $user['id'] ?></span>
														<a href="<?php echo PROJECT_PATH."/start/profile/$user[id]" ?>"><span class="text-dark float-left"><?php echo $user['name']; ?></span></a>
														<span class="float-right"><a href="<?php echo PROJECT_PATH."/start/adduser/".$user['id'] ?>">Adicionar</a></span>
													</div>
												<?php endforeach; ?>
											<?php else: ?>
												<div class="mt-3 clearfix">
													<span class="">Não há recomendações de amigos</span>
												</div>
											<?php endif; ?>
										</div>
									<?php else: ?>
										<div class="sd-title clearfix">
											<div class="clearfix">
												<h3 class="mb-2">Adicionar</h3>
												<i class="la la-ellipsis-v"></i>
											</div>
											<div class="mt-3 clearfix">
												<span class="d-none user_id"><?php echo $data['addCurrentFriend'] ?></span>
												<span class="float-left"><?php echo $data['dispayName']; ?></span>
												<span class="float-right"><a href="<?php echo PROJECT_PATH."/start/adduser/$data[addCurrentFriend]" ?>">Adicionar</a></span>
											</div>
										</div>
									<?php endif; ?>
								</div><!--widget-jobs end-->
							</div><!--right-sidebar end-->
						</div>
					</div>
				</div><!-- main-section-data end-->
			</div>
		</div>
	</main>
	<div class="post-popup pst-pj">
		<div class="post-project">
			<h3>Post a project</h3>
			<div class="post-project-fields">
				<form>
					<div class="row">
						<div class="col-lg-12">
							<input type="text" name="title" placeholder="Title">
						</div>
						<div class="col-lg-12">
							<div class="inp-field">
								<select>
									<option>Category</option>
									<option>Category 1</option>
									<option>Category 2</option>
									<option>Category 3</option>
								</select>
							</div>
						</div>
						<div class="col-lg-12">
							<input type="text" name="skills" placeholder="Skills">
						</div>
						<div class="col-lg-12">
							<div class="price-sec">
								<div class="price-br">
									<input type="text" name="price1" placeholder="Price">
									<i class="la la-dollar"></i>
								</div>
								<span>To</span>
								<div class="price-br">
									<input type="text" name="price1" placeholder="Price">
									<i class="la la-dollar"></i>
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<textarea name="description" placeholder="Description"></textarea>
						</div>
						<div class="col-lg-12">
							<ul>
								<li><button class="active" type="submit" value="post">Post</button></li>
								<li><a href="#" title="">Cancel</a></li>
							</ul>
						</div>
					</div>
				</form>
			</div><!--post-project-fields end-->
			<a href="#" title=""><i class="la la-times-circle-o"></i></a>
		</div><!--post-project end-->
	</div><!--post-project-popup end-->

	<div class="post-popup job_post">
		<div class="post-project">
			<h3>Criar um post</h3>
			<div class="post-project-fields">
				<form enctype='multipart/form-data' action="<?php echo PROJECT_PATH."/" ?>" method="POST">
					<input type="hidden" name="postId" value="savePost">
					<div class="row">
						<div class="col-lg-12">
							<input name="description" type="textarea" id="newPost-description" placeholder="Description"></input>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<div class="input-group">
									<span class="input-group-btn">
										<span class="btn btn-default btn-file no-pd-mg">
											<button type="button" class="btn btn-secondary">Pesquisar</button>
											<input name="image" type="file" id="imgInp">
										</span>
									</span>
									<input type="text" class="form-control imgUrl" readonly placeholder="Imagem">
								</div>
								<img id='img-upload'/>
							</div>
						</div>
						<div class="col-lg-12">
							<ul>
								<li><input type="submit" class="submit-post" value="Postar"></li>
								<li><input type="button" class="cancel-post" value="Cancelar"></li>
							</ul>
						</div>
					</div>
				</form>
			</div><!--post-project-fields end-->
			<a href="#" title=""><i class="la la-times-circle-o"></i></a>
		</div><!--post-project end-->
	</div><!--post-project-popup end-->
	<?php //importComponent("chatOverflow"); ?>
</div>
