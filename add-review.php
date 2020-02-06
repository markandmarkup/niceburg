<?php

require_once 'functions.php';
require_once 'dbConnect.php';

$errors = [];
$success_message = '';

if (!empty($_POST)) {

    $new_review = $_POST;

    if (checkNewReviewKeys($new_review)) {

        $new_review['burger_name'] = sanitizeString($new_review['burger_name']);
        $errors[0] = validateMediumString($new_review['burger_name']);
        $new_review['restaurant'] = sanitizeString($new_review['restaurant']);
        $errors[1] = validateMediumString($new_review['restaurant']);
        $new_review['visit_date'] = sanitizeString($new_review['visit_date']);
        $errors[2] = validateDate($new_review['visit_date']);
        $new_review['price'] = trim($new_review['price']);
        $errors[3] = validatePrice($new_review['price']);
        $new_review['patty_rating'] = trim($new_review['patty_rating']);
        $errors[4] = validateRating($new_review['patty_rating']);
        $new_review['topping_rating'] = trim($new_review['topping_rating']);
        $errors[5] = validateRating($new_review['topping_rating']);
        $new_review['sides_rating'] = trim($new_review['sides_rating']);
        $errors[6] = validateRating($new_review['sides_rating']);
        $new_review['value_rating'] = trim($new_review['value_rating']);
        $errors[7] = validateRating($new_review['value_rating']);
        $new_review['total_score'] = calcTotalScore([$new_review['patty_rating'], $new_review['topping_rating'], $new_review['sides_rating'], $new_review['value_rating']]);

        if (array_sum($errors) === 0) {
            $db = dbConnect();
            if (addNewReview($db, $new_review)) {
                $success_message  = 'Review successfully posted!';
            } else {
                $success_message = 'Something went wrong. Maybe try again?';
            }
        }

    } else {
        $success_message = 'Please fill in all the required fields';
    }
}

?>

<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Pacifico|Quattrocento+Sans:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="normalize.css" />
    <link rel="stylesheet" type="text/css" href="styles.css" />
    <title>NiceBurg | Burger Reviews</title>
</head>
<body>
<div class="content-column">
    <header>
        <img src="./images/logoburger_400.png" />
        <h1>NiceBurg</h1>
        <h2>Burger reviews to sink your teeth into</h2>
    </header>

    <div class="section-header">
        <a class="header-link home" href="index.php">&lt; Home</a>
        <h3>Add a review</h3>
    </div>

    <section class="review-form">
        <div class="review-post-message"><?php echo $success_message; ?></div>
        <form action="add-review.php" method="post">
            <div class="form-line">
                <label for="burger_name">Burger Name</label><input id="burger_name" name="burger_name" type="text" required />
            </div>
            <div class="form-error-message"><?php echo isset($errors[0]) ? $errors[0] : ''; ?></div>

            <div class="form-line">
                <label for="restaurant">Restaurant</label><input id="restaurant" name="restaurant" type="text" required />
            </div>
            <div class="form-error-message"><?php echo isset($errors[1]) ? $errors[1] : ''; ?></div>

            <div class="form-line short-form-line">
                <label for="visit_date">Visit Date</label><input id="visit_date" class="short-input" name="visit_date" type="date" required />
            </div>
            <div class="form-error-message"><?php echo isset($errors[2]) ? $errors[2] : ''; ?></div>

            <div class="form-line short-form-line">
                <label for="price">Price</label><span>&#163;</span><input id="price" class="short-input" name="price" type="number" step="0.01" min="0" max="999.99" required />
            </div>
            <div class="form-error-message"><?php echo isset($errors[3]) ? $errors[3] : ''; ?></div>

            <div class="rating-box">
                <div class="form-line">
                    <label for="patty_rating">Patty Score</label>
                    <div class="score-container">
                        <input type="radio" class="burger-rh" name="patty_rating" id="patty5" value="5" /><label for="patty5" title="5"></label>
                        <input type="radio" class="burger-lh" name="patty_rating" id="patty45" value="4.5" /><label for="patty45" title="4.5"></label>
                        <input type="radio" class="burger-rh" name="patty_rating" id="patty4" value="4" /><label for="patty4" title="4"></label>
                        <input type="radio" class="burger-lh" name="patty_rating" id="patty35" value="3.5" /><label for="patty35" title="3.5"></label>
                        <input type="radio" class="burger-rh" name="patty_rating" id="patty3" value="3" /><label for="patty3" title="3"></label>
                        <input type="radio" class="burger-lh" name="patty_rating" id="patty25" value="2.5" /><label for="patty25" title="2.5"></label>
                        <input type="radio" class="burger-rh" name="patty_rating" id="patty2" value="2" /><label for="patty2" title="2"></label>
                        <input type="radio" class="burger-lh" name="patty_rating" id="patty15" value="1.5" /><label for="patty15" title="1.5"></label>
                        <input type="radio" class="burger-rh" name="patty_rating" id="patty1" value="1" /><label for="patty1" title="1"></label>
                        <input type="radio" class="burger-lh" name="patty_rating" id="patty05" value="0.5" checked /><label for="patty05" title="0.5"></label>
                    </div>
                </div>

                <div class="form-line">
                    <label for="topping_rating">Topping Score</label>
                    <div class="score-container">
                        <input type="radio" class="burger-rh" name="topping_rating" id="topping5" value="5" /><label for="topping5" title="5"></label>
                        <input type="radio" class="burger-lh" name="topping_rating" id="topping45" value="4.5" /><label for="topping45" title="4.5"></label>
                        <input type="radio" class="burger-rh" name="topping_rating" id="topping4" value="4" /><label for="topping4" title="4"></label>
                        <input type="radio" class="burger-lh" name="topping_rating" id="topping35" value="3.5" /><label for="topping35" title="3.5"></label>
                        <input type="radio" class="burger-rh" name="topping_rating" id="topping3" value="3" /><label for="topping3" title="3"></label>
                        <input type="radio" class="burger-lh" name="topping_rating" id="topping25" value="2.5" /><label for="topping25" title="2.5"></label>
                        <input type="radio" class="burger-rh" name="topping_rating" id="topping2" value="2" /><label for="topping2" title="2"></label>
                        <input type="radio" class="burger-lh" name="topping_rating" id="topping15" value="1.5" /><label for="topping15" title="1.5"></label>
                        <input type="radio" class="burger-rh" name="topping_rating" id="topping1" value="1" /><label for="topping1" title="1"></label>
                        <input type="radio" class="burger-lh" name="topping_rating" id="topping05" value="0.5" checked /><label for="topping05" title="0.5"></label>
                    </div>
                </div>

                <div class="form-line">
                    <label for="sides_rating">Sides Score</label>
                    <div class="score-container">
                        <input type="radio" class="burger-rh" name="sides_rating" id="sides5" value="5" /><label for="sides5" title="5"></label>
                        <input type="radio" class="burger-lh" name="sides_rating" id="sides45" value="4.5" /><label for="sides45" title="4.5"></label>
                        <input type="radio" class="burger-rh" name="sides_rating" id="sides4" value="4" /><label for="sides4" title="4"></label>
                        <input type="radio" class="burger-lh" name="sides_rating" id="sides35" value="3.5" /><label for="sides35" title="3.5"></label>
                        <input type="radio" class="burger-rh" name="sides_rating" id="sides3" value="3" /><label for="sides3" title="3"></label>
                        <input type="radio" class="burger-lh" name="sides_rating" id="sides25" value="2.5" /><label for="sides25" title="2.5"></label>
                        <input type="radio" class="burger-rh" name="sides_rating" id="sides2" value="2" /><label for="sides2" title="2"></label>
                        <input type="radio" class="burger-lh" name="sides_rating" id="sides15" value="1.5" /><label for="sides15" title="1.5"></label>
                        <input type="radio" class="burger-rh" name="sides_rating" id="sides1" value="1" /><label for="sides1" title="1"></label>
                        <input type="radio" class="burger-lh" name="sides_rating" id="sides05" value="0.5" checked /><label for="sides05" title="0.5"></label>
                    </div>
                </div>

                <div class="form-line">
                    <label for="value_rating">Value Score</label>
                    <div class="score-container">
                        <input type="radio" class="burger-rh" name="value_rating" id="value5" value="5" /><label for="value5" title="5"></label>
                        <input type="radio" class="burger-lh" name="value_rating" id="value45" value="4.5" /><label for="value45" title="4.5"></label>
                        <input type="radio" class="burger-rh" name="value_rating" id="value4" value="4" /><label for="value4" title="4"></label>
                        <input type="radio" class="burger-lh" name="value_rating" id="value35" value="3.5" /><label for="value35" title="3.5"></label>
                        <input type="radio" class="burger-rh" name="value_rating" id="value3" value="3" /><label for="value3" title="3"></label>
                        <input type="radio" class="burger-lh" name="value_rating" id="value25" value="2.5" /><label for="value25" title="2.5"></label>
                        <input type="radio" class="burger-rh" name="value_rating" id="value2" value="2" /><label for="value2" title="2"></label>
                        <input type="radio" class="burger-lh" name="value_rating" id="value15" value="1.5" /><label for="value15" title="1.5"></label>
                        <input type="radio" class="burger-rh" name="value_rating" id="value1" value="1" /><label for="value1" title="1"></label>
                        <input type="radio" class="burger-lh" name="value_rating" id="value05" value="0.5" checked /><label for="value05" title="0.5"></label>
                    </div>
                </div>
            </div>

            <div class="form-line transparent">
                <input type="submit" class="rounded-button" value="Submit Review  &#187;" />
                <a href="index.php" class="rounded-button cancel">&#10005; Cancel</a>
            </div>
        </form>
    </section>

</div>
</body>
</html>
