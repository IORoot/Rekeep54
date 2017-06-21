<?php

namespace App\Rekeep\Helpers\Colours;

use App\Rekeep\Helpers\Colours\Ico;
use App\Rekeep\Helpers\Colours\RandomColours;

/**
 * Class FaviconPalette
 *
 * This will take a Favicon URL, download it, convert to PNG and then work out the colour palette based
 * on that PNG file.
 * If there are any problems (No file supplied, cannot capture the URL, etc... A random colour palette is set.
 *
 * @package App\Rekeep\Helpers\Colours
 */
class FaviconPalette {

    /* ---------------------------------------------------------------- *\

       VARIABLES

    \* ---------------------------------------------------------------- */

    /**
     * @var
     */
    private $faviconURL;

    /**
     * @var string
     */
    private $faviconDirectory;

    /**
     * @var
     */
    private $faviconFileExtension;

    /**
     * @var
     */
    private $newInputFilename;

    /**
     * @var
     */
    private $newIcoMetaData;

    /**
     * @var
     */
    private $newPngFilename;

    /**
     * Contains the Colour information of the Favicon
     * x, y, red, green, blue, rgb, HEX
     *
     * @var array
     */
    protected $pngColourPalette = [];


    /* ---------------------------------------------------------------- *\

       GETTERS & SETTERS

    \* ---------------------------------------------------------------- */

    /**
     * @return mixed
     */
    public function getFaviconURL()
    {
        return $this->faviconURL;
    }

    /**
     * @param mixed $faviconURL
     */
    public function setFaviconURL($faviconURL)
    {
        $this->faviconURL = $faviconURL;

        return $this;
    }

    /**
     * @return string
     */
    public function getFaviconDirectory()
    {
        return $this->faviconDirectory;
    }

    /**
     * @param string $faviconDirectory
     */
    public function setFaviconDirectory()
    {
        $this->faviconDirectory = base_path() . '/public/favicons';

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFaviconFileExtension()
    {
        return $this->faviconFileExtension;
    }

    /**
     * @param mixed $faviconFileExtension
     */
    public function setFaviconFileExtension()
    {
        $this->faviconFileExtension = pathinfo($this->getFaviconURL(), PATHINFO_EXTENSION);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNewInputFilename()
    {
        return $this->newInputFilename;
    }

    /**
     * @param mixed $newInputFilename
     */
    public function setNewInputFilename()
    {
        $this->newInputFilename = $this->getFaviconDirectory() . '/' . md5($this->getFaviconURL()) . '.' . $this->getFaviconFileExtension();

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNewIcoMetaData()
    {
        return $this->NewIcoMetaData;
    }

    /**
     * @param mixed $newIcoMetaData
     */
    public function setNewIcoMetaData($metadata)
    {
        $this->NewIcoMetaData = $metadata;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNewPngFilename()
    {
        return $this->newPngFilename;
    }

    /**
     * @param mixed $newPngFilename
     */
    public function setNewPngFilename()
    {
        $this->newPngFilename = $this->getFaviconDirectory() . '/' . md5($this->getFaviconURL()) . '.png';

        return $this;
    }

    /**
     * @return array
     */
    public function getPngColourPalette()
    {
        return $this->pngColourPalette;
    }

    /**
     * @param array $pngColourPalette
     */
    public function setPngColourPalette($pngColourPalette)
    {
        $this->pngColourPalette = $pngColourPalette;
    }

    /* ---------------------------------------------------------------- *\

       CONSTRUCTOR

    \* ---------------------------------------------------------------- */

    /**
     * FaviconPalette constructor.
     * @param $capturedFaviconURL
     * @param $userDirectory
     */
    public function __construct($request)
    {

        $capturedFaviconURL = $request->input('captured_favicon');

        // 1. Strip URL and format it. (Remove any query strings or parameters)
        $capturedFaviconURL = preg_replace('/\?.*/', '', $capturedFaviconURL);


        // 2. IF URL Doesn't exist, set random palette.
        if ($capturedFaviconURL == '')
        {
            $this->setRandomColourPalette();
            return;
        }


        // 3. Setup
        $this->setFaviconDirectory();
        $this->setFaviconURL($capturedFaviconURL)->setFaviconFileExtension()->setNewInputFilename()->setNewPngFilename();


        // 4. Get the Favicon and save to ICO file. If there is a problem, set a random palette and end.
        if (! $this->retrieveFaviconFromURL($this->getFaviconURL()))
        {
            $this->setRandomColourPalette();
            return;
        }


        // 5. Set Metadata of retrieved file & change the filetype from a number to a Code.
        $this->setNewIcoMetaData(getimagesize($this->getNewInputFilename()))->reassignImageFiletypes();


        // 6. Select the correct converter based on the Filetype and pass that converter implementation.
        // ConverterICO / ConverterPNG...
        if(! $this->getNewIcoMetaData()[2])
        {
            $this->setRandomColourPalette();
            return;
        }


        // 7. Convert the Favicons
        $converterImplementation = 'App\Rekeep\Helpers\Colours\IcoConverters\Converter' . $this->getNewIcoMetaData()[2];
        $this->convertFaviconToPNG(new $converterImplementation);


        // 8. Set the palette to the new PNG file.
        $this->setColourPalette($this->getNewPngFilename());


        // 9. Cleanup and delete INPUT / PNG files
        $this->deleteAllFaviconFiles();


        // 10. Return
        return true;
    }


    /* ---------------------------------------------------------------- *\

       FILE METHODS

    \* ---------------------------------------------------------------- */

    /*
     * Grab a FavIcon from a URL
     *
     * $url URL of a Favicon.ico file.
     *
     * returns filename of .ico file created locally.
     */
    /**
     * @param $url
     */
    public function retrieveFaviconFromURL($url)
    {

        $filedata = file_get_contents($url);

        if (! $filedata){ return false; }

        $newfile = file_put_contents($this->getNewInputFilename(), $filedata);

        if (! $newfile){ return false; }

        return true;
    }


    /**
     *  Deletes and cleans up all the files used for generating the palette.
     */
    private function deleteAllFaviconFiles()
    {

        if (file_exists($this->getNewInputFilename()))
        {
            unlink($this->getNewInputFilename());
        }

        if (file_exists($this->getNewPngFilename()))
        {
            unlink($this->getNewPngFilename());
        }

    }




    /* ---------------------------------------------------------------- *\

       CONVERTER METHODS

    \* ---------------------------------------------------------------- */


    /**
     * @param IcoConverters\FaviconConverterInterface $converter
     *
     * This will expect an instance of the IcoConverter Class (ICO / PNG / JPEG / etc...)
     * And will run it's convertToPNG method to convert the specified file to a PNG file.
     */
    public function convertFaviconToPNG(IcoConverters\FaviconConverterInterface $converter){

        $converter->convertToPNG($this->getNewInputFilename());

    }


    /**
     * @return string
     */
    protected function reassignImageFiletypes()
    {

        $metadata = $this->getNewIcoMetaData();

        $imageTypeArray = array
        (
            0=>'UNKNOWN',
            1=>'GIF',
            2=>'JPEG',
            3=>'PNG',
            4=>'SWF',
            5=>'PSD',
            6=>'BMP',
            7=>'TIFF_II',
            8=>'TIFF_MM',
            9=>'JPC',
            10=>'JP2',
            11=>'JPX',
            12=>'JB2',
            13=>'SWC',
            14=>'IFF',
            15=>'WBMP',
            16=>'XBM',
            17=>'ICO',
            18=>'COUNT'
        );

        if ($metadata[2])
        {
            $metadata[2] = $imageTypeArray[$metadata[2]];
        }

        $this->setNewIcoMetaData($metadata);
    }

    /* ---------------------------------------------------------------- *\

       COLOUR GENERATOR / FINDER METHODS

    \* ---------------------------------------------------------------- */

    /*
     * Create an array of all the RGB values of every pixel in the image.
     */
    /**
     * @return array
     */
    public function setColourPalette($pngFilename)
    {

        // Create Image from file.
        $im = imagecreatefrompng($pngFilename);
        $dimensions = getimagesize($pngFilename);

        $pixelArray = array();

        // Iterate through every line of image. n^2. get to n?
        for ($i = 0; $i <= $dimensions[1] - 1; $i++) {
            for ($j = 0; $j <= $dimensions[0] - 1; $j++) {

                $RGBvalue = imagecolorat($im, $j, $i);

                $red      = ($RGBvalue >> 16) & 0xFF;
                $green    = ($RGBvalue >> 8) & 0xFF;
                $blue     = $RGBvalue & 0xFF;

                $pixelArray['x'] = $j;
                $pixelArray['y'] = $i;
                $pixelArray['red'] = $red;
                $pixelArray['green'] = $green;
                $pixelArray['blue'] = $blue;
                $pixelArray['rgb'] = $red.','.$green.','.$blue;
                $pixelArray['HEX'] = RandomColours::rgb2hex([$red,$green,$blue]);

                array_push($this->pngColourPalette, $pixelArray);

            }
        }

        return true;

    }


    /**
     * @param $numberOfEntries
     * @return bool
     */
    public function setRandomColourPalette($numberOfEntries = 10)
    {

        $HEXArray = array();

        for ($i = 0; $i <= $numberOfEntries; $i++) {

            $HEXArray['HEX'] = RandomColours::randomHEXColour();

            array_push($this->pngColourPalette, $HEXArray);
        }

        return true;
    }




    /*
     * Orders the colour array into the most popular and then returns the top X amount
     */
    /**
     * @param null $numberOfColoursToReturn
     * @param bool $unsetBlack
     * @param bool $unsetWhite
     * @param bool $unsetGrey
     * @return array Array of Popular Colours ordered by most popular first.
     */
    public function getPopularHEXColours( $numberOfColoursToReturn = null, $unsetBlack = false, $unsetWhite = false, $unsetGrey = false )
    {

        $popularArray   = array();

        $HEXArray       = array();

        // Add a # at the beginning of the colour HEX number. (Otherwise sorting doesn't work)
        foreach($this->getPngColourPalette() as $pixelColour)
        {
            array_push($HEXArray, '#' . $pixelColour['HEX']);
        }


        // Remove Black and White from Array list.
        if ($unsetBlack) {
            $bw_array = array('#000000', '#ffffff');
            $HEXArray = array_diff($HEXArray, $bw_array);
        }

        // Remove Greyscales from Array list.
        if ($unsetGrey) {
            for ($x=0x00; $x<=0xFF; $x++)
            {
                $hexvalue = dechex($x).dechex($x).dechex($x);
                unset($HEXArray['#'.$hexvalue]);
            }
        }

        // Find frequency of each value in array.
        $popularArray = array_count_values($HEXArray);

        // Sort Array by popularity.
        arsort($popularArray);

        // Slice the array to return correct number of results.
        $popularArray = array_slice($popularArray,0, $numberOfColoursToReturn);

        // remove the # character from every entry.
        foreach ( $popularArray as $k=>$v )
        {
            $newK = substr($k,1,6);
            $popularArray[$newK] = $popularArray[$k];
            unset($popularArray[$k]);
        }

        $returnArray = array_pad(array_keys($popularArray), $numberOfColoursToReturn, '------');

        return $returnArray;

    }





    /*
    * Gets the predominant colours from the favicon file.
    */
    /**
     * @param $x
     * @param $y
     * @return array|bool
     */
    public function get_colour_at_XY_coords($x, $y)
    {
        if ($this->getNewPngFilename())
        {
            $im = imagecreatefrompng($this->getNewPngFilename());
            $rgb = imagecolorat($im, $x, $y);
            $r = ($rgb >> 16) & 0xFF;
            $g = ($rgb >> 8) & 0xFF;
            $b = $rgb & 0xFF;

            return [$r,$g,$b];

        } else {

            return false;

        }
    }

}