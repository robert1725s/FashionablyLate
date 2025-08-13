<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contact()
    {
        return view('contact');
    }

    public function confirm(Request $request)
    {
        $contact = $request->only([
            'last-name',
            'first-name',
            'gender',
            'email',
            'tel',
            'address',
            'building',
            'detail',
        ]);
        return view('confirm', compact('contact'));
    }

    public function store(Request $request)
    {
        $contact = $request->only(['name', 'email', 'tel', 'content']);
        //Contact::create($contact);
        return view('thanks');
    }

    public function thanks()
    {
        return view('thanks');
    }
}
