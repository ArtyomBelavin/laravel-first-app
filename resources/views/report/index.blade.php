<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Все заявки</title>
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
        <section class="reports">
            <a href="/reports/create" class="create-btn">Создать заявление</a>

            <div class="cards-container">
                @foreach ($reports as $report)
                <div class="card">
                    <p class="card-created-at">{{ $report->created_at }}</p>
                    <p class="card-number">{{ $report->number }}</p>
                    <p class="card-description">{{ $report->description }}</p>
                    <div class="card-status-container">
                        @if ($report-> status_id == 1)
                        <p class="card-status">Статус заявления - <span class="status-new">новое</span></p>
                        @endif

                        @if ($report-> status_id == 2)
                        <p class="card-status">Статус заявления - <span class="status-rejected">отклоненно</span></p>
                        @endif

                        @if ($report-> status_id == 3)
                        <p class="card-status">Статус заявления - <span class="status-success">подтвержденно</span></p>
                        @endif
                    </div>
                    <a class="update-btn" href="/reports/{{ $report->id }}/edit">Изменить</a>
                    <form class="form-delete" method="POST" action="{{ route('report.destroy', $report->id) }}">
                        @method('delete')
                        @csrf
                        <input class="delete-btn" type="submit" value="Удалить" />
                    </form>
                </div>
                @endforeach
            </div>
        </section>
    </main>
</body>

</html>