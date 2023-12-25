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
                <header>Login</header>
                <?php
                if (isset($_GET['invalid'])) {
                ?>
                    <p class="d-flex align-items-center justify-content-between text-white bg-danger p-2" id="invalid" role="alert">
                        <i class="bi bi-exclamation-diamond"></i>
                        <span><?php echo $_GET['invalid'], 'Invalid username or password' ?></span>
                        <a href="client-login.php" class="text-white">
                            <i class="bi bi-x fs-5"></i>
                        </a>
                    </p>
                <?php
                }
                ?>
                <?php
                if (isset($_GET['success'])) {
                ?>
                    <p class="d-flex align-items-center justify-content-center text-white bg-success p-2" id="success" role="alert">
                        <span><?php echo $_GET['success'], 'Account created successfully.' ?></span>
                    </p>
                <?php
                }
                ?>
                <form action="checking/client-login-check.php" method="POST">
                    <div class="field mb-2">
                        <span class="bi bi-hash"></span>
                        <input type="text" name="username" id="username" placeholder="Username" required>
                    </div>
                    <div class="field mb-2">
                        <span class="bi bi-lock"></span>
                        <input type="password" name="password" id="password" class="pass-key" placeholder="Password" required>
                        <span class="show">SHOW</span>
                    </div>
                    <div class="">
                        <button id="submit" type="submit" class="btn-login p-3 w-100 me-5 d-flex align-items-center justify-content-center bg-secondary" onclick="submitFn()">
                            <span id="login">Login</span>
                            <span id="spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        </button>
                    </div>
                </form>
                <div class="signup mt-3">
                    Doesn't have an account? <a href="client-signup.php">Signup here.</a>
                </div>
            </div>
        </div>
    </section>
    <footer class="section-p1">
        <div class="col">
            <img class="logo" src="IMG/LOGO.png" alt="">
            <h4>Contact</h4>
            <p><strong>Address:</strong> Corner Quezon- Katalbas St. 6122 Sagay City, Philippines</p>
            <p><strong>Phone:</strong> 0969 170 0569</p>
            <p><strong>Hours:</strong> Always Open</p>
            <h4>Follow Us</h4>
            <div class="icon">
                <i class="bi bi-facebook" style="font-size:24px"></i>
                <i class="bi bi-twitter" style="font-size:24px"></i>
                <i class="bi bi-youtube-play" style="font-size:24px"></i>
                <i class="bi bi-pinterest-p" style="font-size:24px"></i>
                <i class="bi bi-instagram" style="font-size:24px"></i>
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

    <script>
        let username = document.getElementById("username");
        let password = document.getElementById("password");
        let submit = document.getElementById("submit");

        function login_data() {
            const usernameValue = username.value.trim();
            const passwordValue = password.value.trim();
            if (usernameValue !== '' && passwordValue !== '') {
                submit.removeAttribute('disabled');
                submit.classList.remove("bg-secondary");
                submit.style.color = "#d9fef2";
                submit.style.cursor = "pointer";
            } else {
                submit.setAttribute('disabled', 'disabled');
                submit.classList.add("bg-secondary");
                submit.style.color = "#cccccc";
                submit.style.cursor = "not-allowed";
            }
        }
        username.addEventListener("input", login_data);
        password.addEventListener("input", login_data);
        login_data();


        function submitFn() {
            document.getElementById('login').style.display = "none"
            document.getElementById('spinner').style.display = "flex"
            document.getElementById('spinner').style.alignItems = "center"
            document.getElementById('spinner').style.justifyContent = "center"
        }
    </script>
</body>

</html>