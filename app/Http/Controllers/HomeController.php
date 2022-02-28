<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Database $database)
    {
        $this->middleware('auth');
         $this->database = $database;
        $this->tablename = 'chat';
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

         $chats = $this->database ->getReference('chat')->orderByKey()->getSnapshot()->getValue();


         /*foreach ($chats as $key =>$value) {
             dd($value['message']);
         }*/
         //$chats = Chat::get();;
         $users = User::all();
        return view('home',compact('chats','users'));
    }
    public  function list(Request $request)
    {

        if ($request->ajax()) {
            $chats = $this->database ->getReference('chat')->orderByKey()->getSnapshot()->getValue();
            $receiver_id = $request->receiver_id;
            $user = User::where('id',$receiver_id)->first();
            $view = view('messageslist', compact('chats','user','receiver_id'))->render();

            return response()->json([
                'status' => 200,
                'html' => $view
            ]);
        }
;    }
}
