<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Donation;
use Illuminate\Support\Facades\File; // to handle files and directories
use Image; // for image manipulation

class DonationController extends Controller
{
    //
    public function getDonationList(){
        $donations = Donation::all(); 
        return view('admin.donation-list', compact('donations')); 
    }
}
