@extends("layout")

@section("title", "Студент — Журнал Оцінок")

@section("content")

    <h1 class="data-title">5 семестр 2019-2020 навчального року</h1>
    <div class="root__overflow-container">
        <div class="root__data-container">
            <table class="data">
                <tr>
                    <th>Поточні предмети</th>
                    <th>А1</th>
                    <th>А2</th>
                    <th>Підсумки</th>
                </tr>
                <tr>
                    <td>Технології створення програмних продуктів</td>
                    <td>30/30</td>
                    <td>25/30</td>
                    <td>55/60</td>
                </tr>
                <tr>
                    <td>Веб-дизайн та сучасні веб-тихнології</td>
                    <td>30/30</td>
                    <td>25/30</td>
                    <td>55/60</td>
                </tr>
                <tr>
                    <td>Математичні методи дослідження операцій</td>
                    <td>30/30</td>
                    <td>25/30</td>
                    <td>55/60</td>
                </tr>
                <tr>
                    <td>Основи психології</td>
                    <td>30/30</td>
                    <td>25/30</td>
                    <td>55/60</td>
                </tr>
                <tr>
                    <td>Статистичні методи обробки інформації</td>
                    <td>30/30</td>
                    <td>25/30</td>
                    <td>55/60</td>
                </tr>
                <tr>
                    <td>Операційні системи на системне програмування</td>
                    <td>30/30</td>
                    <td>25/30</td>
                    <td>55/60</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="data-tab root__data-tab">
        <div class="data-tab__container">
            <a class="data-tab__item" href="#">
                <svg class="forward-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                    <path fill="#2a2a2a" d="M5.88 4.12L13.76 12l-7.88 7.88L8 22l10-10L8 2z"/>
                    <path fill="none" d="M0 0h24v24H0z"/>
                </svg>
                4 семестр 2018-2019 навчального року
            </a>
            <a class="data-tab__item" href="#">
                <svg class="forward-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                    <path fill="#2a2a2a" d="M5.88 4.12L13.76 12l-7.88 7.88L8 22l10-10L8 2z"/>
                    <path fill="none" d="M0 0h24v24H0z"/>
                </svg>
                3 семестр 2018-2019 навчального року
            </a>
            <a class="data-tab__item" href="#">
                <svg class="forward-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                    <path fill="#2a2a2a" d="M5.88 4.12L13.76 12l-7.88 7.88L8 22l10-10L8 2z"/>
                    <path fill="none" d="M0 0h24v24H0z"/>
                </svg>
                2 семестр 2017-2018 навчального року
            </a>
            <a class="data-tab__item" href="#">
                <svg class="forward-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                    <path fill="#2a2a2a" d="M5.88 4.12L13.76 12l-7.88 7.88L8 22l10-10L8 2z"/>
                    <path fill="none" d="M0 0h24v24H0z"/>
                </svg>
                1 семестр 2017-2018 навчального року
            </a>
        </div>
    </div>

    <footer class="footer"></footer>

    <script src="./script.js" defer></script>
@endsection