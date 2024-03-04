<?php
    if(isset($_POST['submit'])){
        include "loginconnection.php";
        
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $sql = "select * from users where username = '$username'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        $hash = password_hash($password, PASSWORD_DEFAULT);
        if($row) {
             if(password_verify($password, $hash)){
                header("Location:home.php");
            }
        } else {
            echo '<script>
                window.location.href="login.php";
                alert("Invalid username or email.");
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
    <link rel="stylesheet" href="loginstyle.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Login Page</title>


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
                            <a class="nav-link" href="register.php">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="login.php">Log-in</a>
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
                <h5>Login</h5>
            </div>
            <div class="card-body">
                <form action = "login.php" method = "POST">
                    <!-- Unfinished, lacking forms-->
                    <div class="mb-3">
                        <label for="username" class="form-label">Username </label>
                        <input type="username" class="form-control" name="username" id="username" aria-describedby="usernameHelp">
                        <div id="usernameHelp" class="form-text">Your username will not be shared. User privacy is part of our policy.</div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password"  required />
                        <a href="#">Forgot password?</a>
                    </div>
                    <button type="submit" class="btn btn-primary" name = "submit">Login</button>
                </form>
            </div>
        </div>
    </div>


    <footer>
        <p> Philippe Andrei S. Dael <br> BSCS - 2 </p>
    </footer>
</body>
</html>