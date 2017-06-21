<?php namespace App\Rekeep\Helpers\Colours;


/**
 * Class RandomColours
 *
 * @package App\Rekeep\Helpers\Colours
 */
class RandomColours {

    /**
     * Generate a random RGB Colour
     * @return array
     */
    public static function randomRGBColour()
    {

        $randomColour[0]    = rand(0, 255);
        $randomColour[1]    = rand(0, 255);
        $randomColour[2]    = rand(0, 255);

        return $randomColour;
    }


    /**
     * Generate a random HEX Colour
     * @return string
     */
    public static function randomHEXColour()
    {

        $red        = dechex(rand(0, 255));
        $green      = dechex(rand(0, 255));
        $blue       = dechex(rand(0, 255));

        return sprintf("%02x%02x%02x", $red, $green, $blue);
    }

    /**
     * Converts RGB colours to HEX.
     *
     * @param array $rgb
     * @return string
     */
    public static function rgb2hex($rgb) {


        $hex =  str_pad(dechex($rgb[0]), 2, "0", STR_PAD_LEFT);
        $hex .= str_pad(dechex($rgb[1]), 2, "0", STR_PAD_LEFT);
        $hex .= str_pad(dechex($rgb[2]), 2, "0", STR_PAD_LEFT);

        return $hex;
    }

}