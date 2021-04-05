@extends('html')
@section('main-title')Сервис Пасты - куски кода в удобной обёртке@endsection

@section('content')

    @include('head')
<div class="container cont1">
<div class="row"><div class="col-9"><!-- основной блок-->
<h3>Все Пасты проекта :</h3>
    @foreach ($allpasta as $lpasta)

    <div class="alert alert-light border border-secondary" role="alert" style="padding:5px!important; box-shadow:0 0 5px rgb(155, 155, 155)">
        <b>{{$lpasta->name}}</b>
             <pre id="hlight2" class="brush: {{ $lpasta->codetype }}" >
             {{ mb_substr($lpasta->code,0,255,'UTF-8') }}...
            </pre>
        <div class="row">
            <div class="col-sm">
                @if ($lpasta->user!='')
                 Пользователь: {{$lpasta->user}} <br>
                @endif

                Дата создания: {{ date("d.m.Y",$lpasta->utime) }}<br>
                Тип Пасты: {{ $lpasta->codetype }}


            </div>
            <div class="col-sm">
              <a class="btn btn-primary" style="float:right; margin:10px" href="{{route('alias',$lpasta->alias)}}" role="button">Посмотреть»</a>
            </div>
        </div>

    </div>



    @endforeach
<center>
    <div style="display:block; width:max-content">
 {{$allpasta->links()}}
    </div>
</center>
</div>
<div class="col-3"> <!-- боковой блок -->

@include('rblock')
</div>
</div>
</div>




    @include('footer')

@endsection
