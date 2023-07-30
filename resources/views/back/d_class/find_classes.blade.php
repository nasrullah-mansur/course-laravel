@extends('back.layout.layout', [$title = 'Find Daily Classes'])

@section('content')
<section>
   <!-- Bordered striped start -->
   <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Find Daily Classes</h4>
          <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
          <div class="heading-elements">
            <ul class="list-inline mb-0">
              <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
              <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
              <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
              <li><a data-action="close"><i class="ft-x"></i></a></li>
            </ul>
          </div>
        </div>
        <div class="card-content collapse show pb-5">
          
          <div class="col-lg-6 m-auto border py-3">
            <form action="{{route('d.class.find.classes')}}" method="POST">
                @csrf
                <label class="col-12 label-control text-bold-500">
                    Select Batch
                    <select name="batch_id" class="form-control">
                        @foreach ($batches as $batch)
                        <option value="{{$batch->id}}">{{ $batch->name }}</option>
                        @endforeach
                    </select>
                    <br>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Get Classes</button>
                    </div>
                </label>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Bordered striped end -->
  </section>


@endsection
