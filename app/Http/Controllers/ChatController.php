<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;

class ChatController extends Controller
{
    /**
     * @var string
     */


    public function __construct(Database $database)
    {
        $this->database = $database;
        $this->tablename = 'chat';
    }
    public function createChat(Request $request)
    {
//dd(auth()->user()->name, auth()->user()->id);
        $input = $request->all();
        $message = $request->message;
        $reciverId = $request->reciever_id;
        $postData = [
            'sender_id' => auth()->user()->id,
            'message' => $message,
            'receiver_id' =>$reciverId
        ];
        $postRef = $this->database->getReference( $this->tablename)->push($postData);
       return $message;
    }
}
