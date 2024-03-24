<?php

namespace App\Http\Controllers;

use App\Models\lmsClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LmsClassController extends Controller
{
    //classesDirectPage
    public function classesDirectPage(Request $request){

  $schoolId = Auth::user()->school_id;


if(isset($schoolId)){

    $data = lmsClass::select('lms_classes.*','users.name as userName','users.role as userRole')->join('users','lms_classes.created_by','users.id')
    ->when($request->key , function($query){
        $key = request('key');
        $query->where('lms_classes.name','like','%'.$key.'%');
    })
    ->where('lms_classes.school_id',$schoolId)->paginate(10);

    if($request->id){
        $classId = $request->id;
        $classData = lmsClass::where('id',$classId)->first();
        return view('pages.classes', compact(['data','classData']));
    }
    return view('pages.classes', compact(['data']));
}
        return view('pages.classes');
    }



    // createClass
    public function createClass(Request $request){
    //    $name = Auth::user()->name;
    //    $role = Auth::user()->role;
    $id = Auth::user()->id;
       $className = $request->className;
       $schoolId = Auth::user()->school_id;

       $validatingRules = [
        'className'=> ['required']
       ];
       Validator::make($request->all(),$validatingRules)->validate();
       $data = [
        'name' => $className,
        'school_id'=> $schoolId,
        'created_by' => $id
       ];
       lmsClass::create($data);
       return redirect()->route('admin#classesDirectPage')->with(['classCreated'=>$className." named class Created by You."]);
    }


    // deleteClass
    public function deleteClass(Request $request){
        $id = $request->id;
        lmsClass::where('id',$id)->delete();
        return redirect()->route('admin#classesDirectPage')->with(['deleted'=> "One Class Deleted"]);
    }

    // updateClass
    public function updateClass(Request $request){
        $validatingRules = [
            'name'=> ['required']
        ];
        Validator::make($request->all(),$validatingRules)->validate();
        $data= [
            'name'=> $request->name
        ];
        lmsClass::where('id',$request->id)->update($data);
        return redirect()->route('admin#classesDirectPage')->with(['updated'=> "Class Updated"]);
    }
}
