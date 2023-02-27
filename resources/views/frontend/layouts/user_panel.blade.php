@extends('frontend.layouts.app')
@section('content')
<!--<section class="py-5">-->
<section class="">
    <!--<div class="container">-->
    <div class="" style="padding-left:0;">
        <div class="d-flex align-items-start">
			@include('frontend.inc.user_side_nav')
			<div class="aiz-user-panel">
				@yield('panel_content')
            </div>
        </div>
    </div>
</section>
@endsection