@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Profile Info -->
    <div class="row">
        <div class="col-3 p-5">
            <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" alt="avatar" class="w-100 ">
        </div>
        <div class="col-9">
            <div><h1>Sanza Stack</h1></div>
            <div class="d-flex">
                <div class="pr-5"><strong>150</strong>posts</div>
                 <div class="pr-5"><strong>15k</strong>followers</div>
                <div class="pr-5"><strong>1000</strong>following</div> 
              </div>
                <div class="pt-4 font-weight-bold">sanza@mail.com</div>
                <div>Hi everyon im Sanza, welcome to my profile.</div> 
                <div><a href="#">www.sanzastack.com</a></div>  
        </div>
    </div>
    <!-- Profile Info -->

    <!-- Posts -->
    <div class="row pt-5">
        <div class="col-3 pr-5">
            <img src="https://w0.peakpx.com/wallpaper/40/935/HD-wallpaper-nature-beautiful.jpg" class="w-100">
        </div>
        <div class="col-3 pr-5">
            <img src="https://images.pexels.com/photos/2486168/pexels-photo-2486168.jpeg" class="w-100 h-100">
            
        </div>
        <div class="col-3 pr-5">
            <img src="https://images.rawpixel.com/image_800/cHJpdmF0ZS9sci9pbWFnZXMvd2Vic2l0ZS8yMDIzLTA5L3Jhd3BpeGVsX29mZmljZV8zM193YWxscGFwZXJfcGF0dGVybl9vZl9wYXN0ZWxfY29sb3JlZF9wZW5jaWxfdF9kNzIzNTM5YS1iMDJiLTQ0ZmItYjA5Zi1mNzQwNjMxYjM1NTNfMS5qcGc.jpg" class="w-100">  
        </div>
    </div>
    <!-- Posts -->   
</div>
@endsection
