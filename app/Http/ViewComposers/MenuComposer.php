<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Usermenu;

class MenuComposer
{

    protected $user;

    protected $usermenu;

    /**
     * Create a new menu composer.
     *
     * Make sure it is registered in the ViewComposerServiceProvider.php
     * Also make sure the config/javascript.php is configured!
     *
     * @param  Request  $request
     */
    public function __construct(Usermenu $usermenu, Request $request)
    {
        $this->user = $request->user();

        $this->usermenu = $usermenu;
    }

    /**
     * Bind a rendered menu (unordered list) to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('menuJSON', $this->renderMenuAsJSON());
    }


    /**
     * Generate the menu as JSON.
     *
     * This method will generate the users menu and provide it to the
     * View composer as JSON which in turn will send it to the correct view.
     *
     * @return object
     */
    protected function renderMenuAsJSON()
    {
        return $this->usermenu->hierarchy($this->user);
    }


}