<?php
namespace App\Http\Controllers;

use App\Models\MyJobs;
use Illuminate\Http\Request;

class MyJobsController extends Controller
{
    public function index(Request $request){
        return MyJobs::where('user_id',$request->user()->id)->get();
    }
    public function show(Request $request,MyJobs $jobs)
    {
     return $jobs;   
    }
    public function store(Request $request){
        $validate = $request->validate([
            'job_name'=>['required','min:2'],
            'company_name'=>['required','min:2'],
            'description'=>['required','min:2'],
            'link'=>['required','min:2']
        ]);

        $job = MyJobs::create(array_merge($validate,['user_id'=> $request->user()->id]));
        return $job;
    }



}
