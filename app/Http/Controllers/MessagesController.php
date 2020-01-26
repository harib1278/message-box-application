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
     * Send the message
     *
     */
     public function send(Request $request){
       $this->validate($request, [
         'subject' => 'required',
         'message' => 'required'
       ]);
     }
}
