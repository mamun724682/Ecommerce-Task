# Please follow the instructions

`Server Requirements:` Php server & CLI version >= 8.1 <br>

- clone this git repository <br>
- copy .env.example to .env <br>
- configure all info in .env <br>
- run command <code>composer install</code> <br>
- run command <code>php artisan key:generate</code> <br>
- run command <code>php artisan migrate</code><br>
- run command <code>php artisan db:seed</code> <br>
- run command <code>php artisan passport:install</code> <br>
- add passport access & grant credentials to .env <br>
- run command <code>php artisan queue:listen</code> to import products <br>

`Api Documentation:` _/request-docs_ <br>
