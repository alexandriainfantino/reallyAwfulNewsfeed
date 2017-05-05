<html>
<head>

</head>

   <body>
      
      <h2>Enter Username and Password</h2> 
      <div>
      <?php
	session_start();
	if (isset($_POST['login']) && !empty($_POST['username']) 
               && !empty($_POST['password'])) {
		if ( $_POST['password'] == $_SESSION[$_POST['username']]) {
			$_SESSION['username'] = $_POST['username'];
			?>
				<script>
					window.location = "http://www.se.rit.edu/~asi8443/newsFeed/newsFeed.php";
				</script>
			<?php
		}
	}
      ?> 
      </div> <!-- /container -->
      
      <div class = "container">
      
         <form class = "form-signin" role = "form" 
            action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>" method = "post">
            <h4 class = "form-signin-heading"><?php echo $msg; ?></h4>
            <input placeholder="username" type = "text" name = "username" required autofocus></br>
            <input placeholder="password" type = "password"  name = "password" required>
	    <br>
            <button class = "btn btn-lg btn-primary btn-block" type = "submit" 
               name = "login">Login</button>
         </form>
			
         Click here to make a  <a href = "makeUser.php">New Account</a>
         
      </div> 
  

   </body>
</html>
