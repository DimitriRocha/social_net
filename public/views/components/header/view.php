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
						<a href="index.html" title="">
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
								<h4>Setting</h4>
								<a href="#" title="">Clear all</a>
							</div>
							<div class="nott-list">
								<div class="notfication-details">
									<div class="noty-user-img">
										<img src="<?php echo "../".getImage("profilesIcon.png"); ?>" alt="">
									</div>
									<div class="notification-info">
										<h3><a href="#" title="">Jassica William</a> Comment on your project.</h3>
										<span>2 min ago</span>
									</div><!--notification-info -->
								</div>
								<div class="view-all-nots">
									<a href="#" title="">View All Notification</a>
								</div>
							</div><!--nott-list end-->
						</div><!--notification-box end-->
					</li>
				</ul>
			</nav><!--nav end-->
			<div class="menu-btn">
				<a href="#" title=""><i class="fa fa-bars"></i></a>
			</div><!--menu-btn end-->
			<div class="user-account">
				<div class="user-info">
					<img src="<?php echo getImage("profilesIcon.png"); ?>" alt="">
					<a href="#" title="">John</a>
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
					<h3 class="tc"><a href="sign-in.html" title="">Logout</a></h3>
				</div><!--user-account-settingss end-->
			</div>
		</div><!--header-data end-->
	</div>
</header><!--header end-->
