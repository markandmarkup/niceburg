<?php

function dbConnect() {
    $db = new PDO('mysql:host=db; dbname=niceburg_reviews', 'root', 'password');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $db;
}

function dbQueryGetAll($db) : array {
    $query = $db->prepare("SELECT `burger_name`, `restaurant`, `visit_date`, `image`, `price`, `patty_rating`, `topping_rating`, `sides_rating`, `value_rating`, `total_score` FROM `reviews`");
    $query->execute();
    $result = $query->fetchAll();
    return $result;
}