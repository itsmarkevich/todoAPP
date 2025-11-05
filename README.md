# TodoApp

Небольшое приложение задач (To\-do) на Laravel. Простые Blade\-вью и минимальный JS/CSS встроены в проект, отдельной фронтенд\-сборки по умолчанию не требуется.

## Технологии и рекомендации по версиям
- PHP 8.2
- Laravel 12.33.0
- MySQL 8.0.44
- Docker
- GitHub

## Структура проекта (важные файлы/папки)
- `app/Http/Controllers/` \- контроллеры
- `app/Models/Task.php`, `app/Models/User.php`, `app/Models/UserStatus.php` \- модели
- `resources/views/` \- Blade\-шаблоны
- `database/migrations/` \- миграции
- `app/Models/Traits/` \- трейты с локальными scope\-функциями: `HasTaskScopes.php`, `HasUserScopes.php`, `HasUserStatusScopes.php`
- `docker-compose.yml`, `Dockerfile` \- конфигурация для контейнеров
- `resources/css/`, `resources/js/` \- фронтенд\-ассеты

## Основные возможности
- Регистрация и аутентификация пользователей (проверка статуса пользователя через `user_statuses`)  
- Реализованы CRUD\-операции для задач, доступные авторизованным пользователям
- Используются локальные Laravel\-scopes (реализованы в трейтах в `app/Models/Traits`) для удобной фильтрации и переиспользования запросов
- Реализовано безопасное удаление пользователя: аккаунт помечается неактивным через `user_statuses`, данные не удаляются, вход запрещён
- Простая админка в `resources/views/admin`


## Быстрый старт (локально)
1. Клонировать репозиторий:  
   - `git clone https://github.com/itsmarkevich/TodoApp`
2. Установить PHP‑зависимости:  
   - `composer install`
3. Настроить `.env` для MySQL:  
   - `cp .env.example .env`  
   - В `.env` указать `DB_CONNECTION=mysql`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
4. Создать базу данных MySQL.
5. Прогнать миграции:  
   - `php artisan migrate`
6. Запустить всё через Docker (рекомендуется):  
   - `docker-compose up -d --build`

## Примечания 
- БД по умолчанию — MySQL; при смене настроек обновите `config/database.php` и `.env`.
