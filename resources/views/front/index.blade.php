@extends('front.component.layout')

@section('component')
<div class="container welcome" style="padding-top: 30px; padding-bottom: 30px;">
    <h1 class="text-center">Our Courses</h1>
    <hr>
    <div class="row">
        @foreach ($courses as $course)
        <div class="col-lg-4">
           <a href="{{ route('course', $course->slug) }}">
            <div class="item">
                <div class="img">
                    <img class="w-100 img-fluid" src="{{ asset($course->image) }}" alt="{{$course->name}}">
                </div>
                <article>
                    <p>{{ $course->name }}</p>
                </article>  
               </div>
           </a>
        </div>
        @endforeach
        
    </div>
</div>
@endsection