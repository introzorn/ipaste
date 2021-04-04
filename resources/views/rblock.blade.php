<div class="alert alert-dark larg" style="margin-top:10px; background-color:dimgray; color: white;" >последние 10 паст:</div>
@foreach (App\Http\Controllers\pasteController::getLastPaste() as $lpasta)
<div class="alert alert-dark" role="alert" style="padding:5px!important; margin: 2px">
   <div style="text-overflow: ellipsis; width:100%; overflow:hidden; white-space: nowrap;"> <b>{{$lpasta->name}}</b></div>

    <div class="row">
        <div class="col-sm " style="font-size:10pt">
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
