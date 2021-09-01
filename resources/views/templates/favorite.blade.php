@extends('layouts.main')
@section('title')
    Favorite - {{ Auth::user()->name }}

@endsection
@section('content')
<div class="row">
 @if($count>=1)
    
 
  @foreach($favDesign as $f)
  @php
     $check= \App\Models\FavoriteDesingn::where(['designID'=>$f->designID ,'userID'=> auth()->user()->id])->get();
     $d=\App\Models\CrativeDesigns::where(['id'=>$f->designID])->first();
     $favClas="";
        if($check->count()>=1)
          $favClas="fa fa-heart";
          else
          $favClas="fa fa-heart-o"        
  @endphp
  <div  class="col-md-4 mt-5" >
      
        <div class="card text-center">
          <a href="{{ route('designs.store') }}/{{$d->id}}/edit"> <img class="card-img-top" src="/storage/thumbnail/{{$d->displayUrl}}" alt="Card image cap"></a>
          <hr>
          <div class="card-body" id="design-title">
            <a href="{{ route('designs.store') }}/{{$d->id}}/edit"> <h5 class="card-title">{{ $d->title }}</h5></a>
          </div>
          <div class="card-footer text-muted">
            <div class="design-icon row">
              <div class="col">
                <a href="{{ route('designs.store') }}/{{$d->id}}/edit"><i class="fa fa-edit"></i></a>
              </div>
              <div class="col">
                {{ $d->created_at->format('d,M,y')  }}
              </div>
              <div class="col">
                <a href="#" class="fav-design-icon"><i  data-id="{{ $d->id }}" class="{{ $favClas }}"></i></a>
              </div>
            </div>
          </div>

        
          
        </div>
       
      </div>
    @endforeach

    @else
    <div class="col">
      <div class="card py-5 px-5 my-5 text-center"><h3>No, Design Found<h3></div>
    </div> 
    @endif
  </div>
  
@endsection