<div class="container">
   <div class="row">
	 <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
	   <div class="card card-signin my-5">
		 <div class="card-body">
		   <h5 class="card-title text-center">Cadastrar</h5>
		   <form class="form-signin" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
			 <div class="form-label-group">
			   <input type="text" name="name" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
			   <label for="inputEmail">Nome completo</label>
			 </div>
			 <div class="form-label-group">
			   <input type="text" name="user" id="inputUser" class="form-control" placeholder="User Name" required>
			   <label for="inputUser">Username</label>
			 </div>
			 <div class="form-label-group">
			   <input type="password" name="pass" id="inputPassword" class="form-control" placeholder="Password" required>
			   <label for="inputPassword">Senha</label>
			 </div>
			 <div class="form-label-group">
			   <input type="text" name="occupation" id="inputOccupation" class="form-control" placeholder="Occupation" required>
			   <label for="inputOccupation">Ocupação</label>
			 </div>
			 <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Cadastrar</button>
		   </form>
		 </div>
	   </div>
	 </div>
   </div>
 </div>
