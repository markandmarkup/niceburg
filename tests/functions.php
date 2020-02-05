<?php

require_once '../functions.php';

use PHPUNIT\Framework\TestCase;

class FunctionTests extends TestCase
{
    // function dateFormatUK Tests

    public function testSuccessDateFormat() {
        $input = [['visit_date'=>'2020-02-02'],['visit_date'=>'2019-11-30']];
        $expected = [['visit_date'=>'02/02/2020'],['visit_date'=>'30/11/2019']];
        $case = dateFormatUK($input);
        $this->assertEquals($expected, $case);
    }

    //passing an array item with null value
    public function testFailureDateFormat() {
        $input = [['visit_date'=>null],['visit_date'=>'2019-11-30']];
        $expected = [['visit_date'=>''],['visit_date'=>'30/11/2019']];
        $case = dateFormatUK($input);
        $this->assertEquals($expected, $case);
    }

    //passing an array without a 'visit_date' key
    public function testFailureDateFormat2() {
        $input = [['name'=>'john', 'age'=>24],['name'=>'dave', 'age'=>50]];
        $expected = [['name'=>'john', 'age'=>24],['name'=>'dave', 'age'=>50]];
        $case = dateFormatUK($input);
        $this->assertEquals($expected, $case);
    }

    //passing an empty array to the function
    public function testFailureDateFormat3() {
        $input = [];
        $expected = [];
        $case = dateFormatUK($input);
        $this->assertEquals($expected, $case);
    }

    //passing an array where the dates are already formatted
    public function testFailureDateFormat4()
    {
        $input = [['visit_date' => '02/02/2020'], ['visit_date' => '01/01/2019']];
        $expected = [['visit_date' => '02/02/2020'], ['visit_date' => '01/01/2019']];
        $case = dateFormatUK($input);
        $this->assertEquals($expected, $case);
    }

    public function testMalformedDateFormat() {
        $this->expectException(TypeError::class);
        $input = '2020-03-02';
        $case = dateFormatUK($input);
    }

    // function displayReviews Tests

    public function testSuccessDisplayReviews() {
        $input = [['burger_name'=>'Burger', 'restaurant'=>'McDonalds', 'visit_date'=>'01/01/2020', 'image'=>'./images/burger.jpg', 'price'=>'5.57', 'patty_rating'=>4, 'topping_rating'=>1.5, 'sides_rating'=>3, 'value_rating'=>2.5, 'total_score'=>3.2],['burger_name'=>'Burger2', 'restaurant'=>'BurgerKing', 'visit_date'=>'01/01/2020', 'image'=>'./images/burger.jpg', 'price'=>'5.57', 'patty_rating'=>4, 'topping_rating'=>1.5, 'sides_rating'=>3, 'value_rating'=>2.5, 'total_score'=>3.2]];
        $expected = '<div class="review"><div class="review-content"><div class="review-image" style="background-image: url(./images/burger.jpg);"></div><div class="item-titles"><h4>Burger</h4><h5>McDonalds</h5></div><table class="stats"><tr><th>Visit Date:</th><td>01/01/2020</td></tr><tr><th>Price:</th><td>£5.57</td></tr><tr><th>Burger Patty:</th><td>4</td></tr><tr><th>Toppings &amp; bun:</th><td>1.5</td></tr><tr><th>Sides:</th><td>3</td></tr><tr><th>Value:</th><td>2.5</td></tr></table></div><p class="rating">Total Score:&nbsp;&nbsp;<span>3.2</span></p></div>';
        $expected .= '<div class="review"><div class="review-content"><div class="review-image" style="background-image: url(./images/burger.jpg);"></div><div class="item-titles"><h4>Burger2</h4><h5>BurgerKing</h5></div><table class="stats"><tr><th>Visit Date:</th><td>01/01/2020</td></tr><tr><th>Price:</th><td>£5.57</td></tr><tr><th>Burger Patty:</th><td>4</td></tr><tr><th>Toppings &amp; bun:</th><td>1.5</td></tr><tr><th>Sides:</th><td>3</td></tr><tr><th>Value:</th><td>2.5</td></tr></table></div><p class="rating">Total Score:&nbsp;&nbsp;<span>3.2</span></p></div>';
        $case = displayReviews($input);
        $this->assertEquals($expected, $case);

    }

    //passing the function an array with too many fields
    public function testFailureDisplayReviews() {
        $input = [['burger_name'=>'Burger', 'restaurant'=>'McDonalds', 'visit_date'=>'01/01/2020', 'image'=>'./images/burger.jpg', 'price'=>'5.57', 'patty_rating'=>4, 'topping_rating'=>1.5, 'sides_rating'=>3, 'value_rating'=>2.5, 'total_score'=>3.2, 'extra'=>'Donk']];
        $expected = 'Keys do not match';
        $case = displayReviews($input);
        $this->assertEquals($expected, $case);

    }

    //passing the function an array with too few fields
    public function testFailureDisplayReviews2() {
        $input = [['burger_name'=>'Burger', 'restaurant'=>'McDonalds', 'visit_date'=>'01/01/2020', 'image'=>'./images/burger.jpg', 'price'=>'5.57', 'patty_rating'=>4, 'topping_rating'=>1.5, 'sides_rating'=>3, 'value_rating'=>2.5]];
        $expected = 'Keys do not match';
        $case = displayReviews($input);
        $this->assertEquals($expected, $case);

    }

    //passing the function an empty array
    public function testFailureDisplayReviews3() {
        $input = [];
        $expected = 'No records to display';
        $case = displayReviews($input);
        $this->assertEquals($expected, $case);

    }

    //passing the function a non-nested array
    public function testFailureDisplayReviews4() {
        $input = ['burger_name'=>'Burger', 'restaurant'=>'McDonalds', 'visit_date'=>'01/01/2020', 'image'=>'./images/burger.jpg', 'price'=>'5.57', 'patty_rating'=>4, 'topping_rating'=>1.5, 'sides_rating'=>3, 'value_rating'=>2.5];
        $expected = '';
        $case = displayReviews($input);
        $this->assertEquals($expected, $case);
    }

    //passing the function null values
    public function testFailureDisplayReviews5() {
        $input = [['burger_name'=>null, 'restaurant'=>null, 'visit_date'=>null, 'image'=>null, 'price'=>null, 'patty_rating'=>null, 'topping_rating'=>null, 'sides_rating'=>null, 'value_rating'=>null]];
        $expected = 'Keys do not match';
        $case = displayReviews($input);
        $this->assertEquals($expected, $case);
    }

    //passing the function a simple data type
    public function testMalformedDisplayReviews() {
        $this->expectException(TypeError::class);
        $input = 'Burger';
        $case = displayReviews($input);
    }
}