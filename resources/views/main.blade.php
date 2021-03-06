@extends('html')
@section('main-title')Сервис Пасты - куски кода в удобной обёртке@endsection

@section('content')

    @include('head')
<div class="container cont1">
<div class="row"><div class="col-9 bl-ver"><!-- основной блок-->
<h3 class="h44">Все Пасты проекта :</h3>
    @foreach ($allpasta as $lpasta)

    <div class="alert alert-light border border-secondary" role="alert" style="padding:5px!important; box-shadow:0 0 5px rgb(155, 155, 155)">
        <b>{{$lpasta->name}}</b>
             <pre id="hlight2" class="brush: {{ $lpasta->codetype }}" >
             {{ pcont::ShtPasta($lpasta->code) }}
            </pre>
        <div class="row">
            <div class="col-sm">


                Дата создания: {{ date("d.m.Y",$lpasta->utime) }}<br>
                Тип Пасты: {{ pcont::PLtoTXT($lpasta->codetype) }}


            </div>
            <div class="col-sm">
                @if ($lpasta->user!='')
                 Автор: {{$lpasta->user}} <br>
                @endif
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
<div class="col-3 bl-ver"> <!-- боковой блок -->

@include('rblock')
</div>
</div>
</div>




    @include('footer')

@endsection
