    <?php
$active = "login";
include "includes/header.php";
?>



<div class="loginBox">
    <form action="" method="post">
        <div class="loginRow">
            <div class="loginHead">
                <h2>World Wide Importers Login</h2>
            </div>
        </div>
        <div class="loginRow">
            <div class="loginColumn1">
                <label for="inputEmail" class=""><div class ='email'>Email: </div></label>
            </div>
            <div class="loginColumn2">
                <input type="email" class="loginInput" id="inputEmail" placeholder="Email">
            </div>
        </div>
        <div class="loginRow">
            <div class="loginColumn1">
                <label for="inputPassword" class="">Password:</label>
            </div>
            <div class="loginColumn2">
                <input type="password" class="loginInput" id="inputPassword" placeholder="Password">
            </div>
        </div>
        <div class="loginRow">
            <div class="loginColumn2">
                <input type="submit" class="" value="Sign in"> <a class="loginLink" href="">Forgot password?</a> <!-- sign in en forgot password doen nog niks -->
            </div>
        </div>
    </form>
</div>

<?php
include "includes/footer.php";
?>