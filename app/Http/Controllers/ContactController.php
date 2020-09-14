<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function handle_form(Request $request) {
        $data = [
            'name' => $request->input('name'),
            'name' => $request->input('email'),
            'name' => $request->subject,
            'name' => $request->message,

        ];
        // \Mail::to("martin@peoplehelper.org")->send(new ContactMail( $data ));

        return redirect('/kontakt')->with('msg','Email wurde erfolgreich verschickt');
    }
}
