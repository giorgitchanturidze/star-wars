<?php

require_once ('./dataabse.php');
$id = $_POST['id'] ?? null;
if (!$id) {
    header('Location: searched.php');
    exit;
}

$statement = $pdo->prepare('DELETE FROM star_wars WHERE id = :id');
$statement->bindValue(':id', $id);
$statement->execute();

header('Location: searched.php');