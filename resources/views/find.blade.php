@extends('html')
@section('main-title')Поиск по тексту {{$retreq['find'] ?? ''}}@endsection

@section('content')

    @include('head')
<div class="container cont1">
<div class="row"><div class="col-9 bl-ver"><!-- основной блок-->
<h5 class="h44">Результаты поиска по тексту: "{{$retreq['find'] ?? ''}}"</h5>
 @if(sizeof($finditem)<=0)
<div class="alert alert-dark" role="alert" style="background-color:dimgray; color: white">
  ! поиск '{{$retreq['find'] ?? ''}}' не дал результатов !
</div>

 @endif
    @foreach ($finditem as $lpasta)

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
@if(!$notresult=='1')
 {{$finditem->links()}}
@endif
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
