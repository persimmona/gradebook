@extends('auth.layout')

@section('title','Зареєструватися — Журнал Оцінок')

@section('content')
    <form class="login-form" role="form" method="post" action="{{ url('/register') }}">
        {!! csrf_field() !!}
        <div class="login-form__body">
            <h1 class="login-form__title">Зареєструватися</h1>
            <div class="float-label login-form__float-label">
                <input class="float-label__input" type="text" name="fullname" id="fullname" value="{{ old('fullname') }}" required>
                <label class="float-label__placeholder" for="fullname">Логін</label>
                @error('fullname')
                {{ $message }}
                @enderror
            </div>

            <div class="float-label login-form__float-label">
                <input class="float-label__input" type="password" name="password" id="password" value="{{ old('password') }}" required>
                <label class="float-label__placeholder" for="password">Пароль</label>
                @error('password')
                {{ $message }}
                @enderror
            </div>

            <div class="float-label login-form__float-label">
                <input class="float-label__input" type="text" name="code" id="code" value="{{ old('code') }}" required>
                <label class="float-label__placeholder" for="code">Код Реєстрації</label>
                @error('code')
                {{ $message }}
                @enderror
            </div>

            <div class="radio-field"> 
                <label class="radio-btn">
                    <input class="radio-btn__input" type="radio" name="role" value="Student" checked>
                    <span class="radio-btn__box"></span>
                    <span class="radio-btn__label">Студент</span>
                </label>
                <label class="radio-btn">
                    <input class="radio-btn__input" type="radio" name="role" value="Teacher">
                    <span class="radio-btn__box"></span>
                    <span class="radio-btn__label">Викладач</span>
                </label>
            </div>

            <button class="login-form__submit" type="submit">Увійти</button>
        </div>

        <div class="curtain">
            <p class="curtain__title">Журнал Оцінок</p>
        </div>
    </form>

@endsection