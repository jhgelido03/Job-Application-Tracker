<?php
namespace App\Http\Controllers;

use App\Models\MyJobs;
use Illuminate\Http\Request;

class MyJobsController extends Controller
{
    public function index(Request $request){
        return MyJobs::where('user_id',$request->user()->id)->get();
    }
        public function show(Request $request,$id)
        {
            $job = MyJobs::find($id);   
            if (!$job) {
                return response()->json(['message' => 'Job not found'], 404);
            }

            
            return response()->json(["job"=>$job],200) ;   
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
    public function update(Request $request, $id){
            $validate = $request->validate([
            'job_name'=>['required','min:2'],
            'company_name'=>['required','min:2'],
            'description'=>['required','min:2'],
            'link'=>['required','min:2']
        ]);

        $job = MyJobs::find($id);
        if(!$job){
            return response()->json(['message'=>'Job not Found'],404);
        }
        $job->update(array_merge($validate));

        return $job;
    }
    public function destroy(MyJobs $job)
    {
        $job->delete();
        return ['message'=>'Job Deleted Successfully'];
    }


}
