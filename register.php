<?php

require_once 'user.php';

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $first_name = $_POST['first_name'] ?? '';
    $last_name  = $_POST['last_name']  ?? '';
    $email      = $_POST['email']      ?? '';
    $pw         = $_POST['pw']         ?? '';
    
    $user = new user();
    
    $user->Register($first_name, $last_name, $email, $pw);
    header('location: login.php');
}

?>

<html>
    <head>
        <meta name="viewport" content="width=device-width, maximum-scale=1.0, minimum-scale=1.0,user-scalable=yes" />
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="keyword" content="voetbaltoernooi">
        <meta name="description" content="voetbaltoernooi">
        <meta name="author" content="Ramon & Joran">
        <meta name="copyright" content="(C) 2022">
        
        <title>Voetbaltoernooi - Register</title>
        
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <header>
            <div class="container-fluid">
                <div class="row">
                    <div class="pt-2 pb-5"><h1>Voetbalvereniging Rapiditas uit De Kraats</h1></div>
                </div>
            </div>
        </header>
        
        <section>
            <div class="container">
                <div class="row border-bottom mb-4">
                    <h2>Register</h2>
                </div>
                <form method="post">
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First name</label>
                        <input type="first_name" class="form-control" id="first_name" name="first_name">
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last name</label>
                        <input type="last_name" class="form-control" id="last_name" name="last_name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="pw">
                    </div>
                    <div class="mb-3"><a href="login.php">Login here</a></div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </section>
        
        <script src="js/bootstrap.min.js"></script>        
    </body>
</html>
