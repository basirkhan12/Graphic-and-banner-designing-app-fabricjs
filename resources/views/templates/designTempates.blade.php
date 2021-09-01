@extends('layouts.main')
@section('title')
    Profile: {{ Auth::user()->name }}

@endsection
@section('content')
<div class="row">

  @if($count>=1)
  @foreach($design as $d)
  @php
     $check= \App\Models\FavoriteDesingn::where(['designID'=>$d->id ,'userID'=> auth()->user()->id])->get();
     $favClas="";
        if($check->count()>=1)
          $favClas="fa fa-heart";
          else
          $favClas="fa fa-heart-o"
        
  @endphp
  <div id="dd-{{$d->id}}"  class="col-md-4 mt-5" >
      
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
                @if (Auth()->user()->id== $d->userID  )
                <a href="#" class="delete-design-icon"><i  data-id="{{ $d->id }}" class="fa fa-trash"></i></a>
                @else
                {{ date("d,M,y", strtotime($d->created_at)) }}
                @endif
                
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
      <div class="card py-5 px-5 my-5 text-center"><h3>{{ $emptyMessage }}<h3></div>
    </div> 
    @endif
  </div>
  
@endsection