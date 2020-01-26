<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;

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

//dd($messages);
      return view('home')->with('messages', $messages);
    }
}
