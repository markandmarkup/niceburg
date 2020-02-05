<?php

/** Query to return all review records for main collection page display
 *
 * @param PDO $db
 *
 * @return array
 */
function getAllReviews(PDO $db) : array {
    $query = $db->prepare("SELECT `burger_name`, `restaurant`, `visit_date`, `image`, `price`, `patty_rating`, `topping_rating`, `sides_rating`, `value_rating`, `total_score` FROM `reviews`");
    $query->execute();
    return $query->fetchAll();
}

/** Cycles through reviews, changing the date format to dd/mm/yyyy from sql yyyy/mm/dd
 *
 * @param array $all_reviews
 *
 * @return array
 */
function dateFormatUK(array $all_reviews) : array {
    if (!is_null($all_reviews)) {
        foreach ($all_reviews as $key => $review) {
            if (isset($review['visit_date'])) {
                $date = date_create($review['visit_date']);
                $all_reviews[$key]['visit_date'] = date_format($date, "d/m/Y");
            }
        }
        return $all_reviews;
    } else {
        $output = [];
        return $output;
    }
}

/** Generates html for review panels from db array.
 *
 * @param array $all_reviews
 *
 * @return string
 */
function displayReviews(array $all_reviews) : string {
    $output = '';

    if (!empty($all_reviews)) {
        foreach ($all_reviews as $review) {
            $output .= "<div class=\"review\">";
            $output .= "<div class=\"review-content\">";
            $output .= "<div class=\"review-image\" style=\"background-image: url(" . $review['image'] . ");\"></div>";
            $output .= "<div class=\"item-titles\">";
            $output .= "<h4>" . $review['burger_name'] . "</h4>";
            $output .= "<h5>" . $review['restaurant'] . "</h5>";
            $output .= "</div>";
            $output .= "<table class=\"stats\">";
            $output .= "<tr><th>Visit Date:</th><td>" . $review['visit_date'] . "</td></tr>";
            $output .= "<tr><th>Price:</th><td>£" . number_format($review['price'], 2, '.', ',') . "</td></tr>";
            $output .= "<tr><th>Burger Patty:</th><td>" . $review['patty_rating'] . "</td></tr>";
            $output .= "<tr><th>Toppings &amp; bun:</th><td>" . $review['topping_rating'] . "</td></tr>";
            $output .= "<tr><th>Sides:</th><td>" . $review['sides_rating'] . "</td></tr>";
            $output .= "<tr><th>Value:</th><td>" . $review['value_rating'] . "</td></tr>";
            $output .= "</table>";
            $output .= "</div>";
            $output .= "<p class=\"rating\">Total Score:&nbsp;&nbsp;<span>" . $review['total_score'] . "</span></p>";
            $output .= "</div>";
        }
        return $output;
    } else {
        return 'No records to display';
    }
}

/** Checks every record in a nested array [[review1], [review2] etc] for every key listed in the $keys array. Returns false if any are missing.
 *
 * @param array $keys
 * @param array $reviews
 *
 * @return bool
 */
function checkReviewKeys(array $reviews) : bool {

    $keys = ['burger_name', 'restaurant', 'visit_date', 'image', 'price', 'patty_rating', 'topping_rating', 'sides_rating', 'value_rating', 'total_score'];

    if(gettype($reviews[0]) !== 'array'){
        return false;
    }

    foreach ($reviews as $review){
        if($keys !== array_keys($review)){
            return false;
        }
    }
    return true;

}