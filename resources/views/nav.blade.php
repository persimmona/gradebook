<header class="header">
    <div class="header__container">
        <div class="header__left">
            <p class="header__item"><a href="/">{{\Illuminate\Support\Facades\Auth::user()->last_name}}
                    {{\Illuminate\Support\Facades\Auth::user()->first_name}} {{\Illuminate\Support\Facades\Auth::user()->middle_name}}</a></p>
            @if(!empty(auth()->user()->position))
                @if(auth()->user()->position->is_zavkaf)
                    <a class="header__item header__item_link" href="{{route('division.index')}}">Кафедра</a>
                @endif
            @endif
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
            <div class="user-info__name">{{\Illuminate\Support\Facades\Auth::user()->last_name}}
                {{\Illuminate\Support\Facades\Auth::user()->first_name}} {{\Illuminate\Support\Facades\Auth::user()->middle_name}}</div>
            <div class="user-info__date">{{\App\Models\CurrentData::getCurrentWeekNumber()}} тиждень (<? echo date("d.m.Y") ?>)</div>
        </div>
        <div class="hamburger">
            <div class="hamburger__line"></div>
            <div class="hamburger__line"></div>
            <div class="hamburger__line"></div>
        </div>
    </div>
    <div class="mobile-menu">
        @if(!empty(auth()->user()->position))
            @if(auth()->user()->position->is_zavkaf)
                <a class="mobile-menu__item" href="{{route('division.index')}}">Кафедра</a>
            @endif
        @endif
        <a class="mobile-menu__item" href="{{route('logout')}}">Вийти</a>
    </div>
</header>