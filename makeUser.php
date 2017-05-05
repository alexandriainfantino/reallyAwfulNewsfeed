<html>
<head>

</head>

   <body>
      
      <h2>Create a username and password</h2> 
      <div>
         
<?php

// Start the session
session_start();


            $msg = '';
            
            if (isset($_POST['login']) && !empty($_POST['username']) 
               && !empty($_POST['password'])) {
				
               if ( isset($_POST['password'])) { 
//                  	$_SESSION['valid'] = true;
//                  	$_SESSION['timeout'] = time();
                  	$_SESSION[$_POST['username']] = $_POST['password'];
			$sessionStore = $_POST['username'] . "lastVisit";
			$_SESSION[$sessionStore] = "never";


               ?>
                  <h2>You have created an account, click here to login</h2>
                  <a href="login.php">Click here to login</a>

<?php
               }else {
                  $msg = 'Wrong username or password';
               }
            }
         ?>
      </div> <!-- /container -->
      
      <div class = "container">
      
         <form class = "form-signin" role = "form" 
            action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>" method = "post">
            <h4 class = "form-signin-heading"><?php echo $msg; ?></h4>
            <input type = "text" name = "username" required autofocus placeholder="username"></br>
            <input type = "password"  name = "password" required placeholder="password">
	    <br>
            <button class = "btn btn-lg btn-primary btn-block" type = "submit" 
               name = "login">Create</button>
         </form>
			
         
      </div> 

   </body>
</html>
