<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CrativeDesigns;
use App\Models\User;
use App\Models\FavoriteDesingn;

class DeshbordHomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $desings = CrativeDesigns::where('visible', '=', "public")->get();
        $totalDesign = $desings->count();
        $yourdesings = CrativeDesigns::where('userID', '=', Auth()->user()->id)->get();
        $totalYourDesign = $yourdesings->count();
        $users = User::all();
        $totalUsers = $users->count();
        $favDesign=FavoriteDesingn::where(['userID'=> auth()->user()->id])->get();
        $totalFavoriteDesign= $favDesign->count();
        return view('dashbord.dashbord', compact(['totalDesign','totalUsers','totalYourDesign' ,'totalFavoriteDesign']));
    }
}
