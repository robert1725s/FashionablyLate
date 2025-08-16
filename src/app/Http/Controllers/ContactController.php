<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Category;
use App\Models\Contact;

class ContactController extends Controller
{
    public function contact()
    {
        $categories = Category::all();
        if (!session('contact_data')) {
            return view('contact', compact('categories'));
        }
        $contactData = session('contact_data');

        return view('contact', compact('contactData', 'categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->only([
            'last_name',
            'first_name',
            'gender',
            'email',
            'tel-1',
            'tel-2',
            'tel-3',
            'address',
            'building',
            'category_id',
            'detail',
        ]);
        $category = Category::find($request->category_id);
        session(['contact_data' => $contact]);
        return view('confirm', compact('contact', 'category'));
    }

    public function store(Request $request)
    {
        $contact = $request->only([
            'last_name',
            'first_name',
            'gender',
            'email',
            'tel',
            'address',
            'building',
            'category_id',
            'detail',
        ]);
        Contact::create($contact);
        session()->forget('contact_data');
        return redirect('/thanks');
    }
}
