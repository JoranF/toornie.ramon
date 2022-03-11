<?php

require_once 'user.php';

$LoginMsg = '';
if($_SERVER['REQUEST_METHOD'] === 'POST')
{

    $email = $_POST['email'] ?? '';
    $pw    = $_POST['pw']    ?? '';
    $admin = false;

    $user = new user();
    
    if($user->Login($email, $pw))
    {
        session_start();
        
        $_SESSION['user'] = array(
            'first_name' => $user->first_name,
            'last_name'  => $user->last_name,
            'email'      => $user->email,
        );
        header('Location: index.php');
    }
    else { $LoginMsg = 'Login failed'; }
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
        
        <title>Voetbaltoernooi</title>
        
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
                    <h2>Login</h2>
                </div>
                <form method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email">
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="pw">
                    </div>
                    <div class="mb-3"><a href="register.php">Don't have an account yet? Register here</a></div>
                    <div class="mb-3"><?php print $LoginMsg; ?></div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </section>
        
        <script src="js/bootstrap.min.js"></script>        
    </body>
</html>
