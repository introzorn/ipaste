
@if (Auth::Check())
<div class="alert alert-dark larg" style="margin-top:10px; background-color:rgb(4, 33, 95); color: white;" >Мои новые пасты:</div>


@foreach (pcont::getMyLastPaste() as $mpasta)
<div class="alert alert-dark" role="alert" style="padding:5px!important; margin: 2px">
   <div style="text-overflow: ellipsis;font-size:10pt; width:100%; overflow:hidden; white-space: nowrap;"> <b>{{$mpasta->name}}</b></div>

    <div class="row">
        <div class="col-sm " style="font-size:8.5pt;white-space: nowrap;">


            Дата создания: {{ date("d.m.Y",$mpasta->utime) }}<br>
            Тип Пасты: {{ $mpasta->codetype }}


        </div>
        <div class="col-sm">
          <a class="btn btn-sm btn-primary" style="float:right; margin:10px" href="{{route('alias',$mpasta->alias)}}" role="button">Посмотреть»</a>
        </div>
    </div>

</div>
@endforeach



@endif


<div class="alert alert-dark larg" style="margin-top:10px; background-color:dimgray; color: white;" >последние @if (Auth::Check()){{4}}@else{{10}}@endif паст:</div>
@foreach (pcont::getLastPaste() as $lpasta)
<div class="alert alert-dark" role="alert" style="padding:5px!important; margin: 2px">
   <div style="text-overflow: ellipsis;font-size:10pt; width:100%; overflow:hidden; white-space: nowrap;"> <b>{{$lpasta->name}}</b></div>

    <div class="row">
        <div class="col-sm " style="font-size:8.5pt;white-space: nowrap;">
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
