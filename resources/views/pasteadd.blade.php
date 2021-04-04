@extends('html')
@section('main-title')Создать новую Пасту@endsection


@section('codemirror')
<script src="public/codelib/codemirror.js"></script>
<link rel="stylesheet" href="public/codelib/codemirror.css">

@endsection


@section('content')

    @include('head')

    <div class="container cont1">
        <div class="row"><div class="col-9"><!-- основной блок-->


<br>
<form action="{{ route('pasteadd2')}}" method="post">
    @csrf
    <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroup-sizing-default">Введите имя Пасты</span>
        </div>
        <input type="text" class="form-control" aria-label="" aria-describedby="inputGroup-sizing-default" name="pname" id="pname">
    </div>

    <div class="input-group" id="codebox">
        <script>
            var stype={"php":"application/x-httpd-php","":""};
            var myCodeMirror = CodeMirror($('#codebox').get(0), {lineNumbers: true,
                    name: 'npcode'
            });
            myCodeMirror.on('change',function(){$("#pcode").val(myCodeMirror.getValue());});
            </script>

        <textarea class="form-control" aria-label=""  style="min-height: 200px; display:none" name="pcode" id="pcode" ></textarea>
    </div>
        <br>





      <div class="container">

        <div class="row">
            <div class="col-sm">
                        <label for="inputState" class="form-label">Оформление кода</label>
                        <select id="inputState" class="form-select" name="pcodetype">
                        <option selected value="php">PHP</option>
                        <option value="html">HTML</option>
                        <option value="js">JS</option>
                        <option value="css">CSS</option>
                        <option value="plain">TEXT</option>
                        </select>
           </div>
          <div class="col-sm" id="select_v">
            <label for="select_v" class="form-label">Область видимости</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="pview" id="flexRadioDisabled"  value="1">
                <label class="form-check-label" for="flexRadioDisabled">
                Только по ссылке
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="pview" id="flexRadioCheckedDisabled" checked value="0">
                <label class="form-check-label" for="flexRadioCheckedDisabled"  >
                Публичная паста
                </label>
            </div>


        </div>

            <div class="col-sm">
                <label for="inputState2" class="form-label">Доступна</label>
                <select id="inputState2" class="form-select" name="expiration">
                <option selected value="0">всегда</option>
                <option value="10 minutes">10 минут</option>
                <option value="1 hour">1 Час</option>
                <option value="3 hours">3 Часа</option>
                <option value="1 day">1 День</option>
                <option value="1 week">1 Неделя</option>
                <option value="1 month">1 Месяц</option>
                </select>
             </div>



        </div>
    </div>
    <center><br><br>
        <button type="submit" class="btn btn-info">Создать пасту</button>
    </center><br><br>


</form>


</div>
<div class="col-3"> <!-- боковой блок -->

@include('rblock')
</div>
</div>
</div>



    @include('footer')

@endsection
