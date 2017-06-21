<?php

namespace App\Http\Validators;


abstract class Validator
{

    /**
     * @param $input
     * @return mixed
     */
    abstract public function rules($input);

    /**
     * @return mixed
     */
    abstract public function accept();

    /**
     * @return mixed
     */
    abstract public function deny();


    /**
     * @param $input
     * @return bool
     */
    public function check($input)
    {

        // do validation
        if ( $this->rules($input) ) {

            $this->accept();

            return true;

        }

        $this->deny();

        return false;

    }

}