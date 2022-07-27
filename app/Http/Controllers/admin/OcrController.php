<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\academic_sessions;
use App\Models\class_students_list;
use App\Models\Schools;
use App\Models\subjects;
use App\Models\school_classes;
use App\Models\scores;
use Illuminate\Support\Facades\Route;
use App\Notifications\TextNotification;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Notification;
use Symfony\Component\Console\Input\Input;


class OcrController extends Controller
{
    public function __construct()
    {

        $this->middleware(['auth']);
    }

    public function index(){

        return view('admin.ocr');
    }

    public function ocrSend(){
        $data = request()->input('data');
        Session::put('data', $data);
    }

    public function display() {
        $schools = Schools::all();
        $subjects = subjects::all();
        $academic_session = academic_sessions::all();
        $class_students_list = class_students_list::all();
        $school_classes = school_classes::all();
        // dd($class_students_list);


        $data = Session::get('data');
        return view('admin.display', compact('data', 'schools', 'subjects', 'school_classes', 'academic_session'));
    }


    public function saveOcrScore(Request $request){


       $user = User::find(auth()->user()->id);

        $no = 1;
        $student_id = $request->STUDENT_ID ;
        $ca1 = $request->ACC1 ;
        $ca2 = $request->ACC2 ;
        $ca3 = $request->ACC3 ;
        $ca4 = $request->ACC4 ;
        $ca5 = $request->ACC5 ;
        $ca6 = $request->ACC6 ;
        $ca7 = $request->ACC7 ;
        $ca8 = $request->ACC8 ;
        $exams = $request->EXAMS ;
        $total = $request->TOTAL ;



        for($i = 0; $i < count($ca1); $i++){
            $datasave = [
                'global_id'           => $user->global_id,
                'school_id'           => $user->school_id,
                'class_id'            => $request->class_id,
                'academic_session_id' => $request->academy_session,
                'term_id'             => $request->term_id,
                'subject_id'          => $request->subjects,
                'student_id'          => $student_id[$i] ?? 0,
                'CA1'                 => $ca1[$i] ?? 0,
                'CA2'                 => $ca2[$i] ?? 0,
                'CA3'                 => $ca3[$i] ?? 0,
                'CA4'                 => $ca4[$i] ?? 0,
                'CA5'                 => $ca5[$i] ?? 0,
                'CA6'                 => $ca6[$i] ?? 0,
                'CA7'                 => $ca7[$i] ?? 0,
                'CA8'                 => $ca8[$i] ?? 0,
                'EXAM'                => $exams[$i] ?? 0,
                'TOTAL'               => $total[$i] ?? 0,
            ];
            //save data to database
            if(!DB::table('scores')->insert($datasave)){
                return redirect()->with('error', 'failed to save');
            }

        }

        $enrollmentData = [
            'body' => 'App Notification',
            'enrollmentText' => "{$user->name} used the App " . $no++ . " X",
            'url' => 'ocr.com',
            'thankyou' => 'Contact Admin if this was not authorized'
        ];

        Notification::send($user, new TextNotification($enrollmentData));



        //send success messeage
        $notification = [
            'message' => 'Student Scores Uploaded Successfully!!',
            'alert-type' => 'success'
        ];

        return redirect()->route('dashboard')->with($notification);

    }

}
