<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Massage;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $messages = Massage::where('to_user_id', Auth::id())->latest()->get();

        $searchResult = null;

        if ($request->has('search')) {
            $search = $request->input('search');
            $searchResult = User::where('id', '!=', Auth::id())
                ->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%")
                          ->orWhere('email', 'like', "%$search%");
                })->first();
        }

        return view('home', [
            'messages' => $messages,
            'searchResult' => $searchResult
        ]);
    }
}

