@if(count($errors)>0)
  <ul class="alert alert-danger">
    @foreach($errors->all() as $error)
      <li>{{$error}}</li>
    @endforeach
  </ul>
@endif


@if(session('error'))
  <div class="alert alert-danger d-block">
    {!!session('error')!!}
  </div>
@endif

@if(session('success'))
  <div class="alert alert-success d-block">
    {!!session('success')!!}
  </div>
@endif
