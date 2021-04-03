@extends('html')
@section('main-title'){{ $pdata->name }}@endsection



@section('content')

    @include('head')

<div>




   <h1 style="text-align:center"> {{ $pdata->name }} </h1>



    <div class="row">
        <div class="col-sm">
            {{$userstring}}
 <h3>Тип кода :{{ strtoupper($pdata->codetype) }}</h3>
        </div>
        <div class="col-sm">
 <h4>Доступна: {{ $extime }}</h4>
        </div>
    </div>



 <pre id="hlight" class="brush: {{ $pdata->codetype }}" >{{ $pdata->code }}</pre>
 <style>
 #hlight{max-height: 500px!important;}
  #hlight > .syntaxhighlighter{max-height: 500px!important;}
 </style>

<div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon1">Урл адресс пасты :</span>
    <input type="text" class="form-control"  aria-label="Урл адресс пасты" aria-describedby="basic-addon1" name="url" id="url" value="{{ Request::url() }}" readonly>
  </div>


</div>
<br><hr>
<h2>Последние 10 паст</h2>




    @foreach (App\Http\Controllers\pasteController::getLastPaste() as $lpasta)
    <div class="alert alert-dark" role="alert" style="padding:5px!important;">
        <b>{{$lpasta->name}}</b>

        <div class="row">
            <div class="col-sm">
                @if ($lpasta->user!='')
                 Пользователь: {{$lpasta->user}} <br>
                @endif

                Дата создания: {{ date("d.m.Y",$lpasta->utime) }}<br>
                Тип Пасты: {{ $lpasta->codetype }}


            </div>
            <div class="col-sm">
              <a class="btn btn-sm btn-primary" style="float:right; margin:10px" href="{{route('alias',$lpasta->alias)}}" role="button">Посмотреть»</a>
            </div>
        </div>

    </div>
    @endforeach







    @include('footer')

@endsection
