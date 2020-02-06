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

/** DB Query to Insert a new review record.
 *
 * @param PDO $db
 * @param array $new_review
 *
 * @return bool
 */
function addNewReview(PDO $db, array $new_review) : bool {

    $query = $db->prepare("INSERT INTO `reviews` (`burger_name`, `restaurant`, `visit_date`, `price`, `patty_rating`, `topping_rating`, `sides_rating`, `value_rating`, `total_score`)
        VALUES(:burger_name, :restaurant, :visit_date, :price, :patty_rating, :topping_rating, :sides_rating, :value_rating, :total_score)");

    $query->bindParam(':burger_name', $new_review['burger_name']);
    $query->bindParam(':restaurant', $new_review['restaurant']);
    $query->bindParam(':visit_date', $new_review['visit_date']);
    $query->bindParam(':price', $new_review['price']);
    $query->bindParam(':patty_rating', $new_review['patty_rating']);
    $query->bindParam(':topping_rating', $new_review['topping_rating']);
    $query->bindParam(':sides_rating', $new_review['sides_rating']);
    $query->bindParam(':value_rating', $new_review['value_rating']);
    $query->bindParam(':total_score', $new_review['total_score']);

    return $query->execute();

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


/** Checks whether the new review contains all the keys necessary for db insertion
 *
 * @param array $new_review
 *
 * @return bool
 */
function checkNewReviewKeys(array $new_review) : bool {

    $keys = ['burger_name', 'restaurant', 'visit_date', 'price', 'patty_rating', 'topping_rating', 'sides_rating', 'value_rating'];

    if (array_keys($new_review) !== $keys) {
        return false;
    } else {
        return true;
    }
}


/** Sanitizes an input string, trim and filter
 *
 * @param string $input
 *
 * @return string
 */
function sanitizeString(string $input) : string {

    if (!is_null($input) && !empty($input)) {
        $input = trim($input);
        $input = filter_var($input, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW | FILTER_FLAG_ENCODE_AMP);
        return $input;
    } else {
        return '';
    }

}


/** Validates a 'Medium' string - checks char length, returns error message
 *
 * @param string $input
 *
 * @return string
 */
function validateMediumString(string $input) : string {

    if (strlen($input) < 1 || strlen($input) > 200) {
        return 'Input should be between 1 and 200 characters long';
    } else {
        return '';
    }

}


/** Validates a date - checks char length, returns error message
 *
 * @param string $input
 *
 * @return string
 */
function validateDate(string $input) : string {

    if (strlen($input) !== 10) {
        return 'Date not in the correct format';
    }  else {
        return '';
    }

}


/** Validates a price - checks value between 0 and 999.999 & no of decimal places, returns error message
 *
 * @param float $input
 *
 * @return string
 */
function validatePrice(float $input) : string {

    if ($input < 0 || $input > 999.99) {
        return 'Enter a value between £0.00 and £999.99';
    }

    if ((int)$input !== $input)
    {
        if ((strlen($input) - strrpos($input, '.') - 1) > 2) {
            return 'Enter a value with no more than 2 decimal places';
        }
    }

    return '';

}

/** Validates a rating - checks value between 0 and 5 & no of decimal places, returns error message
 *
 * @param float $input
 *
 * @return string
 */

function validateRating(float $input) : string {

    if ($input < 0 || $input > 5) {
        return 'Ratings should be between 0 and 5';
    }

    if ((int)$input !== $input)
    {
        if ((strlen($input) - strrpos($input, '.') - 1) > 1) {
            return 'Enter a value with no more than 1 decimal place';
        }
    }

    return '';

}

/** Calculates Total Score from average of Ratings, rounded up to nearest .1
 *
 * @param array $ratings
 *
 * @return float
 */
function calcTotalScore(array $ratings) : float {

    if (!empty($ratings)) {
        return round((array_sum($ratings) / count($ratings)), 1, PHP_ROUND_HALF_UP);
    } else {
        return 0;
    }
}