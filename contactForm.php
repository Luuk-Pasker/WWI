<?php
$active = "about";
include "includes/header.php";
?>

<link rel="stylesheet" type="text/css" href="css/aboutus.css" xmlns="">
<a href="contactForm.php" ><button class="button" type="submit">Contact Form</button> </a>
<a href="guarantee.php" ><button class='button' type="submit">Guarantee </button></a>

<h2>Contact form</h2>
<h4>Select your subject:        <select>
    <optgroup label="Choose subject"</comment>
    <option value="Delivery">Delivery</option>
    <option value="General">General question</option>
    <option value="Guarantee">Guarantee</option>
    <option value="Order">Order</option>
</select></h4>
<h4>Message/Question:            </h4> <textarea rows="4" cols="50"></textarea>
<h4></h4>


<h2>Personal information</h2>
<h4>Salutation:     <select>
    <option value="Mr">Mr.</option>
    <option value="Ms">Ms.</option>
</select></h4>
<h4>First name:       <input type="text"></h4>
<h4>Last name:        <input type="text"></h4>


<h2>Contact details</h2>
<h4>Email:        <input type="email"> </h4>
<h4>Phonenumber:  <input type="number"></h4>

<input type="submit" value="Send"></intput>

