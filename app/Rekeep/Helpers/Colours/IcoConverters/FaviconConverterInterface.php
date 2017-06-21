<?php namespace App\Rekeep\Helpers\Colours\IcoConverters;

/*
 * Every implementation must be ConverterXXX.php where XXX is the filetype.
 *
 * The table that will look up the filetype is:
 *
 *           0=>'UNKNOWN',
 *           1=>'GIF',
 *           2=>'JPEG',
 *           3=>'PNG',
 *           4=>'SWF',
 *           5=>'PSD',
 *           6=>'BMP',
 *           7=>'TIFF_II',
 *           8=>'TIFF_MM',
 *           9=>'JPC',
 *           10=>'JP2',
 *           11=>'JPX',
 *           12=>'JB2',
 *           13=>'SWC',
 *           14=>'IFF',
 *           15=>'WBMP',
 *           16=>'XBM',
 *           17=>'ICO',
 *           18=>'COUNT'
 *
 */
interface FaviconConverterInterface
{

    /**
     * @param $inputFile
     * @return bool
     */
    public function convertToPNG($inputFile);

}