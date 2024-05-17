<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Report;
use Illuminate\Support\Facades\File; // to handle files and directories
use Image; // for image manipulation

class ReportController extends Controller
{
    //
    public function getReportList(){
        $reports = Report::all(); 
        return view('admin.report-list', compact('reports')); 
    }
}
