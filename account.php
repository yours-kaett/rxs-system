<?php
include 'database_connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php' ?>

<body>

  <?php include 'includes/header.php' ?>

  <section id="account">
    <div class="bg-img">
      <div class="content">
        <header>Login Form</header>
        <form action="#">
          <div class="field">
            <span class="fa fa-user"></span>
            <input type="text" required placeholder="Email or Phone">
          </div>
          <div class="field space">
            <span class="fa fa-lock"></span>
            <input type="password" class="pass-key" required placeholder="Password">
            <span class="show">SHOW</span>
          </div>
          <div class="pass">
            <a href="#">Forgot Password?</a>
          </div>
          <div class="field">
            <input type="submit" value="LOGIN">
          </div>
        </form>
        <div class="login">Or login with</div>
        <div class="links">
          <div class="facebook">
            <i class="fa fa-facebook-official" style="font-size: 40px ;color: #3b5998"></i><span>Facebook</span></i>
          </div>
          <div class="google">
            <i class="fa fa-google" style="font-size:40px;color: #F7B529"></i><span>Google</span></i>
          </div>
        </div>
        <div class="signup">Don't have account?
          <div class="sign" onclick="window.location.href = 'signup.html';">
            <a href="#">Signup Now</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script>
    const pass_field = document.querySelector('.pass-key');
    const showBtn = document.querySelector('.show');
    showBtn.addEventListener('click', function() {
      if (pass_field.type === "password") {
        pass_field.type = "text";
        showBtn.textContent = "HIDE";
        showBtn.style.color = "#3498db";
      } else {
        pass_field.type = "password";
        showBtn.textContent = "SHOW";
        showBtn.style.color = "#222";
      }
    });
  </script>
  <footer class="section-p1">
    <div class="col">
      <img class="logo" src="IMG/LOGO.png" alt="">
      <h4>Contact</h4>
      <p><strong>Address:</strong> Corner Quezon- Katalbas St. 6122 Sagay City, Philippines</p>
      <p><strong>Phone:</strong> 0969 170 0569</p>
      <p><strong>Hours:</strong> Always Open</p>
      <h4>Follow Us</h4>
      <div class="icon">
        <i class="fa fa-facebook-f" style="font-size:24px"></i>
        <i class="fa fa-twitter" style="font-size:24px"></i>
        <i class="fa fa-youtube-play" style="font-size:24px"></i>
        <i class="fa fa-pinterest-p" style="font-size:24px"></i>
        <i class="fa fa-instagram" style="font-size:24px"></i>
      </div>
    </div>
    <div class="col">
      <h4>About Us</h4>
      <a href="#">Privacy Policy</a>
      <a href="#">Terms & Conditions</a>
      <a href="#">Contact Us</a>
    </div>
    <div class="col">
      <h4>My Account</h4>
      <a href="#">Sign In</a>
      <a href="#">View Cart</a>
      <a href="#">My Saved Designs</a>
      <a href="#">Track My Order</a>
      <a href="#">Help</a>
    </div>
    <div class="col">
      <h4>Secure Payment Gateways</h4>
      <div class="row">
        <img src="IMG/products/gcash.png">
      </div>
    </div>
    <div class="copyright">
      <p>2023, Roxie Full Sublimation Apparel</p>
    </div>
  </footer>


  <script src="script.js"></script>
</body>

</html>