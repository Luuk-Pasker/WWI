<?php
$active = "about";
include "includes/header.php";
?>

<link rel="stylesheet" type="text/css" href="css/aboutus.css" xmlns="">
<a href="contactForm.php" ><button class="button" type="submit">Contact Form</button> </a>
<a href="guarantee.php" ><button class='button' type="submit">Guarantee </button></a>

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

        <div class="contact">

            <h2>Contact form</h2>

            <div class="contact-form-group">
                <label for="subject" class="contact-form-label">Select your subject:</label>
                <select id="subject" class="contact-form-control">
                    <optgroup label="Choose subject"</comment>
                    <option value="Delivery">Delivery</option>
                    <option value="General">General question</option>
                    <option value="Guarantee">Guarantee</option>
                    <option value="Order">Order</option>
                </select>
            </div>

            <div class="contact-form-group">
                <label for="message" class="contact-form-label">Message/Question:</label>
                <textarea rows="4" cols="50" id="message" class="contact-form-control"></textarea>
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
            <input type="text" id="first_name" class="contact-form-control"/>
            </div>

            <div class="contact-form-group">
            <label for="last_name" class="contact-form-label">Last name:</label>
            <input type="text" id="last_name" class="contact-form-control"/>
            </div>
<br>
            <h2>Contact details</h2>

            <div class="contact-form-group">
            <label for="email" class="contact-form-label">Email:</label>
            <input type="email" id="email" class="contact-form-control"/>
            </div>

            <div class="contact-form-group">
            <label for="phone_number" class="contact-form-label">Phone number:</label>
            <input type="text" id="phone_number" class="contact-form-control"/>
            </div>
            <br>
            <br>
            <br>
            <input type="submit" value="Send"/>

        </div>
    </div>

    <div class="column">
    </div>
</div>



