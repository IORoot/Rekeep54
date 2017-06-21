<?php namespace App\Rekeep\Helpers\Colours\IcoConverters;

use App\Rekeep\Helpers\Colours\IcoConverters\FaviconConverterInterface;
use App\Rekeep\Helpers\Colours\Ico;

class ConverterICO implements FaviconConverterInterface
{

    /**
     * @param $inputFile
     * @return $outputFile
     */
    public function convertToPNG($inputFile)
    {

        $outputFile = preg_replace('/\\.[^.\\s]{3,4}$/', '', $inputFile) . '.png';

        // New ICO Instance & load file
        $ico2png = new Ico();
        $ico2png->LoadFile($inputFile);

        imagepng($ico2png->GetIcon(0), $outputFile);

        return true;
    }

}