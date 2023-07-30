@extends('front.component.layout')

@push('plugin_css')
<link rel="stylesheet" href="{{ asset('front/plugins/niceselect/nice-select.css') }}">
@endpush

@section('component')
<div class="container student-profile">
    <div class="row">
        <div class="col-lg-6">
            <div class="profile">
                <div class="img text-center">
                    <img src="{{asset($student->image ? $student->image : 'back/images/portrait/small/avatar-s-1.png')}}" alt="">
                </div>
                <div class="info">
                    <h1>Name: {{$student->name}}</h1>
                    <ul>
                        <li>Email: {{ $student->email }}</li>
                        <li>Phone: {{ $student->phone }}</li>
                        <li>Batch: {{ $batch->name }}</li>
                    </ul>
                </div>

                <div class="mt-3 text-center">
                    <a href="{{ route('student.profile.edit') }}" class="btn btn-success">Edit Profile</a>
                </div>
            </div>
            @if ($running_class && !$attendance_done)
            <div class="attendance">
                <h3>Give Attendance</h3>
                <form action="{{route('student.attendance.store')}}" method="POST">
                    @csrf
                        <div class="class-item">
                            <div class="class-attendance">
                                <input type="hidden" value="{{ $running_class->id }}" name="class_no">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="attendance_{{$running_class}}">Class No: {{ $running_class->class_no }}</label>
                                    </div>
                                    <div class="col-6 text-end">
                                        <div class="d-flex justify-content-end">
                                            <select name="attendance" id="attendance_{{$running_class}}">
                                                <option value="p">Present</option>
                                                <option value="a">Absend</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="submit-area">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                </form>
            </div>
            @endif
        </div>
        <div class="col-lg-6">
            <div class="student-status">
                <div class="status-item">
                    <p>Completed Class</p>
                    <h4>{{ $completed_classes }}</h4>
                </div>
                <div class="status-item">
                    <p>Present Class</p>
                    <h4>{{ $student_present_count }}</h4>
                </div>
                <div class="status-item">
                    <p>Absent Class</p>
                    <h4>{{ $student_absent_count }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('plugin_js')
    <script src="{{ asset('front/plugins/jquery/jquery.3.7.slim.min.js') }}"></script>
    <script src="{{ asset('front/plugins/niceselect/jquery.nice-select.min.js') }}"></script>
@endpush

@push('custom_js')
    <script>
        $(document).ready(function() {
            $('select').niceSelect();
        });
    </script>
@endpush