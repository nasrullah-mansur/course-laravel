<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Nasrullah Mansur">
    <title>Divine Coder :: {{ $course->name }}</title>
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('front/images/favicon.png') }}" type="image/x-icon">
    {!! $course->meta !!}

    <style>
        footer a {
            text-decoration: none;
            color: #333;
        }
    </style>
</head>
<body>

    
    <header class="header">
        <img src="{{ asset('front/images/banner.png') }}" alt="{{ $course->name }}">
        <div class="container">
            <div class="header-content">
                <h1>{!! $course->title !!}</h1>
                <p>{!! $course->description !!}</p>
                <ul>
                    <li>
                        <span>Total Class:</span>
                        <span id="total_class_count"></span>
                    </li>
                    <li>
                        <span>Total Exam:</span>
                        <span>{{ $course->total_exam }}</span>
                    </li>
                    <li>
                        <span>Duration:</span>
                        <span>{{ $course->duration }}</span>
                    </li>
                    <li>
                        <span>Technologies Cover:</span>
                        <span>{{ $course->technologies }}</span>
                    </li>
                    <li>
                        <span>Student Lavel:</span>
                        <span>{{ $course->student_level }}</span>
                    </li>
                    <li>
                        <span>Requirement:</span>
                        <span>{{ $course->requirement }}</span>
                    </li>
                </ul>
                
                <a href="{{ url('/') }}">Another Courses</a>
            </div>
        </div>
    </header>

    <!-- Course Content start -->
    <section class="course-content">
        <div class="container">
            <div class="content">
                
                <nav class="module">
                    <ul class="module-list">
                        @foreach ($classes as $cls)
                        <li class="module-category">
                            <button class="collapse-btn" type="button" data-bs-toggle="collapse" data-bs-target="#coll{{ $cls->id }}" aria-expanded="false" aria-controls="coll{{ $cls->id }}">
                                <span>{{ $cls->title }}</span>
                                <small>3 Classes</small>
                            </button>
                            <nav class="text collapse" id="coll{{ $cls->id }}">
                                
                                <ul class="class-list"> 
                                    @foreach ($cls->topics as $classItem)
                                    <li class="class-item">
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#class-topics" data-id="{{ $classItem->id }}">
                                            <span></span>
                                            <p>
                                                {{ $classItem->title }}
                                            </p>
                                        </a>
                                        
                                        
                                    </li>
                                    @endforeach
                                    
                                </ul>
                            </nav>
                        </li>
                        @endforeach
                    </ul>
                </nav>
            </div>
        </div>
    </section>
    <!-- Course Content end -->

    <footer class="bg-light">
        <p class="m-0 py-3 text-center">&copy; All right reserved | <a href="https://divinecoder.com/" target="_blank">Nasrullah Mansur</a> | <a href="tel:+8801728619733">+8801728619733</a> | <a href="mailto:nasrullah.cit.bd@gmail.com">nasrullah.cit.bd@gmail.com</a></p>
    </footer>


    <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>

    <script>

        let allCollapseBtn = document.querySelectorAll('.collapse-btn');
        Array.from(allCollapseBtn).forEach((element) => {
            element.addEventListener('click', () => {
                if(element.classList.contains('open')) {
                    element.classList.remove('open')
                } else {
                    element.classList.add('open')
                }
            })
        })
        
        
        let allModuleCatBtn = document.querySelectorAll('.module-category button');
        let totalClass = 0;

        Array.from(allModuleCatBtn).forEach((element) => {
            let classUnderCategory = element.parentElement.querySelectorAll('.class-item').length;
            if(classUnderCategory >= 0 && classUnderCategory <= 9) {
                classUnderCategory = '0' + classUnderCategory;
            }

            totalClass = totalClass + Number(classUnderCategory);

            document.getElementById('total_class_count').innerHTML = (totalClass);

            element.parentElement.querySelector('small').innerHTML = classUnderCategory + ' Classes';
        })

        
        let allClassItems = document.querySelectorAll('.class-item');
        Array.from(allClassItems).map(function(item, index) {
            item.querySelector('span').innerHTML =  addZero(index + 1) + '.';
        })

        function addZero(n) {
            if(n < 10) {
                return '0' + n;
            } else {
                return n;
            }
        }



    </script>
</body>
</html>