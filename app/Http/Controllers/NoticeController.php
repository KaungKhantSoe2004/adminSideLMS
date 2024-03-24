<?php

namespace App\Http\Controllers;

use App\Models\notice;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NoticeController extends Controller
{
    //addNoticePage
    public function addNoticePage(Request $request){
        return view('pages.addNotice');
    }


    // addNotice
    public function addNotice(Request $request){
        $data = $this->getData($request);
        $school_id = Auth::user()->school_id;
        $user_id = Auth::user()->id;
        $data['created_by'] = $user_id;
        $data['school_id']= $school_id;
        notice::create($data);
        return redirect()->route('admin#directSchoolPage')->with(['noticeAdded'=> "One Notice Added"]);
    }

public function editNotice(Request $request){
    $id = $request->id;
    $data = notice::where('id',$id)->first();
    return view('pages.editNotice',compact(['data']));
}

public function updateNotice(Request $request){
    $data = $this->getData($request);
    $id = $request->id;
    notice::where('id',$id)->update($data);
    return redirect()->route('admin#directSchoolPage')->with(['noticeUpdated'=> "One Notice Updated"]);
}

    private function getData($request){
        $validatingRules = [
            'name'=> ['required'],
            'type'=> ['required'],
            'description'=> ['required']
        ];
        Validator::make($request->all(),$validatingRules)->validate();
        return [
            'name'=> $request->name,
            'type'=> $request->type,
            'description'=> $request->description
        ];

    }


    public function deleteNotice(Request $request){
        $id = $request->id;
        notice::where('id',$id)->delete();
        return redirect()->route('admin#directSchoolPage')->with(['noticeDeleted'=> "One Notice Deleted"]);
    }
}
