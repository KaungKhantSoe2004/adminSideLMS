<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\online;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatRoomController extends Controller
{
    //
    public function directChatRoom(){
        $schoolId = Auth::user()->school_id;

        // $active = online::where('school_id', $schoolId)->orWhere('role', 'schoolAdmin')->orWhere('role', 'teacher')->get();
 $messages = Chat::select('chats.*',  'users.img as profile', 'users.role')
 ->join('users', 'chats.sender_id', 'users.id')
 ->orWhere('users.role','schoolAdmin')->orWhere('users.role','teacher')
 ->where('users.school_id', $schoolId)->get();
//  dd($messages->toArray());
        return view('pages.chatRoom', compact([ 'messages']));
    }


    // postMessage
    public function postMessage(Request $request){
        if(!isset($request->message)){
            return back();
        }
        $message = $request->message;
        $data = [
            'sender_id'=> Auth::user()->id,
            'text'=> $message,
            'school_id'=> Auth::user()->school_id,
            'type'=> 'group',
            'seen'=> false
        ];
        chat::create($data);
        return redirect()->route('admin#directChatRoom');
    }


    // deleteChat
    public function deleteMessage(Request $request){
        $id = $request->id;
        Chat::where('id',$id)->delete();
        return redirect()->route('admin#directChatRoom');
    }

}
