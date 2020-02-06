<?php

require_once '../functions.php';

use PHPUNIT\Framework\TestCase;

class FunctionTests extends TestCase
{
    // function dateFormatUK Tests

    public function testSuccessDateFormat()
    {
        $input = [['visit_date' => '2020-02-02'], ['visit_date' => '2019-11-30']];
        $expected = [['visit_date' => '02/02/2020'], ['visit_date' => '30/11/2019']];
        $case = dateFormatUK($input);
        $this->assertEquals($expected, $case);
    }

    //passing an array item with null value
    public function testFailureDateFormatNull()
    {
        $input = [['visit_date' => null], ['visit_date' => '2019-11-30']];
        $expected = [['visit_date' => ''], ['visit_date' => '30/11/2019']];
        $case = dateFormatUK($input);
        $this->assertEquals($expected, $case);
    }

    //passing an array without a 'visit_date' key
    public function testFailureDateFormatNoDate()
    {
        $input = [['name' => 'john', 'age' => 24], ['name' => 'dave', 'age' => 50]];
        $expected = [['name' => 'john', 'age' => 24], ['name' => 'dave', 'age' => 50]];
        $case = dateFormatUK($input);
        $this->assertEquals($expected, $case);
    }

    //passing an empty array to the function
    public function testFailureDateFormatEmptyArray()
    {
        $input = [];
        $expected = [];
        $case = dateFormatUK($input);
        $this->assertEquals($expected, $case);
    }

    //passing an array where the dates are already formatted
    public function testFailureDateFormatPreFormat()
    {
        $input = [['visit_date' => '02/02/2020'], ['visit_date' => '01/01/2019']];
        $expected = [['visit_date' => '02/02/2020'], ['visit_date' => '01/01/2019']];
        $case = dateFormatUK($input);
        $this->assertEquals($expected, $case);
    }

    public function testMalformedDateFormat()
    {
        $this->expectException(TypeError::class);
        $input = '2020-03-02';
        $case = dateFormatUK($input);
    }

    // function displayReviews Tests

    public function testSuccessDisplayReviews()
    {
        $input = [['burger_name' => 'Burger', 'restaurant' => 'McDonalds', 'visit_date' => '01/01/2020', 'image' => './images/burger.jpg', 'price' => '5.57', 'patty_rating' => 4, 'topping_rating' => 1.5, 'sides_rating' => 3, 'value_rating' => 2.5, 'total_score' => 3.2], ['burger_name' => 'Burger2', 'restaurant' => 'BurgerKing', 'visit_date' => '01/01/2020', 'image' => './images/burger.jpg', 'price' => '5.57', 'patty_rating' => 4, 'topping_rating' => 1.5, 'sides_rating' => 3, 'value_rating' => 2.5, 'total_score' => 3.2]];
        $expected = '<div class="review"><div class="review-content"><div class="review-image" style="background-image: url(./images/burger.jpg);"></div><div class="item-titles"><h4>Burger</h4><h5>McDonalds</h5></div><table class="stats"><tr><th>Visit Date:</th><td>01/01/2020</td></tr><tr><th>Price:</th><td>£5.57</td></tr><tr><th>Burger Patty:</th><td>4</td></tr><tr><th>Toppings &amp; bun:</th><td>1.5</td></tr><tr><th>Sides:</th><td>3</td></tr><tr><th>Value:</th><td>2.5</td></tr></table></div><p class="rating">Total Score:&nbsp;&nbsp;<span>3.2</span></p></div>';
        $expected .= '<div class="review"><div class="review-content"><div class="review-image" style="background-image: url(./images/burger.jpg);"></div><div class="item-titles"><h4>Burger2</h4><h5>BurgerKing</h5></div><table class="stats"><tr><th>Visit Date:</th><td>01/01/2020</td></tr><tr><th>Price:</th><td>£5.57</td></tr><tr><th>Burger Patty:</th><td>4</td></tr><tr><th>Toppings &amp; bun:</th><td>1.5</td></tr><tr><th>Sides:</th><td>3</td></tr><tr><th>Value:</th><td>2.5</td></tr></table></div><p class="rating">Total Score:&nbsp;&nbsp;<span>3.2</span></p></div>';
        $case = displayReviews($input);
        $this->assertEquals($expected, $case);
    }

    //passing the function an empty array
    public function testFailureDisplayReviewsEmptyArray()
    {
        $input = [];
        $expected = 'No records to display';
        $case = displayReviews($input);
        $this->assertEquals($expected, $case);
    }

    //passing the function a simple data type
    public function testMalformedDisplayReviews()
    {
        $this->expectException(TypeError::class);
        $input = 'Burger';
        $case = displayReviews($input);
    }

// function checkReviewKeys Tests

    //passing the function an array with exact fields
    public function testSuccessCheckReviewKeys()
    {
        $input = [['burger_name' => 'Burger', 'restaurant' => 'McDonalds', 'visit_date' => '01/01/2020', 'image' => './images/burger.jpg', 'price' => '5.57', 'patty_rating' => 4, 'topping_rating' => 1.5, 'sides_rating' => 3, 'value_rating' => 2.5, 'total_score' => 3.2]];
        $expected = true;
        $case = checkReviewKeys($input);
        $this->assertEquals($expected, $case);
    }

    //passing the function an array with extra fields
    public function testFailureCheckReviewKeysExtraFields()
    {
        $input = [['burger_name' => 'Burger', 'restaurant' => 'McDonalds', 'visit_date' => '01/01/2020', 'image' => './images/burger.jpg', 'price' => '5.57', 'patty_rating' => 4, 'topping_rating' => 1.5, 'sides_rating' => 3, 'value_rating' => 2.5, 'total_score' => 3.2, 'extra' => 'Donk']];
        $expected = false;
        $case = checkReviewKeys($input);
        $this->assertEquals($expected, $case);
    }

    //passing the function a non-nested array
    public function testFailureCheckReviewKeysNonNestArray()
    {
        $input = ['burger_name' => 'Burger', 'restaurant' => 'McDonalds', 'visit_date' => '01/01/2020', 'image' => './images/burger.jpg', 'price' => '5.57', 'patty_rating' => 4, 'topping_rating' => 1.5, 'sides_rating' => 3, 'value_rating' => 2.5];
        $expected = false;
        $case = checkReviewKeys($input);
        $this->assertEquals($expected, $case);
    }


    //passing the function an array with too few fields
    public function testFailureCheckReviewKeysNotEnoughFields()
    {
        $input = [['burger_name' => 'Burger', 'restaurant' => 'McDonalds', 'visit_date' => '01/01/2020', 'image' => './images/burger.jpg', 'price' => '5.57', 'patty_rating' => 4, 'topping_rating' => 1.5, 'sides_rating' => 3, 'value_rating' => 2.5]];
        $expected = false;
        $case = checkReviewKeys($input);
        $this->assertEquals($expected, $case);
    }

    //passing the function null values
    public function testFailureCheckReviewKeysNullValues()
    {
        $input = [['burger_name' => null, 'restaurant' => null, 'visit_date' => null, 'image' => null, 'price' => null, 'patty_rating' => null, 'topping_rating' => null, 'sides_rating' => null, 'value_rating' => null]];
        $expected = false;
        $case = checkReviewKeys($input);
        $this->assertEquals($expected, $case);
    }

    //passing a simple input type
    public function testMalformedCheckReviewKeys()
    {
        $this->expectException(TypeError::class);
        $input = 'burger';
        $case = checkReviewKeys($input);
    }

//function checkNewReviewKeys tests

    public function testSuccessCheckNewReviewKeys()
    {
        $input = ['burger_name'=>'B', 'restaurant'=>'B', 'visit_date'=>'2020-01-01', 'price'=>5, 'patty_rating'=>5, 'topping_rating'=>5, 'sides_rating'=>5, 'value_rating'=>5];
        $expected = true;
        $case = checkNewReviewKeys($input);
        $this->assertEquals($expected, $case);
    }

    public function testFailureCheckNewReviewKeysMissingKey()
    {
        $input = ['burger_name'=>'B', 'restaurant'=>'B', 'visit_date'=>'2020-01-01', 'price'=>5, 'patty_rating'=>5, 'topping_rating'=>5, 'sides_rating'=>5];
        $expected = false;
        $case = checkNewReviewKeys($input);
        $this->assertEquals($expected, $case);
    }

    public function testFailureCheckNewReviewKeysExtraKey()
    {
        $input = ['burger_name'=>'B', 'restaurant'=>'B', 'visit_date'=>'2020-01-01', 'price'=>5, 'patty_rating'=>5, 'topping_rating'=>5, 'sides_rating'=>5, 'value_rating'=>5, 'extra'=>'donk'];
        $expected = false;
        $case = checkNewReviewKeys($input);
        $this->assertEquals($expected, $case);
    }

    public function testMalformedCheckNewReviewKeys()
    {
        $this->expectException(TypeError::class);
        $input = 'burger';
        $case = checkNewReviewKeys($input);
    }


//function validateMediumString tests




//function validateDate tests




//function validatePrice tests




//function validateRating tests




//function calcTotalScore tests


}