@extends('html')
@section('main-title'){{ $pdata->name }}@endsection



@section('content')

    @include('head')

<div class="container cont1">
<div class="row"><div class="col-9 bl-ver"><!-- основной блок-->




   <h3 style="text-align:center"  class="h44"> {{ $pdata->name }} </h3>



    <div class="row">
@if ($pdata->user)
<div class="col-sm" >
<h5  class="h44">Автор: {{ $pdata->user }}</h4>
</div>
@endif


        <div class="col-sm">

 <h5  class="h44">Тип кода: {{ mb_strtoupper(pcont::PLtoTXT($pdata->codetype)) }}</h4>
        </div>
        <div class="col-sm">
 <h5  class="h44">Доступна: {{ $extime }}</h4>
        </div>
    </div>



 <pre id="hlight" class="brush: {{ $pdata->codetype }}" >{{ $pdata->code }}</pre>


<div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon1">Урл адресс пасты :</span>
    <input type="text" class="form-control"  aria-label="Урл адресс пасты" aria-describedby="basic-addon1" name="url" id="url" value="{{ Request::url() }}" readonly>
  </div>


</div>
<div class="col-3 bl-ver"> <!-- боковой блок -->

@include('rblock')
</div>
</div>
</div>







    @include('footer')

@endsection
