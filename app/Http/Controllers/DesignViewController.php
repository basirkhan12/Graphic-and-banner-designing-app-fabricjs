<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Models\User;
use App\Models\CrativeDesigns;

class DesignViewController extends Controller
{
    public function allTemplates(Request $req){
        $design = DB::table('crative_designs')->where("visible","public")->get();
      //  return var_dump($design);
      $count=$design->count();
      $emptyMessage="Sorry, No Design Found";
       return view('templates.designTempates',compact(['design','count','emptyMessage']));
    }

    public function myTemplates(Request $req){
        $design = DB::table('crative_designs')->where("userID",Auth()->user()->id)->get();
        $count=$design->count();
        $emptyMessage="You have no Design Yet!";
        return view('templates.designTempates',compact(['design','count','emptyMessage'])) ;
    }

    public function  getDesignForUser($id){
        $user=User::where('id',$id)->first();
        $design = DB::table('crative_designs')->where("userID", $id )->where("visible","public")->orderByDesc('created_at')->get();
        $count=$design->count();
        $emptyMessage="Designs Not found for ".$user->name;
        return view('templates.userProfile',compact(['design','count','emptyMessage','user'])) ;
    }

    public function getSearch(Request $request){
        
        $q = $request->get( 'q' );
        $design = CrativeDesigns::where('title','LIKE','%'.$q.'%')->orWhere('keywords','LIKE','%'.$q.'%')->get();
        $count=count($design);
        $emptyMessage=" Sorry no design found for query : ".$q;
        return view("templates.designTempates", compact(['design',"count",'emptyMessage']));
            
        }
}