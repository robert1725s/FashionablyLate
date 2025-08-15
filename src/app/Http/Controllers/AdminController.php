<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\Category;
use App\Models\User;
use App\Models\Contact;

class AdminController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function login()
    {
        return view('login');
    }

    public function store(UserRequest $request)
    {
        $user = $request->only([
            'name',
            'email',
            'password',
        ]);
        User::create($user);
        return view('confirm', compact('contact', 'category'));
    }

    public function admin()
    {
        $contacts = Contact::with('category')->Paginate(7);
        $categories = Category::all();
        return view('admin', compact('contacts', 'categories'));
    }
}
