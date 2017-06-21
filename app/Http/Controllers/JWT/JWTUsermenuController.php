<?php

namespace App\Http\Controllers\JWT;

use App\Rekeep\Transformers\UsermenuTransformer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

use App\Usermenu;

class JWTUsermenuController extends Controller
{

    /**
     * @var Rekeep\Transformer\UsermenuTransformer
     */
    protected $usermenuTransformer;

    public function __construct(UsermenuTransformer $usermenuTransformer)
    {
        // Apply the jwt.auth middleware to all methods in this controller.
        $this->middleware('jwt.auth');

        $this->UsermenuTransformer = $usermenuTransformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Check Authorisation.
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {

                return response()->json([
                    'error' => [
                        'message' => 'User could not be found',
                        'code' => '402'
                    ]
                ], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            //return response()->json(['token_expired'], $e->getStatusCode());

            return response()->json([
                'error' => [
                    'message' => 'Token has Expired',
                    'code' => '501'
                ]
            ], $e->getStatusCode());


        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            //return response()->json(['token_invalid'], $e->getStatusCode());

            return response()->json([
                'error' => [
                    'message' => 'Token is Invalid',
                    'code' => '502'
                ]
            ], $e->getStatusCode());



        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            //return response()->json(['token_absent'], $e->getStatusCode());

            return response()->json([
                'error' => [
                    'message' => 'Token is Absent',
                    'code' => '503'
                ]
            ], $e->getStatusCode());

        }

        // grab the users usermenu.
        $usermenu = Usermenu::hierarchy($user);

        // the token is valid and we have found the user
        // Apply a transform on the data to mask any fields not needed.
        return response()->json([
            //'usermenu' => $this->transform($usermenu)
            'data' => [
                'usermenu' => $this->UsermenuTransformer->transformCollection($usermenu->toArray())
            ]
        ], 200);

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
