<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Usermenu;
use App\Page;
use App\Node;
use Auth;
use JavaScript;

class RekeepController extends Controller
{
    protected $currentPage;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
         * Use the PHP to Javascript transformer to send the api_token to the user once they have logged in.
         * This token is then used to make API Requests.
         *
         * Uses the library: https://github.com/laracasts/PHP-Vars-To-Js-Transformer
         */
        JavaScript::put([
            'api_token' => Auth::user()->api_token,
            'menuJSON' => Usermenu::hierarchy(Auth::user()),
        ]);

        // View Composer MenuComposer.php provides the rendered menu to the sidemenu view partial.
        // Also register in the Providers/ViewComposerServiceProvider.php
        return view('5_layouts.dashboard');
    }

}