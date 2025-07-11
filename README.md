# Task Manager

Это учебный проект — простой менеджер задач, реализованный на чистом PHP с использованием архитектуры MVC. Проект демонстрирует мои навыки разработки веб-приложений, включая работу с объектно-ориентированным программированием, базой данных SQLite, REST API, фронтендом и управлением зависимостями через Composer.

## Используемые технологии и навыки

- **PHP (продвинутое ООП)**: Реализована модульная структура с использованием классов, неймспейсов и автозагрузки по стандарту PSR-4. Применены принципы инкапсуляции и разделения ответственности.
- **Архитектура MVC**: Разделение логики на модели (`app/Models`), контроллеры (`app/Controllers`) и представления (`public/views`).
- **Composer**: Использован для управления автозагрузкой классов (PSR-4) и структурирования проекта.
- **Git**: Проект находится под управлением системы контроля версий для отслеживания изменений и организации кода.
- **SQL (SQLite)**: Реализованы миграции для создания таблицы задач (`database/migrations`) и взаимодействие с базой данных через PDO.
- **REST API**: Разработан API для управления задачами (CRUD-операции) с использованием JSON.
- **Фронтенд**:
    - **Vue.js**: Использован для интерактивных компонентов на страницах (создание, редактирование, просмотр задач).
    - **Bootstrap 5**: Применен для стилизации интерфейса и адаптивной верстки.
    - **JavaScript (ES6)**: Реализована клиентская логика в `public/js/app.js`.
    - **CSS**: Минимальная кастомизация стилей в `public/css/custom.css`.
- **Маршрутизация**: Собственный маршрутизатор (`core/Router.php`) для обработки веб- и API-запросов.
- **Шаблонизатор**: Использованы PHP-шаблоны (`public/views`) с общим layout (`layout.php`) для рендеринга страниц.
- **Безопасность**: Реализована базовая валидация входных данных и экранирование вывода (`htmlspecialchars`).

## Структура проекта

- **`app/`**:
    - `Controllers/`: Контроллеры для веб-интерфейса (`Web/TaskController.php`) и API (`Api/TaskApiController.php`).
    - `Models/`: Модель `Task.php` для работы с задачами в базе данных.
- **`core/`**: Основной маршрутизатор (`Router.php`) для обработки запросов.
- **`database/`**:
    - `Database.php`: Класс для подключения к SQLite через PDO.
    - `database.db`: Файл базы данных SQLite.
    - `migrations/`**: Скрипт миграции для создания таблицы `tasks`.
- **`public/`**:
    - `index.php`: Точка входа приложения.
    - `css/custom.css`: Пользовательские стили (пустой, готов для расширения).
    - `js/app.js`: Клиентская логика с использованием Vue.js.
    - `views/`: Шаблоны для рендеринга страниц:
        - `layout.php`: Основной шаблон с Bootstrap и навигацией.
        - `tasks/`:
            - `create.php`: Форма создания задачи.
            - `edit.php`: Форма редактирования задачи.
            - `index.php`: Список задач с пагинацией.
            - `show.php`: Просмотр одной задачи.
- **`routes/`**:
    - `web.php`: Определение маршрутов для веб-интерфейса и API.
- **`composer.json`**: Настройка автозагрузки и метаданных проекта.

## Основной функционал

- **Веб-интерфейс**:
    - Просмотр списка задач с пагинацией.
    - Создание, редактирование, просмотр и удаление задач.
    - Интерактивные формы с использованием Vue.js и Bootstrap.
- **API**:
    - Получение списка задач (`GET /api/tasks`).
    - Создание задачи (`POST /api/tasks`).
    - Просмотр задачи по ID (`GET /api/tasks/{id}`).
    - Обновление задачи (`PUT /api/tasks/{id}`).
    - Удаление задачи (`DELETE /api/tasks/{id}`).
- **База данных**:
    - Таблица `tasks` с полями: `id`, `title`, `description`, `status`, `created_at`.
    - Миграция для создания таблицы через скрипт в `database/migrations`.

## Установка и запуск

1. **Клонируйте репозиторий**:
   ```bash
   git clone <ссылка_на_репозиторий>
   cd <имя_проекта>
   ```

2. **Установите зависимости**:
   ```bash
   composer install
   ```

3. **Создайте базу данных**:
    - Выполните скрипт миграции из `database/migrations` для создания таблицы `tasks`:
      ```bash
      php database/migrations/create_tasks_table.php
      ```

4. **Настройте веб-сервер**:
    - Укажите корневую директорию на `public/`.
    - Например, для PHP встроенного сервера:
      ```bash
      php -S localhost:8000 -t public
      ```

5. **Откройте приложение**:
    - Веб-интерфейс: `http://localhost:8000/tasks`
    - API: `http://localhost:8000/api/tasks`

## Документация API

См. файл `API_DOCUMENTATION.md` для подробного описания API endpoints.

## Примечания

- Проект создан как учебный, чтобы продемонстрировать навыки работы с PHP, MVC, SQLite, REST API и фронтендом.
- Код следует стандартам PSR-4 и включает базовую обработку ошибок.
- Для улучшения можно добавить авторизацию, более сложную валидацию и тесты.