@extends('layouts.main')
@section('title')
    Design your Grate Banner
@endsection

@section('content')

<div class="container">
	
	<div class="row">
		
        <!--Total design Start-->
		<div class="col-md-4">
			<div class="dbox dbox--color-1">
				<div class="dbox__icon">
					<i class="now-ui-icons design_palette"></i>
				</div>
				<div class="dbox__body">
					<span class="dbox__count">{{ $totalDesign }}</span>
					<span class="dbox__title">Total Design</span>
				</div>
				
				<div class="dbox__action">
					<a href="/designs/templates" class="dbox__action__btn">More Info</a>
				</div>				
			</div>
		</div>
        <!--Total design End-->

        <!--Total Users Start-->
		<div class="col-md-4">
			<div class="dbox dbox--color-2">
				<div class="dbox__icon">
					<i class="now-ui-icons users_single-02"></i>
				</div>
				<div class="dbox__body">
					<span class="dbox__count">{{ $totalUsers }}</span>
					<span class="dbox__title">Total Users</span>
				</div>
				
				<div class="dbox__action">
					<a href="/all-user" class="dbox__action__btn">More Info</a>
				</div>				
			</div>
		</div>
        <!--Total design End-->

        <!--Total Your design Start-->
		<div class="col-md-4">
			<div class="dbox dbox--color-3">
				<div class="dbox__icon">
					<i class="now-ui-icons design_image"></i>
				</div>
				<div class="dbox__body">
					<span class="dbox__count">{{ $totalYourDesign }}</span>
					<span class="dbox__title">Your Designs</span>
				</div>
				
				<div class="dbox__action">
					<a href="/designs/my-templates" class="dbox__action__btn">More Info</a>
				</div>				
			</div>
		</div>
        <!--Total Your design End-->
        <!--Total Your design Start-->
		<div class="col-md-4">
			<div class="dbox dbox--color-3">
				<div class="dbox__icon">
					<i class="now-ui-icons ui-2_favourite-28"></i>
				</div>
				<div class="dbox__body">
					<span class="dbox__count">{{ $totalFavoriteDesign }}</span>
					<span class="dbox__title">Your Favorite Designs</span>
				</div>
				
				<div class="dbox__action">
					<a href="/my-favorite" class="dbox__action__btn">More Info</a>
				</div>				
			</div>
		</div>
        <!--Total Your design End-->
	</div>
	
</div>
@endsection
