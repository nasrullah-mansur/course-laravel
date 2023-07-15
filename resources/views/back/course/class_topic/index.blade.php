@extends('back.layout.layout', [$title = 'Customize class topics', $add_btn = 'Add new topic', $add_btn_link = '#add_item']) 
@section('content')

<div id="custom-menu">
    <div class="content-wrapper">
        <div class="content-body menu-builder">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="border-bottom pb-1 mb-2 text-bold-600">{{ $className->title }}</h4>
                            <form action="{{route('admin.class.topic.update')}}" method="POST">
                                @csrf
                                <div class="dd pb-3">
                                    <!-- Menu List -->
                                    <div id="list-area">
                                        <ol class="dd-list" id="dd-list">
                                            @foreach ($class_topics as $class_topic)
                                            <li class="dd-item">
                                                <div class="dd-handle d-flex justify-content-between">
                                                    <div>
                                                        <span class="title-show">{{$class_topic->title}}</span>
                                                    </div>
                                                </div>
                                                <div class="list-content">
                                                    <div class="dd-text">
                                                        <a href="javascript:void(0);" class="collapsed-btn">
                                                            <span class="ft-chevron-down"></span>
                                                        </a>
                                                    </div>
                                                    <div class="collapse border">
                                                        <div class="dd-details">
                                                            <div class="card-content">
                                                                <div class="card-body">
                                                                    <div class="form form-horizontal">
                                                                        <div class="form-body">
                                                                            <div class="form-group row">
                                                                                <div class="col-12 px-0">
                                                                                    <label class="col-12 label-control text-bold-500">
                                                                                        Title
                                                                                        <input value="{{ $class_topic->title }}" type="text" class="form-control" placeholder="Title" name="titles[]" />
                                                                                        <input type="hidden" value="{{ $class_topic->id }}" name="ids[]" />
                                                                                        <input type="hidden" value="{{ $class_topic->class_name_id }}" name="class_name_ids[]" />
                                                                                        <input type="hidden" value="{{ $class_topic->serial }}" name="serials[]" />
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-actions text-right">
                                                                            
                                                                            <button data-id="{{$class_topic->id}}" type="button" class="btn btn-danger remove-btn"><i class="ft-x"></i> Remove Item</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ol>
                                    </div>
                                </div>

                                <div class="border-top mt-3 pt-3">
                                    <button type="submit" class="set-menu-location btn btn-primary">Update All</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.class.topic.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-12 px-0">
                            <label class="col-12 label-control text-bold-500">
                                Title
                                <input value="" type="text" class="form-control" placeholder="Title" name="title" />
                                <input type="hidden" value="{{$class_id}}" name="class_name_id" />
                                <input type="hidden" name="serial" value="{{ $class_topics->last() ? $class_topics->last()->id + 1 : 1}}" />
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Item</button>
                </div>
            </div>
        </form>
    </div>
</div>




@endsection

@push('menu_js')
    <script>

const GET_DD_DATA = new Array();

        $(".dd").nestable({
            maxDepth: 1,
            serialize: "toArray",
            expandBtnHTML: null,
            collapseBtnHTML: null,
        });

        $(".dd").on("change", function () {
            let lis = $('.dd-item');
            Array.from(lis).forEach((element, index) => {
                let serialInput = element.querySelector('[name="serials[]"]')
                serialInput.value = index+1;
            });
        });


        $("#list-area").on("click", ".collapsed-btn", function () {
            $(this).parent().parent().find(".collapse").toggle();
            $(this).children("span").toggleClass("rotate");
        });

        
        // Create;
        $('.content-header-right a').on('click', function () {
            $('#exampleModal').modal('show');
        })

        // Update Title;
        $("#list-area").on("keyup", 'input[name="titles[]"]', function () {
            let inputVal = $(this).val();
            let getLi = $(this).parents("li").first();
            getLi.children().find(".title-show").first().text(inputVal);

        });

        // Remove single item;
        $('.remove-btn').on('click', function() {
            let id = $(this).attr('data-id');
            let li = $(this).parents('li');
            

            $.ajax({
                method: 'POST',
                url: "{{ route('admin.class.topic.delete') }}",
                data: {id: id},
                success: function(response) {
                    li.remove();
                },
                error: function(error) {
                    console.log(error);
                }
            })
        })

    </script>
@endpush