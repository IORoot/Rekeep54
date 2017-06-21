<?php

/**
 * Created by:
 * User: Andy Pearson (@lonetraceur)
 * Date: 26/05/2016
 * Time: 09:06
 *
 * PHPUnit test class for unit testing integrity of the User Model
 */

use App\User;
use App\Usermenu;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    protected $product;

    function __construct()
    {
        parent::setUp(); // Run the setUp method.
    }

    public function setUp(){
        // This function will run for every test method in this class.
        // Could call a private method that creates menus for each test.
    }



    /** @test */
    public function a_user_can_be_added_manually(){

        $newuser = new User(
            ['name' => 'Jane Doe'],
            ['email' => 'Jane@gmail.com'],
            ['password' => 'pa55word'],
            ['remember_token' => '12ab34cd56'],
            ['api_token' => '12345678910']);

        $this->assertEquals('Jane Doe', $newuser->name);
    }


    /** @test */
    public function a_user_can_be_factory_generated(){

        $newuser = factory(User::class)->create(['name' => 'James Doe']);

        $this->assertEquals('James Doe', $newuser->name);
    }


    /** @test */
    public function a_user_has_an_associated_usermenu()
    {
        $newuser = factory(User::class)->create();

        $newusermenu =  factory(Usermenu::class)->create(['user_id' => $newuser->id]);

        $newuser->associateUsermenu($newusermenu);

        $this->assertEquals(1, $newuser->countMenus());
    }

    // a_user_can_login

    // a_user_can_logout

    // a_user_can_change_their_name()

    // a_user_can_change_their_password()

    // a_user_is_able_to_recover_their_password()

    // a_user_can_delete_their_account()

    // an_admin_can_lock_and_unlock_a_users_account()

    // a_user_can_change_their_email_address()

    // a_users_remember_token_can_be_updated()

    // a_user_is_able_to_create_an_account_through_facebook_oauth()

    // a_user_is_able_to_create_an_account_through_twitter_oauth()

    // a_user_is_able_to_create_an_account_through_github_oauth()

    // a_users_avatar_image_can_be_added()

    // a_users_avatar_image_can_be_removed()

    // a_users_avatar_image_can_be_updated()

    // a_users_avatar_image_can_be_updated_via_facebook_avatar()

    // a_users_avatar_image_can_be_updated_via_twitter_avatar()

    // a_users_avatar_image_can_be_updated_via_github_avatar()

}
