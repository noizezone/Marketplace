<?php

/*
            <input class="form-control" type="text" name="first-name" placeholder="First Name"><br>
            <input class="form-control" type="text" name="surname" placeholder="Surname"><br>
            <input class="form-control" type="text" name="uid" placeholder="Username"><br>
            <input class="form-control" type="password" name="pwd" placeholder="Password"><br>
            <input class="form-control" type="password" name="pwd-repeat" placeholder="Repeat password"><br>
            <input class="form-control" type="email" name="mail" placeholder="E-mail"><br>
            <input class="form-control" type="text" name="phone-number" placeholder="Phone Number"><br>
            <input class="form-control" type="text" name="city" placeholder="City"><br>
            <button class="form-control btn btn-dark" type="submit" name="signup-submit">Signup</button>

  */

if (isset($_POST['signup-submit'])){

    require 'dbh.inc.php';

    $first_name = $_POST['first-name'];
    $surname = $_POST['surname'];
    $username = $_POST['uid'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];
    $email = $_POST['mail'];
    $phone_number = $_POST['phone-number'];
    $city = $_POST['city'];

    if(empty($first_name) || empty($surname) || empty($username) || empty($password) || empty($passwordRepeat) || empty($email) || empty($phone_number) || empty($city)) {
        header("Location: ../signup.php?error=emptyfields&first-name=".$first_name."&surname=".$surname."&uid=".$username."&mail=".$email."&phone-number=".$phone_number."&city=".$city);
        exit();
    }
    else if((!filter_var($email, FILTER_VALIDATE_EMAIL)) && (!preg_match("/^[a-zA-Z0-9]*$/", $username))) {
        header("Location: ../signup.php?error=invalidmailuid&first-name=".$first_name."&surname=".$surname."&phone-number=".$phone_number."&city=".$city);
        exit();
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?error=invalidmail&first-name=".$first_name."&surname=".$surname."&uid=".$username."&phone-number=".$phone_number."&city=".$city);
        exit();
    }
    else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=invaliduid&first-name=".$first_name."&surname=".$surname."&phone-number=".$phone_number."&city=".$city);
        exit();
    }
    else if($password !== $passwordRepeat) {
        header("Location: ../signup.php?error=passwordcheck&first-name=".$first_name."&surname=".$surname."&uid=".$username."&mail=".$email."&phone-number=".$phone_number."&city=".$city);
        exit();
    }
    else {
        $sql = "SELECT username FROM users WHERE username=?";

        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)) {
            header("Location: ../signup.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "s",$username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if($resultCheck > 0) {
                header("Location: ../signup.php?error=usertaken&first-name=".$first_name."&surname=".$surname."&phone-number=".$phone_number."&city=".$city);
                exit();
            }
            else {
                $sql = "INSERT INTO users (first_name, surname, username, password, email, phone_number, city) VALUES (?,?,?,?,?,?,?)";

                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt,$sql)) {
                    header("Location: ../signup.php?error=sqlerror");
                    exit();
                }
                else {

                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

                    //include hashed password below
                    mysqli_stmt_bind_param($stmt, "sssssss",$first_name, $surname, $username,$hashedPwd, $email, $phone_number, $city);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../signup.php?signup=success");
                    exit();

                }
            }


        }


    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

}
else {
    header("Location: ../signup.php");
    exit();
}