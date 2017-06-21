<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;                // Methods to handle any request from the user.
use App\Http\Controllers\Controller;
use App\AuthenticateUser;

class AuthSocialiteController extends Controller
{

    /**
     * Redirect the user to the Twitter authentication page.
     *
     * @return Response
     */
    public function login(AuthenticateUser $authenticateUser, Request $request, $provider)
    {
        /** Check the request to see if it has a 'code' POST variable (Boolean).
         *  Pass value to the execute() method in authenticateUser Class.
         */

        return $authenticateUser->execute($request->has('code'), $provider, $this);

    }

    public function userHasLoggedIn($user)
    {

        //dd($user);
        return redirect('/');
    }

}
