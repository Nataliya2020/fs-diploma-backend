# Дипломная работа

## Серверная часть

Для написания использовались  php 8.1, laravel/framework ^10.0, laravel/sanctum ^3.2

После клонирования репозитория с помощью команды "npm install" необходимо установить зависимости. Затем, для подключения
необходимых библиотек, необходимо выполнить команду "composer install".

В коде серверной части находятся несколько миграций. В них создаются 4 таблицы по умолчанию, установленные вместе с 
фреймворком Ларавел, из них используется 2:

* пользователей с обязательными полями "name", "email", "password" для хранения данных зарегистрированных пользователей.
* По умолчанию хранится пользователь с "name" - "admin", "email" - "testAdmin@testAdmin.test",
* "password" - захешированный пароль "123456789".


* токенов пользователей.

6 таблиц, созданных для проекта:

* Залы. В них хранятся имя зала, количество рядов, количество мест в рядах, общее количество мест в зале,
* заблокированные места, в которых нет кресел, цены на стандартные и вип места, признак видимости зала, он 
* необходим для взаимодействия с кнопкой "Открыть продажу билетов".


* Фильмы. Название фильма, описание фильма, длительность, изображение, страна-производитель фильма. Все эти данные 
* поступают от админа при заполнении формы добавления фильма.


* Сеансы. Хранятся id-залов, id-фильмов, время начала сеанса, дата, номера купленных на сеанс мест.


* Места в зале. id-зала, номер места, вип или стандартное место.


* Билеты. Содержат поля название фильма, название зала, время начала сеанса, общей суммы забронированных билетов, 
* дата сеанса.


* Места для отображения в билете. id-билета, номер ряда, номера мест в ряду.


и 4 миграции для внесения в базу трех фильмов, трех залов, трех сеансов и вип мест по умолчанию.

Для создания базы на основе миграций необходимо запустить миграции с помощью команды php artisan migrate и согласиться
с предложенными системой вопросами.

Далее необходимо настроить окружение, создав файл ".env", в нем сгенерировать ключ с помощью команды 
"php artisan key:generate", прописать абсолютный путь к базе данных, для соединения с базой sqlite в строке 
"DB_CONNECTION" прописать "sqlite", в APP_URL прописать нужный порт,
он понадобится для сохранения изображений фильмов, загружаемых пользователем. Для возможности работы с изображениями
необходимо сформировать символическую ссылку с public/storage на storage/app/public с помощью команды 
php artisan storage:link. 
Два изображения сохранены в папке public/img для создания фильмов по умолчанию при запуске миграций. Эти изображения
не удаляются при удалении фильма пользователем.

Чтобы подключить базу данных, можно нажать на значок "плюс" во вкладке "Database", выбрать "Data Source/database driver"
и
в открывшемся окне выбрать путь до базы данных или двойным щелчком по файлу "database.sqlite" вызвать окно выбора пути
базы данных, он будет заполнен автоматически, затем нажать кнопку "ОК".

Командой "php artisan serve" запускается серверная часть.
