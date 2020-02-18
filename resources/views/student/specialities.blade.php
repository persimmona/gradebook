@extends("layout")

@section("title", "Студент — Журнал Оцінок")

@section("content")

<h1 class="data-title">Перелік спеціальностей</h1>
  <div class="spec-container">

    
    @foreach($specialities as $spec => $div)
      <div class="spec-card">
            <h3 class="spec-card__title">{{$spec}}</h3>
            <p class="spec-card__subtitle">{{$div}}</p>
            <div class="spec-card__aside">
              <p class="spec-card__text">Роки: 2017-2021</p>
              <p class="spec-card__text">Курс: 3</p>
            </div>
            <a class="spec-card-link">
              <span class="spec-card-link__text">Перейти
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                  <path class="stroke" fill="#fff" d="M5.88 4.12L13.76 12l-7.88 7.88L8 22l10-10L8 2z"/>
                  <path fill="none" d="M0 0h24v24H0z"/>
                </svg>
              </span>
              <div class="spec-card-link__triangle"></div>
            </a>
          </div>
    @endforeach

   </div>

  
  <script src="./script.js" defer></script>

@endsection