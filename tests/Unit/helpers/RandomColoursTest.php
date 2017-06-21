<?php

/**
 * Created by:
 * User: Andy Pearson (@lonetraceur)
 * Date: 26/05/2016
 * Time: 09:06
 *
 * PHPUnit test class for unit testing integrity of the Random Colour Class
 */

use \App\Rekeep\Helpers\Colours\RandomColours;

class RandomColoursTest extends TestCase
{

    function __construct()
    {
        parent::setUp(); // Run the setUp method.
    }

    public function setUp(){
        // This function will run for every test method in this class.
        // Could call a private method that creates products for each test.
    }

    /** @test */
    public function a_random_hexadecimal_colour_can_be_generated(){

        $newHEXColour = RandomColours::randomHEXColour();

        $this->assertStringMatchesFormat('%x%x%x%x%x%x', $newHEXColour);
    }


    /** @test */
    public function a_random_RGB_colour_can_be_generated(){

        $newRGBColour = RandomColours::randomRGBcolour();

        $this->assertArrayHasKey('0', $newRGBColour);

        $this->assertArrayHasKey('1', $newRGBColour);

        $this->assertArrayHasKey('2', $newRGBColour);

        $this->assertArrayNotHasKey('3', $newRGBColour);
    }

    /** @test */
    public function an_RGB_colour_can_be_converted_to_a_HEX_colour(){

        $newRGBColour = RandomColours::randomRGBcolour();

        $newHEXColour = RandomColours::rgb2hex($newRGBColour);

        $this->assertStringMatchesFormat('%x%x%x%x%x%x', $newHEXColour);
    }
}