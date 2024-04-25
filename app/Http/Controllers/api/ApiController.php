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
                'age' => 'integer'

            ]);
            if($validator->fails()){


                $data=[
                    'status'=>'422',
                    'message' => $validator->messages()

                ];
                return response()->json($data,422);






            }

            $old_student=Student::find($id);
            // return $old_student;
            $old_student_data=[

               'name'=>$old_student->name,
               'age'=>$old_student->age

            ];


            $new_student_info=$old_student->update([
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
                'student'=>$old_student


            ];
            return response()->json($data,200);


        } 

        
}
