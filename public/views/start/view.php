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
												<img src="<?php echo getImage("profile_placeholder.jpeg"); ?>" alt="">
											</div>
										</div><!--username-dt end-->
										<div class="user-specs">
											<h3><?php echo $_SESSION['user']['name']?></h3>
											<span><?php echo $_SESSION['user']['occupation']?></span>
										</div>
									</div><!--user-profile end-->
									<ul class="user-fw-status">
										<li>
											<h4>Amigos</h4>
											<span>34</span>
										</li>
										<!-- <li>
											<a href="#" title="">Ver mais</a>
										</li> -->
									</ul>
								</div><!--user-data end-->
								<div class="tags-sec full-width">
									<ul>
										<li><a href="" title="">Perfil</a></li>
										<li><a href="" title="">Sobre</a></li>
										<li><a href="" title="" class="btn-logOut">Sair</a></li>
									</ul>
								</div><!--tags-sec end-->
							</div><!--main-left-sidebar end-->
						</div>
						<div class="col-lg-6 col-md-8 no-pd">
							<div class="main-ws-sec">
								<div class="post-topbar">
									<div class="user-picy">
										<img src="<?php echo getImage("profile_placeholder.jpeg"); ?>" alt="">
									</div>
									<div class="post-st">
										<ul>
											<!-- <li><a class="post_project" href="#" title="">Post a Project</a></li> -->
											<li><a class="post-jb active" href="#" title="">Post a Job</a></li>
										</ul>
									</div><!--post-st end-->
								</div><!--post-topbar end-->
								<div class="posts-section">
								<!-- Dimitre nao sei pegar o arrei se fode ae -->
									<?php foreach($data as $result) : ?>
										<div class="post-bar">
											<div class="post_topbar">
												<div class="usy-dt">
													<img class="profile-postImg" src="<?php echo getImage("profile_placeholder.jpeg"); ?>" alt="">
													<div class="usy-name">
														<h3><?php echo $result['name'];?></h3>
														<span><img src="images/clock.png" alt=""><?php echo date("d/m/Y", strtotime($result['date'])); ?></span>
													</div>
												</div>
												<div class="ed-opts">
													<a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
													<ul class="ed-options">
														<li><a href="#" title="">Edit Post</a></li>
														<li><a href="#" title="">Unsaved</a></li>
														<li><a href="#" title="">Unbid</a></li>
														<li><a href="#" title="">Close</a></li>
														<li><a href="#" title="">Hide</a></li>
													</ul>
												</div>
											</div>
											<div class="job_descp">
												<!-- <h3>Título da postagem</h3> -->
												<p><?php echo $result['content']?></p>
												<img class="w-100" src="<?php echo $result['image_url']; ?>" alt="">
											</div>
											<div class="job-status-bar">
												<ul class="like-com">
													<li>
														<a class="btn-like"><i class="la la-heart"></i> Like</a>
														<img src="images/liked-img.png" alt="">
													</li>
													<li>
														<a class="btn-comment"><i class="la la-globe"></i> Comment</a>
													</li>
												</ul>
												<a><i class="la la-heart"></i>Likes <?php echo $result['num_likes']?></a>
											</div>
											<div class="comment-section">
												<div class="comment-sec" hidden>
													<ul class="comment-list">
														<?php for ($i=0; $i < 3; $i++): ?>
															<li class="comment">
																<h3>Nome</h3>
																<p>&nbspComment</p>
																<span><img src="images/clock.png" alt=""><?php echo date("d/m/Y", strtotime($result['date'])); ?></span>
															</li>
														<?php endfor; ?>
													</ul>
												</div>
												<div id="<?php echo $result['post_id'];?>" class="comment_box">
													<input type="text" class="text_comment">
													<button type="button" class="btn btn-secondary submit-comment">Comment</button>
												</div>
												
											</div>
										</div><!--post-bar end-->
									<?php endforeach;?>
									<div class="process-comm">
										<div class="spinner">
											<div class="bounce1"></div>
											<div class="bounce2"></div>
											<div class="bounce3"></div>
										</div>
									</div><!--process-comm end-->
								</div><!--posts-section end-->
							</div><!--main-ws-sec end-->
						</div>
						<div class="col-lg-3 pd-right-none no-pd">
							<div class="right-sidebar">
								<!-- <div class="widget widget-about">
									<div class="sign_link">
										<h3><a href="#" title="">Sign up</a></h3>
									</div>
								</div>widget-about end -->
								<div class="widget widget-jobs">
									<div class="sd-title">
										<h3>Recomendações de amigos</h3>
										<i class="la la-ellipsis-v"></i>
									</div>
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
			<h3>Post a job</h3>
			<div class="post-project-fields">
				<form>
					<div class="row">
						<!-- <div class="col-lg-12">
							<input type="text" name="title" placeholder="Title">
						</div> -->
						<!-- <div class="col-lg-12">
							<div class="inp-field">
								<select>
									<option>Category</option>
									<option>Category 1</option>
									<option>Category 2</option>
									<option>Category 3</option>
								</select>
							</div>
						</div> -->
						<!-- <div class="col-lg-12">
							<input type="text" name="skills" placeholder="Skills">
						</div> -->
						<!-- <div class="col-lg-6">
							<div class="price-br">
								<input type="text" name="price1" placeholder="Price">
								<i class="la la-dollar"></i>
							</div>
						</div> -->
						<!-- <div class="col-lg-6">
							<div class="inp-field">
								<select>
									<option>Full Time</option>
									<option>Half time</option>
								</select>
							</div>
						</div> -->
						<div class="col-lg-12">
							<textarea id="newPost-description" placeholder="Description"></textarea>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<!-- <label>Upload Image</label> -->
								<div class="input-group">
									<span class="input-group-btn">
										<span class="btn btn-default btn-file no-pd-mg">
												<button type="button" class="btn btn-secondary">Browse</button>		
												<input type="file" id="imgInp">	
										</span>
									</span>
									<input type="text" class="form-control imgUrl" readonly placeholder="Imagem">
								</div>
								<img id='img-upload'/>
							</div>
						</div>
						<div class="col-lg-12">
							<ul>
								<li><a class="submit-post">Post</a></li>
								<li><a href="" title="" class="cancel-post">Cancel</a></li>
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
