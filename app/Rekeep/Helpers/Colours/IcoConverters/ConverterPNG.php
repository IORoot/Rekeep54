<?php namespace App\Rekeep\Helpers\Colours\IcoConverters;

use App\Rekeep\Helpers\Colours\IcoConverters\FaviconConverterInterface;

class ConverterPNG implements FaviconConverterInterface
{

    /**
     * @param $inputFile
     * @return bool
     */
    public function convertToPNG($inputFile)
    {

        // Already a PNG!
        
        return true;
    }

}