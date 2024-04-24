<?php

namespace App\Http\Controllers\api;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{


        public function index(){
    

            $students=Student::all();

            return response()->json($students);

        }



}
