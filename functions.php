<?php

function dbQueryGetAll(PDO $db) : array {
    $query = $db->prepare("SELECT `burger_name`, `restaurant`, `visit_date`, `image`, `price`, `patty_rating`, `topping_rating`, `sides_rating`, `value_rating`, `total_score` FROM `reviews`");
    $query->execute();
    return $query->fetchAll();
}

function displayReviews(array $all_reviews) : string {
    $output = '';
    $required_keys = ['burger_name', 'restaurant', 'visit_date', 'image', 'price', 'patty_rating', 'topping_rating', 'sides_rating', 'value_rating', 'total_score'];

    if ($all_reviews != null) {
        foreach ($all_reviews as $review) {
            if ($review != null) {
                if (array_keys($review) === $required_keys) {
                    $output .= "<div class=\"review\">";
                    $output .= "<div class=\"review-content\">";
                    $output .= "<div class=\"review-image\" style=\"background-image: url(" . $review['image'] . ");\"></div>";
                    $output .= "<div class=\"item-titles\">";
                    $output .= "<h4>" . $review['burger_name'] . "</h4>";
                    $output .= "<h5>" . $review['restaurant'] . "</h5>";
                    $output .= "</div>";
                    $output .= "<table class=\"stats\">";
                    $output .= "<tr><th>Visit Date:</th><td>" . $review['visit_date'] . "</td></tr>";
                    $output .= "<tr><th>Price:</th><td>£" . $review['price'] . "</td></tr>";
                    $output .= "<tr><th>Burger Patty:</th><td>" . $review['patty_rating'] . "</td></tr>";
                    $output .= "<tr><th>Toppings &amp; bun:</th><td>" . $review['topping_rating'] . "</td></tr>";
                    $output .= "<tr><th>Sides:</th><td>" . $review['sides_rating'] . "</td></tr>";
                    $output .= "<tr><th>Value:</th><td>" . $review['value_rating'] . "</td></tr>";
                    $output .= "</table>";
                    $output .= "</div>";
                    $output .= "<p class=\"rating\">Total Score:&nbsp;&nbsp;<span>" . $review['total_score'] . "</span></p>";
                    $output .= "</div>";
                } else {
                    return 'Keys do not match';
                }
            }
        }
        return $output;
    } else {
        return 'No records to display';
    }
}