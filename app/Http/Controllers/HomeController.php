<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailTemplate;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function sendEmail()
    {
        $email = "hafiizhekom@gmail.com";
        Mail::to($email)->send(new SendMailTemplate("Halo"));
    }
    public function sendEmailQueue()
    {
        $email = "hafiizhekom@gmail.com";
        for ($i = 0; $i < 50; $i++) {
            dispatch(function () {
                Mail::to("hafizihekom@gmail.com")->send(new SendMailTemplate("Halo"));
            })->afterResponse();
        }
        Mail::to($email)->queue(new SendMailTemplate("Halo"));
    }
}
