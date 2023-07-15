<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Nasrullah Mansur">
    <title>Divine Coder :: Course Outline</title>
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/welcome.css') }}">
    <link rel="shortcut icon" href="{{ asset('front/images/favicon.png') }}" type="image/x-icon">

    <style>
        footer a {
            text-decoration: none;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container welcome" style="padding-top: 30px; padding-bottom: 30px;">
        <h1>Our Courses</h1>
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

    <footer class="bg-light">
        <p class="m-0 py-3 text-center">&copy; All right reserved | <a href="https://divinecoder.com/" target="_blank">Nasrullah Mansur</a> | <a href="tel:+8801728619733">+8801728619733</a> | <a href="mailto:nasrullah.cit.bd@gmail.com">nasrullah.cit.bd@gmail.com</a></p>
    </footer>
</body>
</html>