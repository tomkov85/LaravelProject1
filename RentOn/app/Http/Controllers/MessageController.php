<?php

namespace App\Http\Controllers;

use App\MessagesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\MessageReceivedMail;

class MessageController extends Controller
{
    /**
     * Display a listing of the messages.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {		
		$type = 'receiver';
		$bin = 0;
		if($_GET['type'] == 'outbox') {
			$type = 'sender';
		} elseif($_GET['type'] == 'bin') {
				$bin = 1;
		} elseif($_GET['type'] == 'all') {
			$type = 'all';
		}
		
		$messages = \App\MessagesModel::where($type, Auth::user()->email)->where('bin',$bin)->paginate(10);
		
        return view('messages.messageManager', ['messages' => $messages, 'type' => $type]);
    }

    /**
     * Show the form for creating a new message.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
		$mod = null;
		$userEmail = "";
		$advTitle = "";
		$user = "";
		
		if($id != 0) {
			$adv = \App\SearchModel::find($id);
			$advUser = $adv->advUser;
			$advTitle = $adv->title;
			$userEmail = \App\User::find($advUser)->email;
		}		
		
		if($id > 0) {
			$mod = true;			
		} 
		
		if(Auth::check()) {
			$user = Auth::user()->email;
		}
		
        return view('messages.create',['mod'=>$mod, 'advTitle' => $advTitle, 'userEmail'=>$userEmail, 'user'=>$user]);
    }

    /**
     * Store a newly created message in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'messageTitle'=>['string', 'max:30','required'],
            'reciever'=>['string','max:30','required'],
            'messageText'=>['string','required']
        ]);
		
        $message= new MessagesModel();
        
		
		$message->messageTitle = $request->messageTitle;
		$message->receiver = $request->reciever;
		$message->messageText = $request->messageText;
		$message->sender = $request->sender;
		$message->newMessage = 1;
		
        $message->save();

		Mail::to('tamas.kovacshazy@gmail.com')->send(new MessageReceivedMail($message->sender, $message->receiver, $message->messageTitle, $message->messageText));
		//Mail::to($request->email)->send(new OrderShipped($request->name, session()->get('userOrderList')));
	   return redirect()->action('SearchController@getTopAdvertisements');
    }

    /**
     * Display the specified message.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = \App\MessagesModel::find($id);
		if($message->newMessage) {
			$message->newMessage = 0;
			$message->save();
		}
		
        return view('messages.show', ['sender' => $message->sender, 'receiver' => $message->receiver, 'messageTitle' => $message->messageTitle, 'messageText' => $message->messageText, 'messageId' => $message->id]);
    }

    /**
     * Show the form for editing the specified message.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function replace($id)
    {
			$message = \App\MessagesModel::find($id);
			$message->bin = 0;
			$message->save();
		
		return back();
    }

    /**
     * Update the specified message in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified message from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = \App\MessagesModel::find($id);
		if($message->bin == 0){
			$message->bin = 1;
			$message->save();
		} else {
			$message->delete();
		}				
		
		return back();
    }
}
