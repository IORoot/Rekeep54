<?php

namespace App\Http\Controllers\JWT;

use App\Http\Controllers\JWT\JWTBaseController;
use Illuminate\Http\Request;

use JWTAuth;
use Auth;
use Tymon\JWTAuth\Exceptions\JWTException;

use App\node;
use App\Page;
use App\User;

use App\Rekeep\Helpers\Colours\FaviconPalette;
use App\Rekeep\Helpers\Images\CapturedImages;


/**
 * Class JWTNodeController
 * @package App\Http\Controllers\JWT
 */
class JWTNodeController extends JWTBaseController
{

    /* ---------------------------------------------------------------- *\

       VARIABLES

    \* ---------------------------------------------------------------- */

    /**
     * @var
     */
    protected $user;

    /**
     * @var
     */
    protected $filename;
    
    /**
     * @var
     */
    protected $localPathfile;

    /**
     * @var
     */
    protected $imagefile;



    /* ---------------------------------------------------------------- *\

       GETTERS AND SETTERS

    \* ---------------------------------------------------------------- */


    /**
     * @return mixed
     */
    public function getLocalPathfile()
    {
        return $this->localPathfile;
    }

    /**
     * @param mixed $localPathfile
     */
    public function setLocalPathfile($directory, $file)
    {

        $this->localPathfile = $directory . '/' . $file;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @param mixed $filename
     */
    public function setFilename($request)
    {
        $this->filename = md5($request->input('captured_url') . time() ) . '.' . $request->input('imgformat');

        return $this;
    }


    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;

        Auth::setUser($user);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getImagefile()
    {
        return $this->imagefile;
    }

    /**
     * @param mixed $publicPathfile
     */
    public function setImagefile($Imagefile)
    {
        $this->imagefile = $Imagefile;
    }
    /* ---------------------------------------------------------------- *\

       CONSTRUCTOR

    \* ---------------------------------------------------------------- */


    /**
     * JWTNodeController constructor.
     */
    public function __construct()
    {
        // Apply the jwt.auth middleware to all methods in this controller.
        $this->middleware('jwt.auth');
    }

    /* ---------------------------------------------------------------- *\

       RESOURCEFUL ROUTING METHODS

    \* ---------------------------------------------------------------- */


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // TODO Validate data with a Form Request

        $this->setUser(JWTAuth::parseToken()->authenticate());

        $this->setFilename($request);

        $this->setLocalPathfile(User::createUserHolocronDirectory($this->getUser()), $this->getFilename());

        $this->setImagefile(CapturedImages::generateImage($request, $this->getLocalPathfile()));

        $palette = (new FaviconPalette($request))->getPopularHEXColours(6, true, true);

        node::generate(
            [
                'image_filename'    => $this->getImagefile(),
                'url'               => $request->input('captured_url'),
                'favicon_url'       => $request->input('captured_favicon'),
                'title'             => $request->input('captured_title'),
                'image_width'       => $request->input('captured_width'),
                'image_height'      => $request->input('captured_height'),
                'colour_1_hex'      => $palette[0],
                'colour_2_hex'      => $palette[1],
                'colour_3_hex'      => $palette[2],
                'colour_4_hex'      => $palette[3],
                'colour_5_hex'      => $palette[4]
            ]
        )
        ->connectsTo(Page::find($request->input('pageid')), $this->getUser());

        return $this->respondNodeCreated('Node had been successfully created.');

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // RETURN TRUE or FALSE
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
