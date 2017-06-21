<?php namespace App;

use Auth;
use Illuminate\Contracts\Auth\Guard as Authenticator;
use Laravel\Socialite\Contracts\Factory as Socialite;
use App\Repositories\UserRepository;

class AuthenticateUser {

    /**
     * @var UserRepository
     */
    private $users;
    /**
     * @var Socialite
     */
    private $socialite;
    /**
     * @var Authenticator
     */
    private $auth;

    /**
     * Pull in any dependencies that are required to authenticate a user.
     *
     * UserRepository. This connects to the DB and the Users table.
     * Socialite. This will use the Socialite package to connect to 3rd party services.
     * Authenticator. This will allow us to check if the user is authenticated or not.
     */
    public function __construct(UserRepository $users, Socialite $socialite, Authenticator $auth)
    {
        $this->users = $users;
        $this->socialite = $socialite;
        $this->auth = $auth;
    }


    /** Authenticate a user using the socialite package.
     *
     *  The $hasCode parameter is a boolean to say if the user has sent a code already.
     *
     * @param $hasCode
     * @param $provider
     * @param $listener
     * @return mixed
     */
    public function execute($hasCode, $provider, $listener)
    {
        /**
         * If we don't have a code already, then get the authorization first.
         */
        if ( ! $hasCode ) return $this->getAuthorizationFirst($provider);

        // Run the findByUsernameOrCreate method in the UserRepository with the returned user.
        $user = $this->users->findByUsernameOrCreate($this->getUser($provider));


        Auth::login($user, true);

        return $listener->userHasLoggedIn($user);

    }

    private function getAuthorizationFirst($provider)
    {
        return $this->socialite->driver($provider)->redirect();
    }

    private function getUser($provider)
    {
        return $this->socialite->driver($provider)->user();
    }

}