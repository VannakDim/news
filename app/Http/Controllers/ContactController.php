<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function edit(){
        $contact = Contact::first();
        if(!$contact){
            $contact = new Contact();
            $contact->save();
        }
        return view('admin.contact.edit',compact('contact'));
    }

    public function update( Request $request, $id){
        $request->validate([
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
            'map' => 'required',
            'telegram' => 'nullable',
            'facebook' => 'nullable',
            'twitter' => 'nullable',
            'linkedin' => 'nullable',
            'instagram' => 'nullable',
            'youtube' => 'nullable',
        ]);
        $contact = Contact::find($id);
        $contact->phone = $request->phone;
        $contact->email = $request->email;
        $contact->address = $request->address;
        $contact->map = $request->map;
        $contact->telegram = $request->telegram;
        $contact->facebook = $request->facebook;
        $contact->twitter = $request->twitter;
        $contact->linkedin = $request->linkedin;
        $contact->instagram = $request->instagram;
        $contact->youtube = $request->youtube;
        $contact->save();
        return back()->with('success','Contact Information Updated Successfully');
    }
}
