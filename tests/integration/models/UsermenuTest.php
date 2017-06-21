<?php

/**
 * Created by:
 * User: Andy Pearson (@lonetraceur)
 * Date: 26/05/2016
 * Time: 09:06
 *
 * PHPUnit test class for unit testing integrity of the Usermenu Model
 */

use App\User;
use App\Usermenu;
use App\Http\Validators\ValidateUsermenuDepth;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UsermenuTest extends TestCase
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

    /*
     * Helper Functions
     */

    /**
     * @return mixed
     */
    protected function generate_a_usermenu()
    {
        $newUser = factory(User::class)->create();

        $newUsermenu =  Usermenu::generate([
            'user_id' => $newUser->id
        ]);

        return $newUsermenu;
    }


    /*
     * Tests
     */

    /** @test */
    public function a_usermenu_can_be_generated_by_a_user(){

        $newUser = factory(User::class)->create();

        $newUsermenu =  Usermenu::generate([
            'user_id' => $newUser->id
        ]);

        $this->assertTrue($newUsermenu->exists);

    }

    
    /** @test */
    public function the_depth_of_the_usermenu_can_be_found(){

        $newUsermenu = $this->generate_a_usermenu();

        $usermenuDepth = $newUsermenu::depth($newUsermenu->id);

        $this->assertEquals(0, $usermenuDepth);
    }

    
    /** @test */
    public function the_depth_of_a_deeper_nested_usermenu_can_be_found()
    {
        $newUser = factory(User::class)->create();

        $parentUsermenu =  Usermenu::generate([
            'user_id' => $newUser->id
        ]);

        $childUsermenu =  Usermenu::generate([
            'user_id' => $newUser->id
        ], $parentUsermenu->id);

        $usermenuDepth = $childUsermenu::depth($childUsermenu->id);

        $this->assertEquals(1, $usermenuDepth);
    }

    
    /** @test */
    public function check_that_a_usermenu_can_be_created_five_levels_deep()
    {
        $newUser = factory(User::class)->create();

        $levelOneUsermenu =  Usermenu::generate([
            'user_id' => $newUser->id
        ]);

        $levelTwoUsermenu =  Usermenu::generate([
            'user_id' => $newUser->id
        ], $levelOneUsermenu->id);

        $levelThreeUsermenu =  Usermenu::generate([
            'user_id' => $newUser->id
        ], $levelTwoUsermenu->id);

        $levelFourUsermenu =  Usermenu::generate([
            'user_id' => $newUser->id
        ], $levelThreeUsermenu->id);

        $levelFiveUsermenu =  Usermenu::generate([
            'user_id' => $newUser->id
        ], $levelFourUsermenu->id);

        $usermenuDepth = $levelFiveUsermenu::depth($levelFiveUsermenu->id);

        $this->assertEquals(4, $usermenuDepth);
    }

    
    /** @test */
    public function check_exception_is_thrown_if_validator_detects_created_usermenu_is_over_five_levels_deep()
    {
        $newUser = factory(User::class)->create();

        $levelOneUsermenu =  Usermenu::generate([
            'user_id' => $newUser->id
        ]);

        $levelTwoUsermenu =  Usermenu::generate([
            'user_id' => $newUser->id
        ], $levelOneUsermenu->id);

        $levelThreeUsermenu =  Usermenu::generate([
            'user_id' => $newUser->id
        ], $levelTwoUsermenu->id);

        $levelFourUsermenu =  Usermenu::generate([
            'user_id' => $newUser->id
        ], $levelThreeUsermenu->id);

        $levelFiveUsermenu =  Usermenu::generate([
            'user_id' => $newUser->id
        ], $levelFourUsermenu->id);

        $levelSixUsermenu =  Usermenu::generate([
            'user_id' => $newUser->id
        ], $levelFiveUsermenu->id);

        $usermenuDepth = $levelSixUsermenu::depth($levelSixUsermenu->id);

        $this->setExpectedException('Symfony\Component\HttpKernel\Exception\HttpException');
        (new ValidateUsermenuDepth)->check($usermenuDepth);

    }


    /** @test */
    public function return_users_first_usermenu_tree()
    {
        $newUser = factory(User::class)->create();

        $oneUsermenu =  Usermenu::generate([
            'user_id' => $newUser->id,
            'title' => 'First Usermenu'
        ]);

        $twoUsermenu =  Usermenu::generate([
            'user_id' => $newUser->id,
            'title' => 'Second Usermenu'
        ]);

        $firstUsermenu = $twoUsermenu::firstUsermenu($newUser);

        $this->assertEquals('First Usermenu', $firstUsermenu->title );

    }
    
    /** @test */
    public function a_usermenu_will_be_returned_as_an_eloquent_collection_when_using_hierarchy_method()
    {
        $newUser = factory(User::class)->create();

        $newUsermenu =  Usermenu::generate([
            'user_id' => $newUser->id
        ]);

        $hierarchy = $newUsermenu::hierarchy($newUser);

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $hierarchy);
    }
    
}
