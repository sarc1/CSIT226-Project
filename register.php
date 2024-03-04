<?php
    if(isset($_POST['submit'])){
        include "loginconnection.php";
        //username,email,password inputted by users
        //mysqli_real_excape_string for special characters that are possibly inputted by users
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $password = mysqli_real_escape_string($conn,$_POST['password']);

        // compare the $username that is inputted by the users from the usernames on the database
        $sql = "select * from users where username = '$username'";
        //fecth and stores the row in a form of array
        $result = mysqli_query($conn, $sql);
        //array count_username stores result after comparing the input username to the usernames in the database
        $count_username = mysqli_num_rows($result);

        //the same as above
        $sql = "select * from users where email = '$email'";
        $result = mysqli_query($conn, $sql);
        $count_email = mysqli_num_rows($result);

        // check if the username is not on the database
        if($count_username == 0 || $count_email == 0){
            //makes the password into a hash to prevent from hacking
            $hash = password_hash($password, PASSWORD_DEFAULT);
            //inserts the inputs on the data base
            $sql = "insert into users(username, email, password) values ('$username', '$email', '$hash')";
            $result = mysqli_query($conn, $sql);
            $count_email = mysqli_num_rows($result);
            echo '<script>
                    window.location.href = "login.php";
                    alert("Register Sucessful! Please Login.")
                </script>';
        }
        else{
            //output an error and go back to the same page after the alert
            echo '<script>
                    window.location.href = "register.php";
                    alert("Email or Username already exist!")
                </script>';
        }
    }

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="registerstyle.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Register</title>
</head>
<body>

    <header>
        <nav class="navbar navbar-expand-lg bg-dark bg-body-tertiary" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">NoteNest</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="register.php">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Log-in</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact us</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

        <div class="container pad">
            <div class="card">
                <div class="card-header">
                    <h5>Register</h5>
                </div>
                <div class="card-body">
                    <form action = "register.php" method = "POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="username" class="form-control" name="username" id="username" aria-describedby="usernameHelp">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">Your email will not be shared. User privacy is part of our policy.</div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password" />
                            <p>Already a member? <a href="login.php">Sign in?</a> </p>
                        </div>
                        <button type="submit" class="btn btn-primary" name = "submit">Register</button>
                    </form>
                </div>
            </div>
        </div>

    <footer>
        <p> Philippe Andrei S. Dael <br> BSCS - 2 </p>
    </footer>
</body>
</html>