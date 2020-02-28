<header class="header">
    <div class="header__container">
        <div class="header__left">
            <p class="header__item"><a href="{{route('speciality')}}">{{\Illuminate\Support\Facades\Auth::guard('student')->user()->last_name}}
                    {{\Illuminate\Support\Facades\Auth::guard('student')->user()->first_name}}</a></p>
            <a class="header__item header__item_link" href="/">Переглянути профіль</a>
        </div>
        <div class="header__right">
            <p class="header__item">{{\App\Models\CurrentData::getCurrentWeekNumber()}} тиждень (<? echo date("d.m.Y") ?>)</p>
            <a class="header__item header__item_button" href="{{route('logout')}}">Вийти</a>
        </div>
    </div>
</header>

<header class="header-mobile">
    <div class="header-mobile__top">
        <div class="user-info">
            <div class="user-info__name">{{\Illuminate\Support\Facades\Auth::guard('student')->user()->last_name}}
                {{\Illuminate\Support\Facades\Auth::guard('student')->user()->first_name}}</div>
            <div class="user-info__date">{{\App\Models\CurrentData::getCurrentWeekNumber()}} тиждень (<? echo date("d.m.Y") ?>)</div>
        </div>
        <div class="hamburger">
            <div class="hamburger__line"></div>
            <div class="hamburger__line"></div>
            <div class="hamburger__line"></div>
        </div>
    </div>
    <div class="mobile-menu">
        <a class="mobile-menu__item" href="/">Переглянути профіль</a>
        <a class="mobile-menu__item" href="{{route('logout')}}">Вийти</a>
    </div>
</header>