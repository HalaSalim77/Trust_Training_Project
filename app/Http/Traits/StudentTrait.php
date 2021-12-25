<?php

namespace App\HTTP\Traits;


use App\Models\Student;

trait StudentTrait {

	public function index(){
			//fetch all student from student table
		$student = Student::all(); 
		return view('student')->with(['student'=>$student]);

	}
}
