<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>RXS</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link href="assets/img/logo.png" rel="icon">
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <img src="assets/img/logo.png" width="100" alt="RXS Logo">
              </div>

              <div class="card mb-3">
                <?php
                if (isset($_GET['taken'])) {
                ?>
                  <div class="d-flex align-items-center justify-content-between text-white bg-danger p-2" id="invalid" role="alert">
                    <i class="bi bi-exclamation-diamond"></i>
                    <span><?php echo $_GET['taken'], 'Username already taken.' ?></span>
                    <a href="index.php" class="text-white">
                      <i class="bi bi-x fs-5"></i>
                    </a>
                  </div>
                <?php
                }
                if (isset($_GET['unknown'])) {
                ?>
                  <div class="d-flex align-items-center justify-content-between text-white bg-danger p-2" id="invalid" role="alert">
                    <i class="bi bi-exclamation-diamond"></i>
                    <span><?php echo $_GET['unknown'], 'Unknown error occured!' ?></span>
                    <a href="index.php" class="text-white">
                      <i class="bi bi-x fs-5"></i>
                    </a>
                  </div>
                <?php
                }
                ?>
                <?php
                if (isset($_GET['success'])) {
                ?>
                  <div class="d-flex align-items-center justify-content-between text-white bg-success p-2" id="invalid" role="alert">
                    <i class="bi bi-check"></i>
                    <span><?php echo $_GET['success'], 'Account created successfully' ?></span>
                    <a href="index.php" class="text-white">
                      <i class="bi bi-x fs-5"></i>
                    </a>
                  </div>
                <?php
                }
                ?>

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                  </div>

                  <form action="admin-signup-check.php" method="post" class="row g-3">

                    <div class="col-12">
                      <label for="email" class="form-label">Email</label>
                      <input type="email" name="email" class="form-control" id="email" required>
                    </div>

                    <div class="col-12">
                      <label for="username" class="form-label">Username</label>
                      <input type="text" name="username" class="form-control" id="username" required>
                    </div>

                    <div class="col-12">
                      <label for="password" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="password" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                      <button class="add-cart-btn w-100" type="submit">Create Account</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Already have an account? <a href="index.php">Log in</a></p>
                    </div>
                  </form>

                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="assets/js/main.js"></script>

</body>

</html>