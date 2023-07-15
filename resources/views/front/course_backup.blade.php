<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Nasrullah Mansur">
    <title>Divine Coder :: Course Outline</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">
</head>
<body>

    
    <header class="header">
        <img src="{{ asset('images/banner.png') }}" alt="web design">
        <div class="container">
            <div class="header-content">
                <h1>Advance Web Design With Freelancing Guideline Course Outline (Updated 2022).</h1>
                <p>The most advanced and modern HTML, CSS & JavaScript course: master of HTML5, Latest CSS concept: flexbox, CSS Grid, responsive design, and much more.</p>
                <ul>
                    <li>
                        <span>Total Class:</span>
                        <span>54</span>
                    </li>
                    <li>
                        <span>Total Exam:</span>
                        <span>4</span>
                    </li>
                    <li>
                        <span>Duration:</span>
                        <span>6 Months</span>
                    </li>
                    <li>
                        <span>Technologies Cover:</span>
                        <span>HTML, CSS, Bootstrap, JavaScript, jQuery & more ..</span>
                    </li>
                    <li>
                        <span>Student Lavel:</span>
                        <span>Any</span>
                    </li>
                    <li>
                        <span>Requirement:</span>
                        <span>Basic Knowledge about operating computer</span>
                    </li>
                </ul>
                <h5>&copy; Nasrullah Mansur</h5>
                <a href="{{ url('/') }}">Another Courses</a>
            </div>
        </div>
    </header>

    <!-- Course Content start -->
    <section class="course-content">
        <div class="container">
            <div class="content">
                <h2>Course Content</h2>
                <p>* Click on the class item to see class topics. </p>

                <nav class="module">
                    <ul class="module-list">
                        @foreach ($webDesigns as $webDesign)
                        <li class="module-category">
                            <button class="collapse-btn" type="button" data-bs-toggle="collapse" data-bs-target="#coll{{ $webDesign->id }}" aria-expanded="false" aria-controls="coll{{ $webDesign->id }}">
                                <span>{{ $webDesign->title }}</span>
                                <small></small>
                            </button>
                            <nav class="text collapse" id="coll{{ $webDesign->id }}">
                                <ul class="class-list">
                                    @foreach ($webDesign->classes as $classItem)
                                    <li class="class-item">
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#class-topics" data-id="{{ $classItem->id }}">
                                            <span></span>
                                            <p>
                                                {{ $classItem->class_name }}
                                            </p>
                                        </a>
                                        <div class="label">
                                            @if ($classItem->class_level == 1)
                                            <div title="Beginner" class="beginner"></div>
                                            @elseif ($classItem->class_level == 2)
                                            <div title="Beginner" class="beginner"></div>
                                            <div title="Intermediate" class="intermediate"></div>
                                            @else
                                            <div title="Beginner" class="beginner"></div>
                                            <div title="Intermediate" class="intermediate"></div>
                                            <div title="Expert" class="expert"></div>
                                            @endif
                                            
                                        </div>
                                        
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


    <!-- popup start -->
    <div class="modal fade" id="class-topics">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="popup">
                    <span class="close" data-bs-dismiss="modal">&times;</span>
                    <div class="title">
                        <p class="class-title">How to learn html</p>
                        <ul></ul>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <!-- popup end -->

    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

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
        
        let allClassItems = document.querySelectorAll('.class-item a');
        Array.from(allClassItems).forEach(element => {
            element.addEventListener('click', (e) => {
                let className = element.querySelector('p').innerText;
                let modelTitle = document.querySelector('.popup .class-title');
                let modelList = document.querySelector('.popup ul');
                let dataId = element.getAttribute('data-id');
                let dataLink = "{{ route('web.design.topics', '') }}" + '/' + dataId;
                modelTitle.innerHTML = className;
                let topics = [];

                let popupLists = document.querySelector('.popup ul');
                    popupLists.innerHTML = '';
                
                fetch(dataLink).then(response => {
                    return response.json();
                }).then(data => {
                    if(data.length > 0) {
                        data.forEach(element => {
                            let topic = element.topic;
                            topics.push('<li>' + topic + '</li>');
                        })
                        modelList.innerHTML = topics.join('');
                        topics = [];
                    }
                })
            })
        });
        
          let allModuleCatBtn = document.querySelectorAll('.module-category button');
        Array.from(allModuleCatBtn).forEach((element) => {
            let classUnderCategory = element.parentElement.querySelectorAll('.class-item').length;
            if(classUnderCategory >= 0 && classUnderCategory <= 9) {
                classUnderCategory = '0' + classUnderCategory;
            }

            element.parentElement.querySelector('small').innerHTML = classUnderCategory + ' Classes';
        })

        Array.from(allClassItems).forEach((element, index) => {
            index = index + 1;
            if(index >= 0 && index <= 9) {
                index = '0' + index;
            }
            element.querySelector('a span').innerHTML = (index) + '. ';  
        })

    </script>
</body>
</html>