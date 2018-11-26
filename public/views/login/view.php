<?php if (isset($_SESSION['error']) && $_SESSION['error']): ?>
	<div class="alert alert-dismissible alert-warning m-3 position-absolute w-75" id="login-error" style="z-index: 100;left: 50%;transform: translateX(-50%);">
		<button data-dismiss="alert" type="button" class="close">×</button>
		Usuário ou senha incorretos!!!
	</div>
<?php endif; ?>

<div class="container">
	<div class="row">
		<div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
			<div class="card card-signin my-5">
				<div class="card-body">
					<h5 class="card-title text-center">Entrar</h5>
					<form class="form-signin" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
						<div class="form-label-group">
							<input type="text" name="nickname" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
							<label for="inputEmail">Nome de usuário</label>
						</div>
						<div class="form-label-group">
							<input type="password" name="pass" id="inputPassword" class="form-control" placeholder="Password" required>
							<label for="inputPassword">Senha</label>
						</div>
						<button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Entrar</button>
						<a class="text-light" href=<?php echo PROJECT_PATH."/register" ?>><button class="mt-3 btn btn-lg btn-primary btn-block text-uppercase" type="button">Cadastrar</button></a>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
