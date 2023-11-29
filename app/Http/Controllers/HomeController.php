<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\branches;
use App\Models\gallery_images;
use App\Models\berita;

class HomeController extends Controller
{
    public function index(){
        return redirect('dashboard');
    }
}
