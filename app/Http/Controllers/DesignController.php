<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\CrativeDesigns;
use App\Models\FavoriteDesingn;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DesignController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     return \redirect("/designs/templates");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        //
        $title="";
        $keywords="";
        return view('editor.editor',compact(['title','keywords']));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $design = new CrativeDesigns;
        $image = $request->get('thumbnail');  // your base64 encoded
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = Str::random(10).'_'. auth()->user()->id.'.'.'png';
        Storage::put('/thumbnail/' . $imageName, base64_decode($image));

        $design->designJson = $request->get('json');
        $design->displayUrl = $imageName;
        $design->visible = $request->get('visible');
        $design->userID =auth()->user()->id;
        $design->title=$request->get('title');
        $design->keywords=$request->get('keywords');
        $design->save();
        return  $design->id;
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
         abort(404);
    


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $isBelongToUser = DB::table('crative_designs')->where(['id'=>$id,'userID'=> auth()->user()->id ])->first();
        $checkExit = DB::table('crative_designs')->find($id);
        if($checkExit){
        $canvasJson= $checkExit->designJson;
        $title=$checkExit->title;
        $keywords=$checkExit->keywords;
        if($isBelongToUser):
        return view('editor.editor',compact(['id','canvasJson','title','keywords']));
        else:
        $id='';
        $title='';
        $keywords='';
        return view('editor.editor',compact(['id','canvasJson']));
        endif;
        }
        return \abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { 
       
        $image = $request->get('thumbnail');  // your base64 encoded
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = Str::random(10).'_'. auth()->user()->id.'.'.'png';
        Storage::put('/thumbnail/' . $imageName, base64_decode($image));
        $delimag=DB::table('crative_designs')->where('id', '=', $id)->first();
        var_dump(public_path('storage/thumbnail').'/'. $delimag->displayUrl);
        File::delete(public_path('storage/thumbnail/'.$delimag->displayUrl));
     if($request->title!="" && $request->keywords!= ""){
             CrativeDesigns::where('id', '=', $id)
             ->update([
                 'displayUrl' => $imageName,
                 'designJson' =>  $request->get('json'),
                 'title'=>$request->title,
                 'keywords'=>$request->keywords
                 
             ]);
            }else{
                CrativeDesigns::where('id', '=', $id)
                ->update([
                    'displayUrl' => $imageName,
                    'designJson' =>  $request->get('json'),
                    
                    
                ]);  
            }
        return  $id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $check= CrativeDesigns::where(['id'=>$id ,'userID'=> auth()->user()->id])->first();
        if($check){
            
            File::delete(public_path('storage/thumbnail/'.$check->displayUrl));
            FavoriteDesingn::where(['designID'=>$id])->delete();
            $check= CrativeDesigns::where(['id'=>$id ,'userID'=> auth()->user()->id])->delete();
            return "deleted";
        }
        return "no access";

    }

    public function makeFavorite($id){
        $check= FavoriteDesingn::where(['designID'=>$id ,'userID'=> auth()->user()->id])->get();
        if($check->count()>=1){
            FavoriteDesingn::where(['designID'=>$id ,'userID'=> auth()->user()->id])->delete();
            return "rsuccess";
        }else{
        $favorite = new FavoriteDesingn;
        $favorite->userID = Auth()->user()->id;
        $favorite->designID= $id;
        $favorite->save();
        return "asuccess"; 
        }
    }

    public function getMyFavorite(){
        $favDesign= FavoriteDesingn::where(['userID'=> auth()->user()->id])->get();
       $count=$favDesign->count();
        return view("templates.favorite", compact(['favDesign',"count"]));
        
    }   
}
