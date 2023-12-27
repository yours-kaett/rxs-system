<?php
include 'database_connection.php';
session_start();
if (isset($_SESSION['id'])) {
?>
    <?php include 'includes/head.php' ?>

    <body>

        <?php include 'includes/header.php' ?>

        <section id="hero">
            <h2>Empower your game</h2>
            <h1>Unleash your style</h1>
            <div class="pro" onclick="window.location.href = 'shop.php';"><button>Shop Now</button>
        </section>

        <section id="feature" class="section-p1">
            <div class="fe-box">
                <h6>Customized Design</h6>
            </div>

            <div class="fe-box">
                <h6>High Quality Prints</h6>
            </div>

            <div class="fe-box">
                <h6>Quality Sewn</h6>
            </div>
            </div>
        </section>

        <section id="offer" class="section-p1">
            <div class="heading">
                <h4>We offer:</h4>
            </div>
            <div class="offer-box">
                <img src="IMG/features/offer1.jpg" alt="">
            </div>
            <div class="offer-box">
                <img src="IMG/features/offer2.jpg" alt="">
            </div>
            <div class="offer-box">
                <img src="IMG/features/offer3.jpg" alt="">
            </div>
            <div class="offer-box">
                <img src="IMG/features/offer4.jpg" alt="">
            </div>
            <h4>We also Offer:</h4>
            <p>T-shirt and Head cap printing</p>
        </section>

        <section id="product1" class="section-p1">
            <h2>Top Artist Created Apparels</h2>
            <p>Approved Modern Designs</p>
            <div class="pro-container">
                <div class="pro" onclick="window.location.href = 'sproduct2.php';">
                    <img src="IMG/products/TP1.jpg" alt="">
                    <div class="des">
                        <span>Full Sublimation Basketball Jersey</span>
                        <span>Jersey Code: TP0001</span>
                        <h4>₱000.00</h4>
                    </div>
                    <a href="cart.php"><i class="fa fa-shopping-cart cart" style="font-size:24px"></i></a>
                </div>
                <div class="pro" onclick="window.location.href = 'sproduct3.php';">
                    <img src="IMG/products/TP2.jpg" alt="">
                    <div class="des">
                        <span>Full Sublimation Basketball Jersey </span>
                        <span>Jersey Code: TP0002</span>
                        <h4>₱000.00</h4>
                    </div>
                    <a href="cart.php"><i class="fa fa-shopping-cart cart" style="font-size:24px"></i></a>
                </div>
                <div class="pro" onclick="window.location.href = 'sproduct5.php';">
                    <img src="IMG/products/TP3.jpg" alt="">
                    <div class="des">
                        <span>Full Sublimation Basketball Jersey</span>
                        <span>Jersey Code: TP0003</span>
                        <h4>₱000.00</h4>
                    </div>
                    <a href="cart.php"><i class="fa fa-shopping-cart cart" style="font-size:24px"></i></a>
                </div>
                <div class="pro" onclick="window.location.href = 'sproduct7.php'" ;>
                    <img src="IMG/products/TP4.jpg" alt="">
                    <div class="des">
                        <span>Full Sublimation Basketball Jersey</span>
                        <span>Jersey Code: TP0004</span>
                        <h4>₱000.00</h4>
                    </div>
                    <a href="cart.php"><i class="fa fa-shopping-cart cart" style="font-size:24px"></i></a>
                </div>
                <div class="pro" onclick="window.location.href = 'sproduct12.php';">
                    <img src="IMG/products/TP5.jpg" alt="">
                    <div class="des">
                        <span>Full Sublimation Basketball Jersey</span>
                        <span>Jersey Code: TP0005</span>
                        <h4>₱000.00</h4>
                    </div>
                    <a href="cart.php"><i class="fa fa-shopping-cart cart" style="font-size:24px"></i></a>
                </div>
                <div class="pro" onclick="window.location.href = 'sproduct13.php';">
                    <img src="IMG/products/TP6.jpg" alt="">
                    <div class="des">
                        <span>Full Sublimation Basketball Jersey</span>
                        <span>Jersey Code: TP0006</span>
                        <h4>₱000.00</h4>
                    </div>
                    <a href="cart.php"><i class="fa fa-shopping-cart cart" style="font-size:24px"></i></a>
                </div>
                <div class="pro" onclick="window.location.href = 'sproduct14.php';">
                    <img src="IMG/products/TP7.jpg" alt="">
                    <div class="des">
                        <span>Full Sublimation Basketball jersey</span>
                        <span>Jersey Code: TP0007</span>
                        <h4>₱000.00</h4>
                    </div>
                    <a href="cart.php"><i class="fa fa-shopping-cart cart" style="font-size:24px"></i></a>
                </div>
                <div class="pro" onclick="window.location.href = 'sproduct15.php';">
                    <img src="IMG/products/TP8.jpg" alt="">
                    <div class="des">
                        <span>Full Sublimation Basketball Jersey</span>
                        <span>Jersey Code: TP0008</span>
                        <h4>₱000.00</h4>
                    </div>
                    <a href="cart.php"><i class="fa fa-shopping-cart cart" style="font-size:24px"></i></a>
                </div>
            </div>
        </section>

        <section id="banner" class="section-m1">
            <h4>Express your creativity</h4>
            <h2>Through our<span> Design Tool</span> Kit</h2>
            <div class="pro" onclick="window.location.href = 'customize.php';"> <button>Go to customize page >></button>
        </section>

        <?php include 'includes/footer.php' ?>
        <script src="script.js"></script>
    </body>

    </html>

<?php
} else {
    header("Location: client-login.php");
    exit();
}
