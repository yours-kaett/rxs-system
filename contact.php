<?php
include 'database_connection.php';
session_start();
if ($_SESSION['username'] && isset($_SESSION['id'])) {
?>
    <!DOCTYPE html>
    <html lang="en">
    <?php include 'includes/head.php' ?>

    <body>

        <?php include 'includes/header.php' ?>

        <section id="page-header">
            <h2>Let's Talk</h2>
            <p>We love to hear from you</p>
        </section>
        <section id="contact-details" class="section-p1">
            <div class="details">
                <span>GET IN TOUCH</span>
                <h2>Visit our shop or contact us</h2>
                <h3>Roxie's Full Sublimation Apparel Shop</h3>
                <div>
                    <li>
                        <img class="icon" src="IMG/products/map.jpg" alt="">
                        <p>Corner Quezon- Katalbas St., Sagay City, Philippines</p>
                    </li>
                    <li>
                        <img class="icon" src="IMG/products/gmail.jpg" alt="">
                        <p>resmundorogenilkillz@gmail.com</p>
                    </li>
                    <li>
                        <img class="icon" src="IMG/products/contact.jpg" alt="">
                        <p>0969 170 0569</p>
                    </li>
                    <li>
                        <img class="icon" src="IMG/products/clock.jpg" alt="">
                        <p>Always Open</p>
                    </li>
                </div>
            </div>
            <div class="map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d979.4786780223881!2d123.41476076951639!3d10.894086216264954!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a8dd35f47ca219%3A0x4550fa6a77fb24c5!2sQuezon%20St%2C%20Sagay%20City%2C%20Negros%20Occidental!5e0!3m2!1sen!2sph!4v1692594050751!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </section>

        <section id="form-details">
            <form action="">
                <span>LEAVE A MESSAGE</span>
                <h2> We love to hear from you</h2>
                <input type="text" placeholder="Your Name">
                <input type="text" placeholder="E-mail">
                <input type="text" placeholder="Subject">
                <textarea name="" id="" cols="30" rows="10" placeholder="Your Message"></textarea>
                <button class="normal">Submit</button>
            </form>

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
