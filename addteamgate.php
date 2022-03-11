<?php

require_once('db.php');

$db = new db();
$conn = $db->connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $team_name = $_POST['teamName'];
    $sql = "INSERT INTO team (name) VALUES ('$team_name')";
    $conn->exec($sql);

    $sql = "SELECT id FROM team WHERE name = '$team_name'";
    $result = $conn->query($sql);
    $row = $result->fetch();
    $team_id = $row['id'];

    for ($x = 0; $x < 5; $x++) {
        $memberName = $_POST['teamMember'][$x];
        $teamMemberlastName = $_POST['teamMemberlast'][$x];

        $sql = "INSERT INTO participant (first_name, last_name) VALUES ('$memberName', '$teamMemberlastName')";
        $conn->exec($sql);
        $participant_id = $conn->lastInsertId();

        $sql = "INSERT INTO team_participant (team_id, participant_id) VALUES ('$team_id', '$participant_id')";
        $conn->exec($sql);
    }

    header('location: index.php');
}
