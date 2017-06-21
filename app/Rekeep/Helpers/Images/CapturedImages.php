<?php namespace App\Rekeep\Helpers\Images;

use Image;

/**
 * Class CapturedImages
 * @package App\Rekeep\Helpers\Images
 */
class CapturedImages
{
    /**
     * Generate a new Image based on the passed data
     *
     * Uses the Intervention Image library
     * http://image.intervention.io/
     *
     * Save a new image to the users public directory.
     *
     * @param $imageData
     * @param $saveDirectory
     * @return string $saveDirectory
     */
    public static function generateImage($request, $saveDirectory)
    {

        if (! $request->input('captured_image') || ! $saveDirectory)
        {
            return '/images/default/image.png';
        }

        $image = Image::make($request->input('captured_image'));

        $image->save(base_path().'/public'. $saveDirectory);

        return $saveDirectory;

    }

}