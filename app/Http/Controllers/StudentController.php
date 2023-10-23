<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Student;

use App\Http\Resources\StudentResource;

use Validator;

class StudentController extends Controller
{
    public function index()
    {
        
        $student = Student::paginate(15);
        
        return StudentResource::collection($student);

    }

    public function upload(Request $request)
    {

        $validator= Validator::make($request->all(),
        
        [
            'name'=> 'required',
            'email'=> 'required|email',
            'address'=> 'required',
            'study_course'=> 'required'
        ]);

        if ($validator->fails())
        {
            $data = [

                'status'=> 422,
                'message'=> $validator->messages()

            ];
            return response()->json($data,422);
        }

        else 
        {
            $student = new Student;

            $student->name=$request->name;
            $student->email=$request->email;
            $student->address=$request->address;
            $student->study_course=$request->study_course;

            $student->save();

            $data = [

                'status'=> 200,
                'message'=> 'Data uploaded successfully'

            ];
            return response()->json($data,200);

        }
    }

    public function edit(Request $request,$id)
    {
        $validator= Validator::make($request->all(),
        
        [
            'name'=> 'required',
            'email'=> 'required|email',
            'address'=> 'required',
            'study_course'=> 'required'
        ]);

        if ($validator->fails())
        {
            $data = [

                'status'=> 422,
                'message'=> $validator->messages()

            ];
            return response()->json($data,422);
        }

        else 
        {
            $student = Student::find($id);

            $student->name=$request->name;
            $student->email=$request->email;
            $student->address=$request->address;
            $student->study_course=$request->study_course;

            $student->save();

            $data = [

                'status'=> 200,
                'message'=> 'Data uploaded successfully'

            ];
            return response()->json($data,200);

        }
    }

    public function delete($id)
    {

        $student= Student::find($id);

        $student->delete();

        $data = [

            'status'=> 200,
            'message'=> 'Data deleted successfully'

        ];
        return response()->json($data,200);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $student = Student::where('name', 'like', "%$query%")
                            ->orWhere('email', 'like', "%$query%")
                            ->get();

        return response()->json(['students'=>$student]);
    }

    
}

