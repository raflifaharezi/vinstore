<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    //mengambil data provinsi 
    public function provinces(Request $request) {
        return Province::all();
    }
    //mengambil data regencies/kabupaten dan berdasarkan provinsi($provinces_id) 
    public function regencies(Request $request, $provinces_id) {
        return Regency::where('province_id', $provinces_id)->get();
    }
}
