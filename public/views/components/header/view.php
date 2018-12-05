<?php global $data; ?>
<header>
	<div class="container clearfix">
		<div class="header-data">
			<div class="logo">
				<a href="index.html" title=""> <h2 class="text-white">Logo</h2> </a>
			</div><!--logo end-->
			<div class="search-bar">
				<form>
					<input type="text" name="search" placeholder="Search...">
					<button type="submit"><i class="la la-search"></i></button>
				</form>
			</div><!--search-bar end-->
			<nav>
				<ul>
					<li>
						<a href="<?php echo PROJECT_PATH."/" ?>" title="">
							<span><img src="<?php echo "../".getImage("icon1.png"); ?>" alt=""></span>
							Home
						</a>
					</li>
					<li>
						<a href="#" title="" class="not-box-open">
							<span><img src="<?php echo "../".getImage("lightningIcon.png"); ?>" alt=""></span>
							Notification
						</a>
						<div class="notification-box">
							<div class="nt-title">
								<a href="#" title="">Rejeitar todos</a>
							</div>
							<div class="nott-list">
								<div class="notfication-details">
									<?php if (!empty($data['pendingFriends'])): ?>
										<?php foreach ($data['pendingFriends'] as $key => $friend): ?>
											<div class="notification-info mb-3 w-100">
												<div class="float-left">
													<h3><a href="<?php echo PROJECT_PATH."/start/profile/$friend[id]" ?>" title=""><?php echo $friend['name'] ?></a></h3>
												</div>
												<div class="float-right">
													<a class="text-dark" href="<?php echo PROJECT_PATH."/start/acceptFriend/".$friend['relationId'] ?>">Aceitar | </a>
													<a class="text-dark" href="<?php echo PROJECT_PATH."/start/refuseFriend/".$friend['relationId'] ?>">Recusar</a>
												</div>
											</div>
										<?php endforeach; ?>
									<?php else: ?>
										<div class="notification-info">
											<div class="text-center">
												<h3>Não há solicitações pendentes</h3>
											</div>
										</div>
									<?php endif; ?>
								</div>
								<div class="view-all-nots">
									<a href="#" title="">View All Notification</a>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</nav>
			<div class="menu-btn">
				<a href="#" title=""><i class="fa fa-bars"></i></a>
			</div>
			<div class="user-account">
				<div class="user-info">
					<img src="<?php echo getImage("profilesIcon.png"); ?>" alt="">
					<a href="#" title="">Perfil</a>
					<i class="la la-sort-down"></i>
				</div>
				<div class="user-account-settingss">
					<h3>Online Status</h3>
					<ul class="on-off-status">
						<li>
							<div class="fgt-sec">
								<input type="radio" name="cc" id="c5">
								<label for="c5">
									<span></span>
								</label>
								<small>Online</small>
							</div>
						</li>
						<li>
							<div class="fgt-sec">
								<input type="radio" name="cc" id="c6">
								<label for="c6">
									<span></span>
								</label>
								<small>Offline</small>
							</div>
						</li>
					</ul>
					<h3>Custom Status</h3>
					<div class="search_form">
						<form>
							<input type="text" name="search">
							<button type="submit">Ok</button>
						</form>
					</div><!--search_form end-->
					<h3>Setting</h3>
					<ul class="us-links">
						<li><a href="profile-account-setting.html" title="">Account Setting</a></li>
						<li><a href="#" title="">Privacy</a></li>
						<li><a href="#" title="">Faqs</a></li>
						<li><a href="#" title="">Terms &amp; Conditions</a></li>
					</ul>
					<h3 class="tc"><a href="" title="" class="btn-logOut">Logout</a></h3>
				</div><!--user-account-settingss end-->
			</div>
		</div><!--header-data end-->
	</div>
</header><!--header end-->
