@extends('html')
@section('main-title')О сервисе пасты@endsection

@section('content')

    @include('head')

<div class="abstractcont">
<br><br>
    <div class="tablo" style="width:400px;padding-left:30px; padding-right:30px;" >
        <form action="{{route('login')}}" method="POST">

            <h4> Авторизация пользователя</h4>

@csrf
                <span >Логин:</span>
                <input type="text" name="user" class="form-control mt-1" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">


                <span  >Пароль:</span>
                <input type="password" name="password" class="form-control mt-1" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">



                <button type="submit" class="btn btn-primary mt-3 " style="width:100%">Войти</button>
<br>
                @if(count( $errors ) > 0)
                <div class="alert alert-danger" style="padding:0 20px 0 20px; margin:5px; ">

                    @foreach ($errors->all() as $error)
                    <b> {{ $error }}</b><br>
                   @endforeach

                Неверный логин или пароль
                </div>
                @endif

                <br>


        </form>

    </div>

</div>

    @include('footer')

@endsection
