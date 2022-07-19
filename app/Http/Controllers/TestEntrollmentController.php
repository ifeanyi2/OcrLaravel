<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestEntrollmentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function sendNotification()
    {
        $no = 1;
        $enrollmentData = [
            'body' => 'App Notification',
            'enrollmentText' => 'Saint Charles used the App for '.$no++.'time',
            'thankyou' => 'Conttact Admin if this was not authorized'
        ];
    }
}
