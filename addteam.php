<?php
session_start();

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
    <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px; height: 100vh;">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32">
                <use xlink:href="#bootstrap"></use>
            </svg>
            <span class="fs-4">Toernooi</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="index.php" class="nav-link link-dark" aria-current="page">
                    <svg class="bi me-2" width="16" height="16">
                    </svg>
                    Home
                </a>
            </li>
            <li class="nav-item">
                <a href="teams.php" class="nav-link link-dark" aria-current="page">
                    <svg class="bi me-2" width="16" height="16">
                    </svg>
                    Teams
                </a>
            </li>
            <li class="nav-item">
                <a href="oldgame.php" class="nav-link link-dark" aria-current="page">
                    <svg class="bi me-2" width="16" height="16">
                    </svg>
                    Oude Wedstrijden
                </a>
            </li>
            <li>
                <a href="#" class="nav-link link-dark active">
                    <svg class="bi me-2" width="16" height="16">
                    </svg>
                    Voeg jouw team toe
                </a>
            </li>
        </ul>
        <hr>
        <?php if (isset($_SESSION['user'])) : ?>
            <div class="dropdown">
                <span role="button" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://picsum.photos/200/300" alt="" width="32" height="32" class="rounded-circle me-2">
                    <strong><?php print $_SESSION['user']['first_name']; ?></strong>
                </span>
                <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser" style="">

                    <li><a class="dropdown-item" href="#">Admin dashboard</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
                </ul>
            </div>
        <?php endif; ?>
        <?php if (!isset($_SESSION['user'])) : ?>
            <a href="login.php" class="btn btn-primary btn-block">Login</a>
        <?php endif; ?>

    </div>

    <div class="fixed-top w-50 border shadow p-3" style="margin: 10% 25%;">
        <?php if (isset($_SESSION['user'])) : ?>
            <?php if (isset($_GET['error']) == 'empty') : ?>
                <div class="alert alert-danger" role="alert">
                    <strong>Error!</strong> Vul alle velden in.
                </div>
            <?php endif; ?>
            <form action="addteamgate.php" method="POST">
                <div class="form-group mb-1">
                    <label for="teamName">Teamnaam</label>
                    <input type="text" class="form-control" id="teamName" name="teamName" placeholder="Teamnaam">
                </div>
                <hr />
                <!-- !TODO built loop -->
                <?php for ($x = 0; $x < 5; ++$x) : ?>
                    <div class="input-group">
                        <label for="teamMember">team lid</label>
                        <input type="text" class="form-control input-sm m-1" id="teamMember" name='teamMember[]' placeholder="Naam">
                        <input type="text" class="form-control input-sm m-1" id="teamMember" name="teamMemberlast[]" placeholder="achternaam">
                    </div>
                <?php endfor; ?>
                <button type="submit" class="btn btn-primary mt-5">Voeg team toe</button>
            </form>
        <?php endif; ?> 
        <?php if (!isset($_SESSION['user'])) : ?>
            <h5>login om een team toe te voegen</h5>
            <a href="login.php" class="btn btn-primary btn-block">Login</a>
        <?php endif; ?>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>

    </script>
</body>

</html>