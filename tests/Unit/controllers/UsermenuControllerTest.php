<?php

/**
 * Created by:
 * User: Andy Pearson (@lonetraceur)
 * Date: 26/05/2016
 * Time: 09:06
 *
 * PHPUnit test class for unit testing integrity of the Usermenu Model
 */


use Illuminate\Foundation\Testing\DatabaseTransactions;

class UsermenuControllerTest extends TestCase
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
    public function the_index_method_returns_a_response()
    {
        $response = $this->call('GET', 'usermenu');

        $this->assertInstanceOf('Illuminate\Http\Response', $response);
    }
}
