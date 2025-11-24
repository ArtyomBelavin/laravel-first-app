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

            <x-app-layout>
                <div>
                    <span>Сортировка по дате создания:</span>
                    <a href="{{ route('report.index', ['sort' => 'desc', 'status' => $status]) }}">Сначала новые</a>
                    <a href="{{ route('report.index', ['sort' => 'asc', 'status' => $status]) }}">Сначала старые</a>
                </div>

                <div>
                    <p>
                        Фильтрация по статусу заявки
                    <ul>
                        @foreach ($statuses as $status)
                        <li>
                            <a href="{{ route('report.index', [ 'sort' => $sort, 'status' => $status->id]) }}">
                                {{ $status->name ?? "Нет статуса" }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    </p>
                </div>

                <div class="cards-container">
                    @foreach ($reports as $report)
                    <div class="card">
                        <p class="card-created-at">{{ $report->created_at }}</p>
                        <p class="card-number">{{ $report->number }}</p>
                        <p class="card-description">{{ $report->description }}</p>
                        <div class="card-status-container">
                            <p class="card-status">{{ $report->status->name ?? 'Статус не указан' }}</p>
                        </div>
                        <a class="update-btn" href="/reports/{{ $report->id }}/edit">Изменить</a>
                        <form class="form-delete" method="POST" action="{{ route('report.destroy', $report->id) }}">
                            @method('delete')
                            @csrf
                            <input class="delete-btn" type="submit" value="Удалить" />
                        </form>
                    </div>
                    @endforeach
                    {{ $reports->links() }}
                </div>
            </x-app-layout>

        </section>
    </main>
</body>

</html>