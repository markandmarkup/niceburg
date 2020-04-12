<?php

require_once 'functions.php';
require_once 'dbConnect.php';

$db = dbConnect();

if (!empty($_GET)) {
    $getData = $_GET;
    if (array_key_exists('id', $getData)) {
        deleteReview($db, $getData['id']);
    }
}

header('Location: index.php');