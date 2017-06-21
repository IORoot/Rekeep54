<?php

namespace App\Http\Controllers\API;

use Auth;

use App\Usermenu;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Validators\ValidateUsermenuDepth;

use App\Events\DeletingUsermenu;

class ApiUsermenuController extends Controller
{
    protected $fillable = ['state'];

    protected $guard = false;

    /**
     * Return the entire user's usermenu hierarchy
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Usermenu::hierarchy(Auth::guard('api')->user());
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
     * @param Request $request
     * @param ValidateUsermenuDepth $validator
     * @return mixed
     */
    public function store(Request $request)
    {
        // 1. Generate the Usermenu & trigger events.
        $newUsermenu = Usermenu::generate(
            [
                'user_id' => Auth::guard('api')->user()->id
            ],
            $request->input('menu_id')
        );

        // 2. Return new Menu as a hierarchy.
        return static::index();
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        return Usermenu::find($id)->first()->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showpage($id)
    {
        /*
         * Validation
         */

        return Usermenu::find($id)->page()->get();
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

        $usermenu = Usermenu::find($id);
        $usermenu->update( $request->payload );

        return static::index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        event(new DeletingUsermenu($id));

        $usermenu = Usermenu::find($id);
        $usermenu->delete();                // Uses Baum version of delete to remove.

        return static::index();
    }



}