<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\User;

class MessagesController extends Controller
{
    /*
    * Call the middleware method here instead of in the route definition
    */
    public function __construct(){
      $this->middleware('auth');
    }

    public function index(){

      // Get the messages passed to the currently logged in user using the Auth facade
      $messages = Message::with('userFrom')->where('user_id_to', Auth::id())->notDeleted()->get();

      return view('home')->with('messages', $messages);
    }

    /**
     * Create message to send
     * TODO: change to post method
     *
     */
    public function create(int $id = 0, String $subject = ''){
      // Check for get param and assign 0 if not set
      if ($id === 0) {
        //Stop the user from being able to send message to themselves
        $users = User::where('id', '!=', Auth::id())->get();
      } else {
        $users = User::where('id', $id)->get();
      }

      // Deal with re prefix on replies
      if ($subject !== '')
        $subject = 'Re: ' . $subject;

      return view('create')->with([
        'users'   => $users,
        'subject' => $subject
      ]);
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
       $messages = Message::with('userTo')->where('user_id_from', Auth::id())->orderBy('created_at', 'desc')->get();

       return view('sent')->with('messages', $messages);
     }

     /**
      * Render the Message page
      *
      */
     public function read(int $id){
       $message = Message::with('userFrom')->find($id);

       if ($message === null) {
         return view('read')->with('message', false);
       }

       // Stop users reading each others messages
       if (Auth::id() !== $message->user_id_to){
         return redirect()->to('/home');
       }

       // If message opened = set the read flag
       $message->read = true;
       $message->save();

       return view('read')->with('message', $message);
     }


     /**
      * Delete message
      *
      */
     public function delete(int $id){
       $message = Message::find($id);

       if ($message === null) {
         return view('read')->with([
           'errors'  => 'Message not found',
           'messsge' => false
         ]);
       }

       // Stop users deleting each others messages
       if (Auth::id() !== $message->user_id_to){
         return redirect()->to('/home');
       }

       // Set the soft delete flag
       $message->deleted = true;
       $message->save();

       return redirect()->to('/home')->with('status', 'Message deleted successfully');
     }

     /**
      * View deleted messages
      *
      */
     public function deleted(){
       $messages = Message::with('userFrom')->where('user_id_to', Auth::id())->Deleted()->get();

       return view('deleted')->with('messages', $messages);
     }

     /**
      * Restore messages
      *
      */
     public function restore(int $id){
       $message = Message::find($id);

       if ($message === null) {
         return view('read')->with([
           'errors'  => 'Message not found',
           'messsge' => false
         ]);
       }

       // Set the soft delete flag
       $message->deleted = false;
       $message->save();

       return redirect()->to('/home')->with('status', 'Message restored successfully');
     }
}
