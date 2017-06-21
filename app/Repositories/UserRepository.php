<?php namespace App\Repositories;

use App\User;

/**
 * Created by PhpStorm.
 * User: Andy1
 * Date: 23/01/16
 * Time: 20:19
 */

 class UserRepository {

     public function findByUsernameOrCreate($userData)
     {
        // return 'hello';

        return User::firstOrCreate([
            'name'  => $userData->name,
            'email'     => $userData->email
        ]);

     }

 }