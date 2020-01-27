<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\User;

class MessagesController extends Controller
{
    /*
    * Call the middle ware method here instead of in the route definition
    */
    public function __construct(){
      $this->middleware('auth');
    }

    public function index(){

      // Get the messages passed to the currently logged in user using the Auth facade
      $messages = Message::with('userFrom')->where('user_id_to', Auth::id())->get();

      return view('home')->with('messages', $messages);
    }

    /**
     * Create message to send
     *
     */
    public function create(){
      //Stop the user from being able to send message to themselves
      $users = User::where('id', '!=', Auth::id())->get();

      //dd($users);

      return view('create')->with('users', $users);
    }

    /**
     * Save the message
     *
     */
     public function send(Request $request){
       $this->validate($request, [
         'subject' => 'required',
         'message' => 'required'
       ]);

       $message = New Message();

       $message->user_id_from = Auth::id();
       $message->user_id_to = $request->input('to');
       $message->subject = $request->input('subject');
       $message->body = $request->input('message');

       $message->save();

       return redirect()->to('/home')->with('status', 'Message sent succesfully');
     }

     /**
      * Render the Outbox page
      *
      */
     public function sent(){
       $messages = Message::with('userTo')->where('user_id_from', Auth::id())->get();

       return view('sent')->with('messages', $messages);
     }

     /**
      * Render the Message page
      *
      */
     public function read(int $id){
       $message = Message::with('userFrom')->find($id);

       return view('read')->with('message', $message);
     }


}
