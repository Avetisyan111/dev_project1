<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function showUser(): View
    {
        $user = Auth::user();

        return view('user', compact('user'));

    }
}
