@extends('layouts.main')
@section('title')
    Profile: {{ Auth::user()->name }}

@endsection
@section('message')
    
@endsection

@section('content')


@php
$avatar="";
    if($user->avatar==""){
        $avatar="avatar-dummy.png";
    }
    else {
        $avatar=$user->avatar;
    }
@endphp
<div class="container">
<div class="page-inner no-page-title">
    <!-- start page main wrapper -->
    <div id="main-wrapper">
        <div class="container">
            <div class="card card-white grid-margin">
                <div class="card-heading">
                    <div class="card-title"><h1>About me<h1></div>
                </div>
                <hr>
                <div class="card-body">
                    {!! $user->about !!}
                </div>
                
            </div>
        </div>
        <div class="row">
            <div class="col-lg-5 col-xl-4">
                <div class="card card-white grid-margin">
                    <div class="card-heading clearfix">
                        <h4 class="card-title">User Profile</h4>
                    </div>
                    <div class="card-body user-profile-card mb-3">
                        <img src="/storage/public/avatar/{{ $avatar }}" class="user-profile-image rounded-circle" alt="" />
                        <h4 class="text-center h6 mt-2">{{$user->name }}</h4>
                        <p class="text-center small">{{$user->slogon }}</p>
                        <button class="btn btn-theme btn-sm">Follow</button>
                        <button class="btn btn-theme btn-sm">Message</button>
                    </div>
                    <hr />
                    <div class="card-heading clearfix mt-3">
                        <h4 class="card-title">User Profile</h4>
                    </div>
                    <div class="card-body mb-3">
                        @php
                            $skill= explode(',',$user->skills);
                           
                        @endphp
                        @foreach ( $skill as $key => $s)
                        @if ($s!="")
                        <a href="#" class="label label-success mb-2">{{ $s }}</a>
                        @endif
                        
                        @endforeach
                    
                    </div>
                    <hr />
                
                    
                  
                </div>
            </div>
            <div class="col-lg-7 col-xl-8">
                

                <div class="profile-timeline">
                    <ul class="list-unstyled">
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
                            <div id="dd-{{$d->id}}"  class="col-md-6 mt-5" >
                                
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
                       
                </div>
            </div>
            
        </div>
        <!-- Row -->
    </div>
    <!-- end page main wrapper -->
   
</div>
</div>
@endsection
