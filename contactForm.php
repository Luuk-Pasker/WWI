<?php
$active = "about";
include "includes/header.php";
include "includes/footer.php";
?>
<!--fdjsi-->

<link rel="stylesheet" type="text/css" href="css/aboutus.css" xmlns="">
<a href="contactForm.php">
    <button class="button" type="submit">Contact Form</button>
</a>
<a href="guarantee.php">
    <button class='button' type="submit">Warranty</button>
</a>

<div class="row">
    <div class="column">
        <div class="contactinfo">

            <h2>Contact information:</h2>

            <h4>Wide World Importers bv<br>
                <br>
                Papendorpseweg 100<BR>
                3528 BJ Utrecht<BR>
                <br>
                Mail: wideworldimporters@gmail.com<BR>
                <BR>
                Phonenumber: 06-24533242
            </h4>
        </div>
    </div>

    <div class="double-column">

        <div class="contact" style="margin-left: 28%">

            <h2>Contact form</h2>

            <form method="post">
                <div class="contact-form-group">
                    <label for="subject" class="contact-form-label">Select your subject:</label>
                    <select id="subject" name="subject" class="contact-form-control">
                        <optgroup label="Choose subject"
                        </comment>
                        <option value="Delivery">Delivery</option>
                        <option value="General">General question</option>
                        <option value="Guarantee">Guarantee</option>
                        <option value="Order">Order</option>
                    </select>
                </div>

                <div class="contact-form-group">
                    <label for="message" class="contact-form-label">Message/Question:</label>
                    <textarea rows="4" cols="50" id="message" name="message" class="contact-form-control"></textarea>
                </div>
                <br>
                <br>
                <h2>Personal information</h2>

                <div class="contact-form-group">
                    <label for="salutation" class="contact-form-label">Salutation:</label>
                    <select id="salutation" class="contact-form-control">
                        <option value="Mr">Mr.</option>
                        <option value="Ms">Ms.</option>
                    </select>
                </div>

                <div class="contact-form-group">
                    <label for="first_name" class="contact-form-label">First name:</label>
                    <input type="text" id="first_name" name="fname" class="contact-form-control"/>
                </div>

                <div class="contact-form-group">
                    <label for="last_name" class="contact-form-label">Last name:</label>
                    <input type="text" id="last_name" name="lname" class="contact-form-control"/>
                </div>
                <br>
                <h2>Contact details</h2>

                <div class="contact-form-group">
                    <label for="email" class="contact-form-label">Email:</label>
                    <input type="email" id="email" name="email" class="contact-form-control"/>
                </div>

                <div class="contact-form-group">
                    <label for="phone_number" class="contact-form-label">Phone number:</label>
                    <input type="text" id="phone_number" name="phone" class="contact-form-control"/>
                </div>
                <br>
                <br>
                <br>
                <input type="submit" name="submit" value="Send"/>

            </form>

            <?php
            if (isset($_POST['submit'])) {
                if (empty($_POST['message'])) {
                    echo "Fill in your message!";
                } elseif (empty($_POST['fname'])) {
                    echo "Fill in your first name!";
                } elseif (empty($_POST['lname'])) {
                    echo "Fill in your last name!";
                } elseif (empty($_POST['email'])) {
                    echo "Fill in email address!";
                } elseif (empty($_POST['phone'])) {
                    echo "Fill in phone number!";
                }else {
                    $name = $_POST['fname'] . " " . $_POST['lname'];
                    $sql = "INSERT INTO contact (subject, name, email, phoneNumber, message) VALUES (?, ?, ?, ?, ?)";

                    $stmt = $connection->prepare($sql);
                    $stmt->bind_param('sssss', $_POST['subject'], $name, $_POST['email'], $_POST['phone'], $_POST['message']);
                    $stmt->execute();
                    echo "Your message has been send!";
                }
            }
            ?>

        </div>
    </div>

    <div class="column">
    </div>
</div>

<?php
include "includes/footer.php";
?>
