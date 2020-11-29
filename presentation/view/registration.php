<!DOCTYPE html>
<html>

	<head>
		<link rel="stylesheet" type="text/css" href="/presentation/css/style.css">
		<title>Registration</title>
	</head>
	
	<body>
		<div class="form-signin">
            <form action="/presentation/handlers/registrationHandler.php" method="POST">
            	<h2>Register New Account</h2>

              <div class="form-group">
                <label for="email"></label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Email Address">
              </div>
              
              <div class="form-group">
                <label for="username"></label>
                <input type="text" name="userName" id="username" placeholder="Username">
              </div>
              
              <div class="form-group">
                <label for="password"></label>
                <input type="password" name="password1" id="password" placeholder="password">
              </div>
              
              <div class="form-group">
                <label for="Re-enter Password"></label>
                <input type="password" name="passsword2" id="password2" placeholder="Re-enter Password">
              </div>
			  
			  <div class="form-group">
                <button type="submit" class="btn btn-primary">Register</button>
              </div>
              
            </form>
        </div>
    </body>
    
</html>
