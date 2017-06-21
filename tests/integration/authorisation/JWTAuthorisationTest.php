<?php

/**
 * Created by:
 * User: Andy Pearson (@lonetraceur)
 * Date: 20/04/2017
 * Time: 09:06
 *
 * PHPUnit test class for unit testing integrity of the User Model
 */

use App\User;
use App\Usermenu;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class JWTAuthorisationTest extends TestCase
{
    use DatabaseTransactions;

    function __construct()
    {
        parent::setUp(); // Run the setUp method.
    }

    public function setUp(){
        // This function will run for every test method in this class.
        // Could call a private method that creates menus for each test.
    }

    /*
     * This test will create a new user as a database transaction and then use the JWT
     * middleware to ask for an authorisation token.
     * The test will send the email and password to the correct endpoint and receive a
     * JSON response with a token in it.
     */
    /** @test */

    public function a_jwt_extension_can_request_and_receive_an_authorisation_token()
    {

        factory(User::class)->create(
            ['name' => 'Jane Doe', 'email' => 'Jane@gmail.com']
        );

        $this->post('http://rekeep.com/jwt/authenticate',
            ['email' => 'Jane@gmail.com','password' => 'password'])
            ->seeJsonStructure([
                'data' => [
                    'token'
                ]
            ]);

    }


    /*
     * This test wil create a dummy user with a dummy usermenu. It will then request a user
     * authorisation token which will then be used to request the usermenu for that particular
     * user.
     * It will determine if the response is a correctly formatted JSON structure with a usermenu.
     *
     * Problem:
     * PHPUNIT doesn't like running these tests with all the others. This is because of some issue
     * with multiple calls (one for the token, one for the usermenu) in the same test.
     * These tests must be run independently.
     */
    /** @test */
    public function a_jwt_extension_can_retrieve_a_usermenu_from_the_api_using_an_authorisation_token()
    {

        $responseToken = $this->post('http://rekeep.com/jwt/authenticate', ['email' => 'andy@parkourgenerations.com', 'password' => 'password'])->decodeResponseJson();

        $this->call(
            'GET',
            'http://rekeep.com/jwt/usermenu',[],[],[],
            [
                'HTTP_Authorization' => 'bearer '.$responseToken['data']['token'],
                'HTTP_X_REQUESTED_WITH' => 'XMLHttpRequest'
            ],[]
            );

            $this->seeJsonStructure([
                'data' => [
                    'usermenu' => [
                        '*' => [
                            'title', 'id', 'icon_name', 'icon_hex', 'state', 'children'
                        ]
                    ]
                ]
            ]);



    }


}
