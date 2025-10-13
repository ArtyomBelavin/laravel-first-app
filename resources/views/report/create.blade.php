<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создать репорт</title>
    @vite(['resources/css/reset.css'])
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite(['resources/css/reports.css'])
</head>

<body>
    <header class="header">
        <nav class="header-nav">
            <ul class="nav-list">
                <li class="list-item">
                    <a href="/reports" class="item-link">Нарушений<span>.нет</span></a>
                </li>
            </ul>
        </nav>
        <div class="login-logout">
            <select name="" id="">
                <option value="Выйти">Выйти</option>
            </select>
        </div>
    </header>
    <main class="main">
        <div class="containter">
            <form class="create-form" method="POST" action="{{ route('report.store') }}">
                @csrf
                <input name="number" class="create-form__input" type="text" placeholder="регистрационный номер авто">
                <textarea name="description" class="create-form__textarea" placeholder="описание нарушения"></textarea>
                <button class="create-btn" type="submit">Создать</button>
            </form>
        </div>

    </main>


</body>

</html>