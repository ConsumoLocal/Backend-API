<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;


class VerifyEmailController extends Controller
{
    use VerifiesEmails;

    /**
     * Marks the user as verified
     * @param Request $request
     */
    public function verify(Request $request)
    {

    }
}
