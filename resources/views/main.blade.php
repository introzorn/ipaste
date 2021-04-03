@extends('html')
@section('main-title')Сервис Пасты - куски кода в удобной обёртке@endsection

@section('content')

    @include('head')


<h1>Все доступные для вас пасты</h1>
    @foreach ($allpasta as $lpasta)

    <div class="alert alert-info" role="alert" style="padding:5px!important;">
        <b>{{$lpasta->name}}</b>
             <pre id="hlight2" class="brush: {{ $lpasta->codetype }}" >
             {{mb_substr($lpasta->code,0,255,'UTF-8')}}...
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

    {{$allpasta->links()}}


    @include('footer')

@endsection
