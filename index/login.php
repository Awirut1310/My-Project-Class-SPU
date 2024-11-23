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
<body >

  <div class="d-flex h-100 w-100 ">
    <img src="../img/bg-login-1.jpg" alt="" class="d-none d-lg-block">

    <main class="form-signin d-flex flex-column justify-content-center align-items-center vh-100 m-auto ">

      <!-- image logo  -->
      <div class="w-100 mb-3 d-flex justify-content-center align-items-center">
        <img style="width: 80px; height: 80%; object-fit: cover;" src="../img/New logo.png" alt="">
        <h1 class="h1 w-100 fw-bold text-success  ">TAXIFY THAILAND</h1>
      </div>
      <!-- end -->

      <div class="spacing"></div>
     

      <form action="../config/login_db.php" method="POST">
        <h1 class="h1 fw-bold text-success font-bold mb-3 fw-normal w-100 d-flex justify-content-center align-items-center">Sign in</h1>

        <?php if(isset($_SESSION['error'])) { ?>
        <div class="alert alert-danger" role="alert">
          <?php 
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
        </div>
        <?php } ?>

        <div class="form-floating my-3">
          <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com">
          <label for="email">Email address</label>
        </div>
        <div class="form-floating ">
          <input type="password" class="form-control" name="password" id="password" placeholder="Password">
          <label for="password">Password</label>
        </div>

        <div class="form-check text-start mt-1 mb-3">
          <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
          <label class="form-check-label" for="flexCheckDefault">
            Remember me
          </label>
        </div>
        <button class="btn btn-primary w-100 py-2" type="submit" name="login">Get start</button>
        <p class="text-Secondary fs-6 mt-1 text-body-secondary">Don't have an account yet? <a class="text-decoration-none" href="register.php">Click here</a>, Guest account?<a class="text-decoration-none" href="./home-page.php">Click here</a></p>
      </form>
    </main>
  </div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>