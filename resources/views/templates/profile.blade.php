@extends('layouts.main')
@section('title')
    Profile: {{ Auth::user()->name }}

@endsection
@section('message')
    @if ($message = Session::get('profilesuccess') || ($message = Session::get('profilesuccess')))

          

    @endif

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            
                @foreach ($errors->all() as $error)
                
               
                   
                @endforeach
        
        </div>
    @endif
@endsection
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="title">Edit Profile</h5>
                    </div>
                    <div class="card-body">
                        <form id="profile-update-f" method="POST" action="/profile-info-udate">
                                @csrf
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" required name="uName" class="form-control" placeholder="Company" value="{{ Auth::user()->name }}">
                                    </div>
                                </div>
                                <div class="col-md-6 pl-1">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" required name="uPhone"class="form-control" placeholder="Last Name" value="{{ Auth::user()->phone }}">
                                    </div>
                                </div>

                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label>You slogon</label>
                                        <input type="text" required name="uSlogon" class="form-control" placeholder="Your Profile Slogon" value="{{ Auth::user()->slogon }}">
                                    </div>
                                </div>
                                <div class="col-md-6 pl-1">
                                    <div class="form-group">
                                        <label>Your Skills(Seperate Skill by Comma (,)</label>
                                        <input type="text" required name="uSkill"class="form-control" placeholder="Your Skills" value="{{ Auth::user()->skills }}">
                                    </div>
                                </div>
                                <div class="col-md-12 px-4 py-4">
                                    <div class="form-group">
                                        <h3>About</h3>
                                        <textarea name="uAbout" class="form-control" id="summernote" placeholder="Write Some Thing about yourself" >{{ Auth::user()->about }}</textarea>
                                    </div>
                                </div>
                            

                            </div>
                            
                            
                            <div class="row">
                                <div class="col text-center">
                                <div class="form-group">

                                    <input  type="submit" class="btn btn-primary my-4" />
                                </div>
                            </div>
                            </div>
                            
                            
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="title">Upload profile Image</h5>
                    </div>
                    <div class="row justify-content-center">
                        
                        <div class="container text-center">
                            @if ($message = Session::get('profilesuccess'))
                                @yield('message')
                            @endif
                            <form action="/upload-profile-image" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="uploadme"></div>
                                <div class="form-group text-center py-3">
                                    <i class="now-ui-icons arrows-1_cloud-upload-94"
                                        style="font-size: 30px; text-align:center"></i>
                                    <input type="file" name="avatar" required id="avatarFile" aria-describedby="fileHelp">
                                    <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size
                                        of image should not be more than 2MB.</small>
                                </div>
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="title">Upload Cover Image</h5>
                    </div>
                    <div class="row justify-content-center">
                        <div class="container text-center">
                            @if ($message = Session::get('coversuccess'))
                                @yield('message')
                            @endif
                            <form action="/upload-cover-image" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group text-center py-3">
                                    <i class="now-ui-icons arrows-1_cloud-upload-94"
                                        style="font-size: 30px; text-align:center"></i>
                                    <div class="file-upload-wrapper">
                                        <input type="file" required name="cover" id="coverFile" class="file-upload"
                                            aria-describedby="fileHelp">
                                    </div>
                                    <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size
                                        of image should not be more than 2MB.</small>
                                </div>
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div>
                    
                </div>

            </div>

            <div class="col-md-4">
                <div class="card card-user">
                    <div class="image">
                        @php
                                $cover="";
                                    if(Auth()->user()->cover==""){
                                        $cover="coverdummy.jpg";
                                    }
                                    else {
                                        $cover=Auth()->user()->cover;
                                    }
                         @endphp
                        <img src="/storage/public/coverImage/{{ $cover }}" alt="...">
                    </div>
                    <div class="card-body">
                        <div class="author">
                            <a href="#">
                                @php
                                $avatar="";
                                    if(Auth()->user()->avatar==""){
                                        $avatar="avatar-dummy.png";
                                    }
                                    else {
                                        $avatar=Auth()->user()->avatar;
                                    }
                                @endphp
                                <img class="avatar border-gray" src="/storage/public/avatar/{{ $avatar }}"
                                    alt="...">
                                <h5 class="title">{{ Auth::user()->name }}</h5>
                            </a>
                            <p class="description">
                                {{ Auth::user()->email }}
                            </p>
                        </div>
                        <p class="description text-center">
                            
                        </p>
                    </div>
                    <hr>
                    <div class="button-container">
                        <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
                            <i class="fa fa-facebook-f"></i>
                        </button>
                        <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
                            <i class="fa fa-twitter"></i>
                        </button>
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
