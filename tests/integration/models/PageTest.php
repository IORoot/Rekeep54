<?php

/**
 * Created by:
 * User: Andy Pearson (@lonetraceur)
 * Date: 26/05/2016
 * Time: 09:06
 *
 * PHPUnit test class for unit testing integrity of the Page Model
 */

use App\User;
use App\Usermenu;
use App\Page;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PageTest extends TestCase
{
    use DatabaseTransactions;

    function __construct()
    {
        parent::setUp(); // Run the setUp method.
    }

    public function setUp(){
        // This function will run for every test method in this class.
        // Could call a private method that creates products for each test.
    }

    /** @test */
    public function a_page_is_created_when_a_usermenu_is_generated_by_a_user(){

        $newUser = factory(User::class)->create();

        $newUsermenu =  Usermenu::generate([
            'user_id' => $newUser->id
        ]);

        $this->assertTrue($newUsermenu->exists);
    }
    
}
