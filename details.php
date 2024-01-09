<?php
include 'database_connection.php';
session_start();
if ($_SESSION['username'] && isset($_SESSION['id'])) {
    $get_id = $_GET['id'];
?>
    <!DOCTYPE html>
    <html lang="en">
    <?php include 'includes/head.php' ?>

    <body>
        <?php include 'includes/header.php' ?>
        <?php
        $stmt = $conn->prepare(' SELECT 
                tbl_shirt.id,
                tbl_shirt.img_url,
                tbl_shirt.shirt_title,
                tbl_shirt.shirt_code,
                tbl_shirt.shirt_price,
                tbl_shirt.jersey_type_id,
                tbl_shirt_category.shirt_category,
                tbl_jersey_type.jersey_type
                FROM tbl_shirt
                INNER JOIN tbl_shirt_category ON tbl_shirt.shirt_category_id = tbl_shirt_category.id
                INNER JOIN tbl_jersey_type ON tbl_shirt.jersey_type_id = tbl_jersey_type.id
                WHERE tbl_shirt.id = ? ');
        $stmt->bind_param('i', $get_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $img_url = $row['img_url'];
        $shirt_title = $row['shirt_title'];
        $shirt_price = $row['shirt_price'];
        $shirt_code = $row['shirt_code'];
        $shirt_category = $row['shirt_category'];
        $jersey_type = $row['jersey_type'];
        $jersey_type_id = $row['jersey_type_id'];
        ?>

        <section id="pro-details" class="section-p1">
            <?php
            if (isset($_GET['success'])) {
            ?>
                <div class="alert alert-success d-flex align-items-center justify-content-between p-4" role="alert">
                    <span><?php echo $_GET['success'], 'Added to Cart successfully.' ?></span>
                    <a href="details.php?id=<?php echo $get_id ?>" class="btn-close"></a>
                </div>
            <?php
            }
            ?>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                    <div class="card p-5">
                        <img src="IMG/products/<?php echo $img_url ?>" style="border-radius: 7px; width: 100%;" alt="Shirt Image">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card p-4">
                                <h5 class="mt-4"><?php echo $shirt_title ?></h5>
                                <h3 class="price-text mt-3" id="price">₱ <?php echo $shirt_price ?></h3>
                                <h6 class="mt-3 text-secondary">Code: <?php echo $shirt_code ?></h6>
                                <h6 class="mt-3 text-secondary">Category: <?php echo $shirt_category ?></h6>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 mt-3">
                            <div class="card p-4">
                                <form action="checking/add-to-cart.php?id=<?php echo $get_id ?>" method="POST" class="mt-3">
                                    <div class="row mb-3">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group mb-1">
                                                <label for="team_name">Team Name:</label>
                                                <input type="text" name="team_name" value="<?php echo $team_name ?>" id="team_name" class="form-control w-100" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label for="jersey_type_id">Jersey Type:</label>
                                                <select class="form-select w-100" name="jersey_type_id" id="jersey_type_id">
                                                    <option value="<?php echo $jersey_type_id ?>"><?php echo $jersey_type ?></option>
                                                    <?php
                                                    $stmt = $conn->prepare(' SELECT * FROM tbl_jersey_type ');
                                                    $stmt->execute();
                                                    $result = $stmt->get_result();
                                                    while ($row = $result->fetch_assoc()) {
                                                        $id = $row['id'];
                                                        $jersey_type = $row['jersey_type'];
                                                        echo '<option value="' . $id . '">' . $jersey_type . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="player">
                                        <div id="rows-container"></div>
                                        <button class="btn btn-primary btn-sm" id="addRow" type="button">
                                            <i class="bi bi-plus-lg"></i>&nbsp; Add Member
                                        </button>
                                        <div class="d-flex align-items-center justify-content-end mt-3">
                                            <button class="add-cart-btn" type="submit" id="submit" style="display: none;" data-bs-toggle="modal" data-bs-target="#addToCartModal">
                                                <i class="bi bi-cart"></i>&nbsp;Add to Cart
                                            </button>
                                        </div>
                                    </div>
                                    <!-- <p class="mt-5"><em>Note: For order confirmation, please pay downpayment (half of the total price)</em></p> -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="product1" class="section-p1">
            <h2>Featured Apparels</h2>
            <p>Full Sublimation Basketball and Volleyball Jerseys</p>
            <div class="pro-container">
                <div class="pro">
                    <img src="IMG/products/P2.jpg" alt="">
                    <div class="des">
                        <span>Full Sublimation Basketball Jersey </span>
                        <h5>Busay Tequilla</h5>
                        <div class="star">
                            <i class="fa fa-star-o" style="font-size:30px"></i>
                            <i class="fa fa-star-o" style="font-size:30px"></i>
                            <i class="fa fa-star-o" style="font-size:30px"></i>
                            <i class="fa fa-star-o" style="font-size:30px"></i>
                            <i class="fa fa-star-o" style="font-size:30px"></i>
                        </div>
                        <h4>₱000.00</h4>
                    </div>
                    <a href="cart.html"><i class="fa fa-shopping-cart cart" style="font-size:24px"></i></a>
                </div>
                <div class="pro">
                    <img src="IMG/products/P3.jpg" alt="">
                    <div class="des">
                        <span>Full Sublimation Volleyball Jersey</span>
                        <h5>Resilient'</h5>
                        <div class="star">
                            <i class="fa fa-star-o" style="font-size:30px"></i>
                            <i class="fa fa-star-o" style="font-size:30px"></i>
                            <i class="fa fa-star-o" style="font-size:30px"></i>
                            <i class="fa fa-star-o" style="font-size:30px"></i>
                            <i class="fa fa-star-o" style="font-size:30px"></i>
                        </div>
                        <h4>₱000.00</h4>
                    </div>
                    <a href="cart.html"><i class="fa fa-shopping-cart cart" style="font-size:24px"></i></a>
                </div>
                <div class="pro">
                    <img src="IMG/products/P4.jpg" alt="">
                    <div class="des">
                        <span>Full Sublimation Volleyball Jersey</span>
                        <h5>LadyBall Archer</h5>
                        <div class="star">
                            <i class="fa fa-star-o" style="font-size:30px"></i>
                            <i class="fa fa-star-o" style="font-size:30px"></i>
                            <i class="fa fa-star-o" style="font-size:30px"></i>
                            <i class="fa fa-star-o" style="font-size:30px"></i>
                            <i class="fa fa-star-o" style="font-size:30px"></i>
                        </div>
                        <h4>₱000.00</h4>
                    </div>
                    <a href="cart.html"><i class="fa fa-shopping-cart cart" style="font-size:24px"></i></a>
                </div>
                <div class="pro">
                    <img src="IMG/products/P5.jpg" alt="">
                    <div class="des">
                        <span>Full Sublimation Basketball Jersey</span>
                        <h5>FlourMillian</h5>
                        <div class="star">
                            <i class="fa fa-star-o" style="font-size:30px"></i>
                            <i class="fa fa-star-o" style="font-size:30px"></i>
                            <i class="fa fa-star-o" style="font-size:30px"></i>
                            <i class="fa fa-star-o" style="font-size:30px"></i>
                            <i class="fa fa-star-o" style="font-size:30px"></i>
                        </div>
                        <h4>₱000.00</h4>
                    </div>
                    <a href="cart.html"><i class="fa fa-shopping-cart cart" style="font-size:24px"></i></a>
                </div>
                <div class="pro">
                    <img src="IMG/products/P6.jpg" alt="">
                    <div class="des">
                        <span>Full Sublimation Basketball Jersey</span>
                        <h5>Cabalawan</h5>
                        <div class="star">
                            <i class="fa fa-star-o" style="font-size:30px"></i>
                            <i class="fa fa-star-o" style="font-size:30px"></i>
                            <i class="fa fa-star-o" style="font-size:30px"></i>
                            <i class="fa fa-star-o" style="font-size:30px"></i>
                            <i class="fa fa-star-o" style="font-size:30px"></i>
                        </div>
                        <h4>₱000.00</h4>
                    </div>
                    <a href="cart.html"><i class="fa fa-shopping-cart cart" style="font-size:24px"></i></a>
                </div>
                <div class="pro">
                    <img src="IMG/products/P7.jpg" alt="">
                    <div class="des">
                        <span>Full Sublimation Volleyball jersey</span>
                        <h5>Dependents</h5>
                        <div class="star">
                            <i class="fa fa-star-o" style="font-size:30px"></i>
                            <i class="fa fa-star-o" style="font-size:30px"></i>
                            <i class="fa fa-star-o" style="font-size:30px"></i>
                            <i class="fa fa-star-o" style="font-size:30px"></i>
                            <i class="fa fa-star-o" style="font-size:30px"></i>
                        </div>
                        <h4>₱000.00</h4>
                    </div>
                    <a href="cart.html"><i class="fa fa-shopping-cart cart" style="font-size:24px"></i></a>
                </div>
            </div>
        </section>

        <?php include 'includes/footer.php' ?>

        <script src="script.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const addRowButton = document.getElementById("addRow");
                const rowsContainer = document.getElementById("rows-container");
                let rowCounter = 0;
                addRowButton.addEventListener("click", function() {
                    const newRow = document.createElement("div");
                    newRow.classList.add("row", "d-flex", "align-items-end");
                    newRow.innerHTML = `
                        <div class="col-lg-4 col-md-4 mb-2">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name[]" id="name" autocomplete="name" placeholder="ex. Dela Cruz" class="form-control w-100" required />
                            </div>
                            </div>
                        <div class="col-lg-3 col-md-3 mb-2">
                            <div class="form-group">
                                <label for="jersey_number">Jersey #</label>
                                <input type="number" name="jersey_number[]" id="jersey_number" autocomplete="jersey_number" placeholder="ex. 04" class="form-control w-100" required />
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 mb-2">
                            <div class="form-group">
                                <label for="size_id">Size</label>
                                <select class="form-control" name="size_id[]" id="size_id" required>
                                    <?php
                                    $stmt = $conn->prepare('SELECT * FROM tbl_size');
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    while ($row = $result->fetch_assoc()) {
                                        $id = $row['id'];
                                        $size = $row['size'];
                                        echo '<option value="' . $id . '">' . $size . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-1 mb-2">
                            <div class="form-group">
                                <button class="btn btn-danger" id="remove_member">
                                    <i class="bi bi-trash"></i>
                                </button>
                            <div>
                        </div>
                    `;
                    rowsContainer.appendChild(newRow);
                    rowCounter++;
                    
                    const removeButton = newRow.querySelector("#remove_member");
                    removeButton.addEventListener("click", function() {
                        rowsContainer.removeChild(newRow);
                        rowCounter--;
                    });

                    let name = document.getElementById("name");
                    let jersey_number = document.getElementById("jersey_number");
                    let submit = document.getElementById("submit");
                    if (name.value !== '' && jersey_number.value !== '') {
                        submit.style.display = "flex";
                    }
                });
            });
        </script>

        <script>
            let name = document.getElementById("name");
            let jersey_number = document.getElementById("jersey_number");
            let submit = document.getElementById("submit");

            function p_order() {
                const nameValue = name.value.trim();
                const jersey_numberValue = jersey_number.value.trim();
                if (nameValue !== '' && jersey_numberValue !== '') {
                    submit.removeAttribute('disabled');
                    submit.style.backgroundColor = "#004f00";
                    submit.style.color = "#fff";
                    submit.style.cursor = "pointer";
                } else {
                    submit.setAttribute('disabled', 'disabled');
                    submit.style.backgroundColor = "#cccccc";
                    submit.style.color = "gray";
                    submit.style.cursor = "not-allowed";
                }
            }
            name.addEventListener("input", p_order);
            jersey_number.addEventListener("input", p_order);
            p_order();
        </script>

    </body>

    </html>

<?php
} else {
    header("Location: client-login.php");
    exit();
}
