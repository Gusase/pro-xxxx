### pro-roso
___
```
git clone https://github.com/iannn4u/pro-roso.git
```
```
cd pro-roso
```
```
npm i
```
```
composer install
```
```
cp .env.example .env
```
```
php artisan key:generate
```
```
php artisan migrate --seed
```
```
php artisan db:seed --class=UserSeeder
```
```
php artisan storage:link
```
```
php artisan optimize:clear
```
```
php artisan view:clear
```
```
php artisan serve
```
```
npm run dev
```
[localhost](http://127.0.0.1:8000)
---