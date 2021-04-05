@extends('html')
@section('main-title'){{ $pdata->name }}@endsection



@section('content')

    @include('head')

<div class="container cont1">
<div class="row"><div class="col-9"><!-- основной блок-->




   <h3 style="text-align:center"> {{ $pdata->name }} </h3>



    <div class="row">
        <div class="col-sm">
            <h3>{{$pdata->user}}</h3>
 <h3>Тип кода :{{ strtoupper($pdata->codetype) }}</h3>
        </div>
        <div class="col-sm">
 <h4>Доступна: {{ $extime }}</h4>
        </div>
    </div>



 <pre id="hlight" class="brush: {{ $pdata->codetype }}" >{{ $pdata->code }}</pre>


<div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon1">Урл адресс пасты :</span>
    <input type="text" class="form-control"  aria-label="Урл адресс пасты" aria-describedby="basic-addon1" name="url" id="url" value="{{ Request::url() }}" readonly>
  </div>


</div>
<div class="col-3"> <!-- боковой блок -->

@include('rblock')
</div>
</div>
</div>







    @include('footer')

@endsection
