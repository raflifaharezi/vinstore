<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardSettingController extends Controller
{
    public function setting()
    {
        $user = Auth::user();
        $categories = Category::all();
        return view('pages-dashboard.dashboard-setting', [
            'user' => $user,
            'categories' => $categories
        ]); 
    }

    public function update (Request $request, $redirect)
    {
        $data = $request->all();
        $item = Auth::user();

        $item->update($data);
        return redirect()->route($redirect);
    }
}
