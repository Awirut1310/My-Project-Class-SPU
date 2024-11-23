<?php 

    session_start();
    include_once '../config/config.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TAXIFY</title>


  <link rel="stylesheet" href="../css/register.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>


  <div class="d-flex h-100 w-100 ">


    <main class="form-signin d-flex flex-column justify-content-center align-items-center vh-100 m-auto ">

      <!-- image logo  -->
      <div class="w-100 d-flex justify-content-center align-items-center">
        <img style="width: 80px; height: 80%; object-fit: cover;" src="../img/New logo.png" alt="">
        <h1 class="h1 w-100 fw-bold text-success  ">TAXIFY THAILAND</h1>
      </div>
      <!-- end -->

      <div class="spacing"></div>

      <form action="../config/register_db.php" method="POST">
        <h1 class="h1 fw-bold text-success font-bold mb-3 fw-normal w-100 d-flex justify-content-center align-items-center">Sign up</h1>
        <?php if(isset($_SESSION['success'])) { ?>
        <div class="alert alert-success" role="alert">
          <?php 
          echo $_SESSION['success'];
          unset($_SESSION['success']);
          ?>
        </div>
        <?php } ?>

        <?php if(isset($_SESSION['error'])) { ?>
        <div class="alert alert-danger" role="alert">
          <?php 
          echo $_SESSION['error'];
          unset($_SESSION['error']);
          ?>
        </div>
        <?php } ?>


        <div class="form-floating mb-2">
          <input type="text" class="form-control" id="username" name="username" placeholder="Your Username">
          <label for="username">Username</label>
        </div>

        <div class="form-floating mb-2">
          <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
          <label for="email">Email address</label>
        </div>

        <div class="form-floating mb-2">
          <input id="password" class="form-control" name="password" type="password" placeholder="Password">
          <label for="password">Password</label>
        </div>

        <div class="form-floating">
          <input id="Confirmpassword" class="form-control" name="confirm_password" type="password"
            placeholder="ConfirmPassword">
          <label for="Confirmpassword">Confrim Password</label>
        </div>

        <button class="mt-3 btn btn-primary w-100 py-2" name="register" type="submit">Register</button>
        <p class=" mt-1 text-body-secondary">Already have an Account? <a class="text-decoration-none" href="login.php">Chlick here</a>, Guest account?<a class="text-decoration-none" href="./home-page.php">Click here</a></p>
      </form>
    </main>

    <img src="../img/bg-login-1.jpg" alt="" class="d-none d-lg-block">
  </div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>