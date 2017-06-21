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
use App\node;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NodeTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A new User Object
     * @var
     */
    protected $newUser;

    /**
     * A new Usermenu object
     * @var
     */
    protected $newUsermenu;

    /**
     * A new Page object
     * @var
     */
    protected $newPage;


    /**
     * NodeTest constructor.
     */
    function __construct()
    {
        parent::setUp(); // Run the parent test setUp method.
    }

    /**
     * This function will run for every test method in this class.
     * Could call a private method that creates products for each test.
     *
     * Creates a new user, new usermenu and a new page.
     */
    public function setUp(){

        // 1. Create a new user.
        $this->newUser = factory(User::class)->create();

        // 2. Generate a new usermenu. Fires an event that also generates a page.
        $this->newUsermenu =  Usermenu::generate([
            'user_id' => $this->newUser->id
        ]);

        // 3. Generate a new page. Fires an event that also generates a node.
        $this->newPage =      Page::generate([
            'usermenu_id' => $this->newUsermenu->id
        ]);

    }

    /** @test */
    public funtction a_node_can_be_added_to_an_existing_page(){

        // 1. Generate a new node.
        $this->newNode =      Node::generate();

        // 2. Connect the new node to the new page generated above.
        $this->newNode->connectsTo($this->newPage, $this->newUser);

        // 3. Assert values!
        $this->assertTrue($this->newNode->exists);
        $this->assertEquals(2, $this->newPage->nodes()->count());
    }

}
