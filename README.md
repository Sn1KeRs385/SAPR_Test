Установка
    <br>
1) docker-compose up -d (поднимутся контейнеры с базой и редисом)
   <br>
2) cd www/api
   <br>
3) composer install
   <br>
4) php artisan migrate
   <br>
5) php artisan key:generate
   <br>
6) php artisan passport:install
   <br>
7) php artisan serve --port 8000 (времени было мало, на фронте захардкодил localhost:8000)
   <br>
8) cd ../site
   <br>
9) npm install
   <br>
10) npm run serve
    <br>
11) Заходим на http://localhost:{порт} (порт показывается после команды npm run serve)
    <br>