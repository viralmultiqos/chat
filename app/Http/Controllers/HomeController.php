<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
         $chats = Chat::get();;
         $users = User::all();
        return view('home',compact('chats','users'));
    }

    public function createChat(Request $request)
    {
//dd(auth()->user()->name, auth()->user()->id);

        $input = $request->all();
        $message = $input['message'];
        $reciverId = $input['receiver_id'];
        $chat = new Chat([
            'sender_id' => auth()->user()->id,
            'sender_name' => auth()->user()->name,
            'message' => $message,
            'receiver_id' =>$reciverId
        ]);
        $chat->save();
        return redirect()->back();
    }

}
