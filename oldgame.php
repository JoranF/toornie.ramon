<?php

session_start();

require_once 'db.php';

$db = new db();
$conn = $db->connect();

$sql = 'SELECT t1.name AS team1_name, t2.name AS team2_name, m.play_date AS match_date, m.team1_id as team1_id, m.team2_id as team2_id, team1_score as score1, team2_score as score2
        FROM `match` AS m
        JOIN team AS t1 ON m.team1_id = t1.id
        JOIN team AS t2 ON m.team2_id = t2.id
        WHERE m.state_id = 3';

$result = $conn->query($sql);

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
    <div class="d-flex flex-column flex-shrink-0 p-3 bg-light position-fixed fixed-top" style="width: 280px; height: 100vh;">
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
            <li class="nav-item ">
                <a href="oldgame.php" class="nav-link link-dark active" aria-current="page">
                    <svg class="bi me-2" width="16" height="16">
                    </svg>
                    Oude Wedstrijden
                </a>
            </li>
            <li>
                <a href="addteam.php" class="nav-link link-dark">
                    <svg class="bi me-2" width="16" height="16">
                        <use xlink:href="#speedometer2"></use>
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
                <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser">
                    <?php if ($admin) : ?>
                        <li><a class="dropdown-item" href="#">Admin dashboard</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                    <?php endif; ?>
                    <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
                </ul>
            </div>
        <?php endif; ?>
        <?php if (!isset($_SESSION['user'])) : ?>
            <a href="login.php" class="btn btn-primary btn-block">Login</a>
        <?php endif; ?>

    </div>

    <div>

        <div class=" w-50 border shadow p-3 " style="margin: 10% 25%;">
            <div>
                <h2>Reslultaat      Wedstrijden</h2>
                <?php foreach ($result as $row) : ?>
                    <div class="row mt-5">
                        <h3>Datum:</h3>
                        <h5><?php print $row['match_date']; ?></h5>
                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?php print $row['team1_name']; ?></h5>
                                    <h3>Score:</h3><h3><?php print $row['score1']; ?></h3>
                                    <p class="card-text">
                                        <?php if ($row['score1'] > $row['score2']) : ?>
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/7/7c/Trophy_cup.svg" class="w-25 fixed-right" alt="Responsive image">
                                        <?php elseif($row['score1'] == $row['score2']) : ?>
                                    <h1>Gelijkspel</h1>
                                <?php endif ?>
                                </p>
                                <?php echo '<a href="view_team.php?team_id=' . $row['team1_id'] . '" class="btn btn-primary">Bekijk team</a>'  ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 text-center">
                            <h1>VS</h1>
                        </div>
                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?php print $row['team2_name']; ?></h5>
                                    <h3>Score:</h3><h3><?php print $row['score2']; ?></h3>
                                    <p class="card-text">
                                        <?php if ($row['score1'] < $row['score2']) : ?>
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/7/7c/Trophy_cup.svg" class="w-25 position-absolute top-0 end-0" alt="Responsive image">
                                        <?php elseif($row['score1'] == $row['score2']) : ?>
                                    <h1>Gelijkspel</h1>
                                <?php endif ?>
                                </p>
                                <?php echo '<a href="view_team.php?team_id=' . $row['team2_id'] . '" class="btn btn-primary">Bekijk team</a>'  ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <script src="js/bootstrap.min.js"></script>
        <script>

        </script>
</body>

</html>