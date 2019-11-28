<?php
include "includes/header.php";
?>

    <div class="loginBox">
        <form method="post">
            <div class="loginRow">
                <div class="loginHead">
                    <h2>Wide World Importers Register</h2>
                </div>
            </div>
            <div class="loginRow">
                <div class="loginColumn1">
                    <label for="inputName" class="">Full name:</label>
                </div>
                <div class="loginColumn2">
                    <input type="text" class="loginInput" id="inputName" name="username" placeholder="Full name">
                </div>
            </div>
            <div class="loginRow">
                <div class="loginColumn1">
                    <label for="inputEmail" class="">Email adress:</label>
                </div>
                <div class="loginColumn2">
                    <input type="text" class="loginInput" id="inputEmail" name="email" placeholder="Email adress">
                </div>
            </div>
            <div class="loginRow">
                <div class="loginColumn1">
                    <label for="inputPhone" class="">Phone number:</label>
                </div>
                <div class="loginColumn2">
                    <input type="text" class="loginInput" id="inputPhone" name="phone" placeholder="Phone number">
                </div>
            </div>
            <div class="loginRow">
                <div class="loginColumn1">
                    <label for="inputPassword">Password:</label>
                </div>
                <div class="loginColumn2">
                    <input type="password" class="loginInput" id="inputPassword" name="password" placeholder="Password">
                </div>
            </div>
            <div class="loginRow">
                <div class="loginColumn2">
                    <input type="submit" class="" name="submit" value="Sign up">
                </div>
            </div>
        </form>
    </div>

<?php
if ($connection->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $name = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = hash('sha256', $_POST['password']);
    $HPass = strtoupper($password);
    if ($name == $password){
        echo "Username and password can't be the same!";
    } elseif (empty($name)){
        echo "Fill in username!";
    } elseif (empty($email)) {
        echo "Fill in email!";
    } elseif (empty($phone)) {
        echo "Fill in phonenumber!";
    } elseif (empty($password)){
        echo "Fill in password!";
    } else {
        $sql = "SELECT MAX(PersonID) AS HighestID FROM people";
        /*printen van de resultaten op het scherm*/
        $res_data = mysqli_query($connection, $sql);
        foreach ($res_data as $row) {
            $PersonID = $row['HighestID'] + 1;
            $sql = "INSERT INTO people (PersonID, Fullname, LogonName, HashedPassword, PhoneNumber, EmailAddress) VALUES ('$PersonID', '$name', '$email', '$HPass', '$phone', '$email')";
            /*printen van de resultaten op het scherm*/
            if ($connection->query($sql) === TRUE) {
                echo "New account created successfully";
            }
        }
    }
}

include "includes/footer.php";