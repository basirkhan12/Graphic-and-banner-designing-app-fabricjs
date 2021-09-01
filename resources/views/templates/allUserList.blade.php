@extends('layouts.main')
@section('title')
    Profile: {{ Auth::user()->name }}

@endsection
@section('content')
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 gutters-sm">
    @foreach ($users as $user )
    @php
        $avatar="";
        if($user->avatar==""){
                $avatar="avatar-dummy.png";
         }
         else{
               $avatar=$user->avatar;
         }
         $cover="";
        if($user->cover==""){
                $cover="coverdummy.jpg";
         }
         else{
               $cover=$user->cover;
         }
      @endphp
    <div class="col mb-3">
      <div class="card">
        <img src="/storage/public/coverImage/{{ $cover }}" alt="Cover" class="card-img-top">
        <div class="card-body text-center">
          <img src="/storage/public/avatar/{{ $avatar }}" style="width:100px;margin-top:-65px" alt="User" class="img-fluid img-thumbnail rounded-circle border-0 mb-3">
          <h5 class="card-title"><a href="/design/user/{{ $user->id }}">{{$user->name}}</a></h5>
          <p class="text-secondary mb-1">{{$user->slogon}}</p>
          <p class="text-muted font-size-sm"></p>
        </div>
        <div class="card-footer">
        </div>
      </div>
    </div>
    @endforeach
</div>

  
@endsection