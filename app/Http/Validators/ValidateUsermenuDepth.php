<?php

namespace App\Http\Validators;

class ValidateUsermenuDepth extends Validator
{

    /**
     * @param $input
     * @return bool
     */
    public function rules($input)
    {
        // return false or
        if ($input > 4)
        {
            return false;
        }

        return true;

    }

    /**
     * Acceptance method.
     */
    public function accept()
    {
        return;
    }

    /**
     * Denied Method
     */
    public function deny()
    {
        abort(412, 'Menu depth at Maximum.');
    }

}