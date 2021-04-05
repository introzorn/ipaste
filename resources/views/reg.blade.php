@extends('html')
@section('main-title')О сервисе пасты@endsection

@section('content')

    @include('head')

<div class="abstractcont">
<br><br>
    <div class="tablo" style="width:400px;padding-left:30px; padding-right:30px;" >
        <form action="{{route('reg')}}" method="POST">

            <h4>Регистрация пользователя</h4>

@csrf
                <span >Логин:</span>
                <input type="text" name="user" class="form-control mt-1" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">


                <span  >Пароль:</span>
                <input type="password" name="password" class="form-control mt-1" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">


                <span  >Подтвердить:</span>
                <input type="password" name="password_confirmation" class="form-control mt-1" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">

                <button type="submit" class="btn btn-primary mt-3 " style="width:100%">Зарегистрироваться</button>
<br>



                @error('user')
                <div class="alert alert-danger" style="padding:0 20px 0 20px; margin:5px; ">
                Логин должен быть длиннее 5 символов и состоять из латинских букв и цифр.
                Хотя возможно такой логин существует . но это не точно =)
                </div>
                @enderror
                @error('password')
                <div class="alert alert-danger" style="padding:0 20px 0 20px; margin:5px">
                    Пароль должен быть больше 5 символов
                </div>
                @enderror
                @error('password_confirmation')
                <div class="alert alert-danger" style="padding:0 20px 0 20px; margin:5px">
                    Пароли не совпадают
                </div>
                @enderror
                <br>


        </form>

    </div>

</div>

    @include('footer')

@endsection
