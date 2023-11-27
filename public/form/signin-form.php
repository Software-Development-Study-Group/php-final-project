<?php session_start(); ?>
<html>
  <head>
  <?php
  include_once __DIR__ . '\..\template\head.php' ;
  ?>

      <title>SignIn</title>
      <style>
        body{
          background-color: #5775FF;
        }
        #title{
          padding:30px;
          color:white;
        }
        #changePassword{
          padding-top:5px;
          text-align: center;
          color: white;
        }
        .form-floating {
          padding: 5px;
        }
        #buttonSubmit {
          background-color: #F7A52D;
          color:white;
          margin-top:10px;
          border: 0px;
        }
        #signIn{
          color: white;
          border: 0px;
        }
        #buttonRegister{
          background-color: #8F3AC6;
        }
      </style>
  </head>
  <body>
      <h1 class="display-3 text-center" id="title">Let's play!</h1>

      <main class="form-signin w-100 m-auto">
          <form action=<?= FEATURES . "signin.php" ?> method="post">
            <h1 class="h3 mb-3 fw-normal" id="signIn">Please sign in</h1>
        
            <div class="form-floating">
              <input type="username" class="form-control" id="floatingInput" placeholder="Username" name="username" value="<?= empty($_SESSION['username']) ? "" :  $_SESSION['username'] ?>">
              <label for="floatingInput">Username</label>
            </div>
            <div class="form-floating">
              <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" value="<?= empty($_SESSION['password']) ? "" :  $_SESSION['password'] ?>">
              <label for="floatingPassword">Password</label>
            </div>
<<<<<<< HEAD
            <?php if (!empty($_SESSION["signin_error_msg"])) { echo $_SESSION["signin_error_msg"] . "<br/>";} ?>
=======
            <div class="fw-bold mx-2" style="color: #FBBE62">
              <?php if (!empty($_SESSION["singin_error_msg"])) { echo $_SESSION["singin_error_msg"] . "<br/>";} ?>
            </div>
            
>>>>>>> 0016cb958b8a0cb81734182243736a13b013092e
        
            <button class="btn btn-primary w-100 py-2" id="buttonSubmit" type="submit"  name="send">Sign in</button>

          </form>
          <button class="btn btn-primary w-100 py-2" id= "buttonRegister" onclick="window.location.href = 'signup-form.php';">Register</button>

        </main>
        <div class="d-flex justify-content-center">
          <a href="pw-update-form.php" class="h6" id="changePassword">Forgot password?</a>
      </div>

  </body>
  </html>
<?php
  if (!empty($_SESSION["signin_error_msg"])) { unset($_SESSION['signin_error_msg']);}
  if (!empty($_SESSION["username"])) { unset($_SESSION['username']);}
  if (!empty($_SESSION["password"])) { unset($_SESSION['password']);}
?>