<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::latest()->get();
        return view('fead.list', compact('messages'));
    }

    public function show()
    {

    }

    public function create()
    {
        return view('fead.create');
    }

    public function store()
    {
        $this->validate(request(), [
            'email' => 'required',
            'content' => 'required',
        ]);

        Message::create([
            'email' => request('email'),
            'content' => request('content'),
        ]);
        return redirect('/fead/feedbacks');
    }
}
