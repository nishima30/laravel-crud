<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Student;
use Illuminate\Support\Facades\File;

class StudentController extends Controller
{
     public function index()
    {

  $students = Student::orderBy('id' ,'DESC')->paginate(3);

return view('student.list' , ['students'=>$students]);

// $students = student::all();

// $data = compact('students');

// return view('student.list')->with($data);
 }






  public function create()
    {
        return view('student.create');
    }

    public function store(Request $request)
    {
      $validator= Validator::make($request->all(),[
         'name' => 'required',
         'email' => 'required',
         'image' => 'sometimes|image:gif,jpg,png,jpeg'
      ]);

     if($validator->passes()){

        $student = new Student();
        $student->name = $request->name;
        $student->email = $request->email;
        $student->address = $request->address;
        $student -> save();

        //upload image
        if($request->image){
            $ext = $request->image->getClientOriginalExtension();
            $newFileName = time().'.'.$ext;
            $request->image->move(public_path().'/uploads/students/',$newFileName);
            $student->image = $newFileName;
            $student -> save();

        }

        $request->session()->flash('success' , 'student added successfully');

        return redirect()->route('students.index');

     }else{

        return redirect()->route('students.create')->withErrors($validator)
        ->withInput();

     }

    }

    public function edit($id)
    {

$student = Student::findOrFail($id);

       return view('student.edit' , ['student'=>$student]);
    }

    public function update($id , Request $request) {


        $validator= Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'image' => 'sometimes|image:gif,jpg,png,jpeg'
         ]);
   
        if($validator->passes()){
   
           $student =  Student::find($id);
           $student->name = $request->name;
           $student->email = $request->email;
           $student->address = $request->address;
           $student -> save();
   
           //upload image
           if($request->image){

            $oldImage = $student->image;

               $ext = $request->image->getClientOriginalExtension();
               $newFileName = time().'.'.$ext;
               $request->image->move(public_path().'/uploads/students/',$newFileName);
               $student->image = $newFileName;
               $student -> save();

               File::delete(public_path().'/uploads/students/'.$oldImage);
   
           }
   
         //  $request->session()->flash('success' , 'student added successfully');
   
           return redirect()->route('students.index')->with('success','student 
           edited successfully');
   
        }else{
   
           return redirect()->route('students.edit' , $id)->withErrors($validator)
           ->withInput();

        }

    }



public function destroy($id , Request $request){

    $student = Student::findOrFail($id);

    File::delete(public_path().'/uploads/students/'.$student->image);

    $student->delete();

     $request->session()->flash('success','Student deleted successfully');

    return redirect()->route('students.index');


}

}
