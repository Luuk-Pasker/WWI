<?php
$active = "login";
include "includes/header.php";
?>

<link rel="stylesheet" type="text/css" href="css/style.css">

<div class="alles">
    <form>

        <div class="form-group row">
            <label for="inputEmail" class="col-sm-2 col-form-label"><div class ='email'>Email</div></label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="inputEmail" placeholder="Email">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword" placeholder="Password">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10 offset-sm-2">
                <label class="form-check-label"><input type="checkbox"> Remember me</label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10 offset-sm-2">
                <button type="submit" class="btn btn-primary">Sign in</button>
            </div>
        </div>
    </form>
</div>

<?php
include "includes/footer.php";
?>