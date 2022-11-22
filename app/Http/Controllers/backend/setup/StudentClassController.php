<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use App\Models\StudentClass;
use Dotenv\Util\Str;
use Illuminate\Http\Request;

class StudentClassController extends Controller
{
    public function ViewStudent(){
        $data['allData']=StudentClass::all();
        return view('backend.setup.student_class.view_class',$data);
    }

    public function StudentClassAdd(){
        return view('backend.setup.student_class.add_class');
    }

    public function StudentClassStore(Request $request){
        $validateData=$request->validate([
            'name'=>'required|unique:StudentClasses,name',
        ]);
        $data=new StudentClass();
        $data->name=$request->name;
        $data->save();


        $notification=array(
            'message'=>'Student Class Added Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('student.class.view')->with($notification);
    }
}
