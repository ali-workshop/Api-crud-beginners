<?php

namespace App\Http\Controllers\api;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{


        public function index(){
    

            $students=Student::all();

            return response()->json($students);

        }

        public function store(Request $request)
        {
            $validator=Validator::make($request->all(),[

                'name' =>'string',
                'age'  =>'integer'


            ]);


            if($validator->fails()){
                $data=[
                        'status' => '422',
                    'message'=>$validator->messages()

                ];

                return response()->json($data,422);
            }


            $data=Student::create([
                'name' =>$request->name,
                'age'=>$request->age,

            ]);
            // return response()->json($data ,200);
            return response()->json('the student stored successfully',200);


        }


        public function update (Request $request,$id){
            $validator=Validator::make($request->all(),[
                'name' => 'string',
                'age' => 'integer|max:21'

            ]);
            if($validator->fails()){


                $data=[
                    'status'=>'422',
                    'message' => $validator->messages()

                ];

                
                return response()->json($data,422);






            }

            $student=Student::find($id);
            // return $old_student;
            $old_student_data=[

               'name'=>$student->name,
               'age'=>$student->age

            ];


            $student->update([
                'name'=>$request->name,
                'age'=>$request->age


            ]);
            // $old_student_data->name=$request->name;
            // $old_student_data->age=$request->age;
            // $old_student_data->save();
            $data=[
                
                'status'=>'200',
                'old_student_info' => $old_student_data,
                'message'=>"the studet information updated successfully",
                'student'=>$student


            ];
            return response()->json($data,200);


        } 

        public function delete(Student $student){

            $student->delete();
            $data=[

                "status"=>'200',
                "message"=>'the student deleted successfully'
            ];
            return response()->json($data,200);
        }


        
}
