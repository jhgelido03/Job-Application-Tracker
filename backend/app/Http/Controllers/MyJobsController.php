<?php
namespace App\Http\Controllers;

use App\Models\MyJobs;
use Illuminate\Http\Request;

class MyJobsController extends Controller
{
    public function index(){
        return MyJobs::all();
    }




}
