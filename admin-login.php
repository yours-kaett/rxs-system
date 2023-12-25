<?php
include 'database_connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php' ?>

<body>

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
                        <button id="submit" class="btn-login p-3 w-100 me-5 d-flex align-items-center justify-content-center bg-secondary" type="submit" onclick="submitFn()">
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