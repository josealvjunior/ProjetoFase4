<?php
/**
 * Created by PhpStorm.
 * User: josej_000
 * Date: 17/08/2015
 * Time: 15:06
 */

namespace project\OAuth;

use Auth;

class Verifier
{
    public function verify($username, $password)
    {
        $credentials = [
            'email'    => $username,
            'password' => $password,
        ];

        if (Auth::once($credentials)) {
            return Auth::user()->id;
        }

        return false;
    }

}