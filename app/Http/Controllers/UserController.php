<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function profile(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'uName'=> 'required',
            'uPhone'=>'required',
            'uSkill'=>'required',
            'uSlogon'=>'required'
        ]);
        //$user->email= $request->get('uEmail');
        $user->name=$request->get('uName');
        $user->skills=$request->get('uSkill');
        $user->slogon=$request->get('uSlogon');
        $user->phone=$request->get('uPhone');
        $user->about=$request->get('uAbout');
        $user->save();
      return redirect('/profile');
    }

    public function update_avatar(Request $request){

        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::user();

        $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();

        $request->avatar->storeAs('/public/avatar',$avatarName);

        $user->avatar = $avatarName;
        $user->save();

        return back()
            ->with('profilesuccess','You have successfully upload image.');

    }

    public function update_cover(Request $request){

        $request->validate([
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::user();

        $coverImage = $user->id.'_cover'.time().'.'.request()->cover->getClientOriginalExtension();

        $request->cover->storeAs('/public/coverImage',$coverImage);

        $user->cover = $coverImage;
        $user->save();

        return back()
            ->with('coversuccess','You have successfully upload cover image.');

    }

    public function getAllUsers(){
        $users=DB::table('users')->get();
        return view("templates.allUserList", compact("users"));

    }
}
