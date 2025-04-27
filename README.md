В терминале:
1. composer install
2. php bin/console importmap:install
3. bin/console doctrine:migrations:migrate
4. symfony serve

Route:
- http://localhost:8000/register - регистрация
- http://localhost:8000/users - все пользователи
- http://localhost:8000/user/{userID}/show - просмотр данных конкретного пользователя
- http://localhost:8000/user/{userID}/edit - изменение данных конкретного пользователя

Тесты:
1. php bin/console doctrine:fixtures:load - загрузить фикстуры в бд.
2. php bin/phpunit - запуск тестов.
3. bin/console app:score - консольная команда. Без опций показывает общий скоринг. С опцией - скоринг одного пользователя (пример: bin/console app:score --userID 5). При запуске обновляет скоринг, делая его актуальным.


Доп. информация:
- Реализована корректная валидация в форме регистрации для каждого input.
- По умолчанию бд на localhost. Логин-root, без пароля. Имя базы - sveak.

