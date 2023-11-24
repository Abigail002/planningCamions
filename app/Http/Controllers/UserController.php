<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
    public static function getDriversList()
    {
        return User::whereHas('roles', function ($query) {
            $query->where('name', 'Driver');
        })->pluck('name', 'id');
    }

    public function send()
    {
        $data = [
            'recipient' => 'abigailameogno@gmail.com',
            'fromEmail' => 'medlog@fleet.com',
            'subject' => 'medlog@fleet.com',
        ];

        Mail::send('emails.test', $data, function ($message) use($data) {
            $message->from($data['recipient']);
            //$message->sender('john@johndoe.com', 'John Doe');
            $message->to($data['recipient']);
            //$message->cc('john@johndoe.com', 'John Doe');
            //$message->bcc('john@johndoe.com', 'John Doe');
            //$message->replyTo('john@johndoe.com', 'John Doe');
            $message->subject('Subject');
            $message->priority(3);
            //$message->attach('pathToFile');
        });
    }
}
