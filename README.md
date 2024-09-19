# Laravel Project

## clone project
```
git@github.com:hx71/bpfk-spt.git
```

## setup database
```rename example.env to .env```

## setup project
``` 
composer install

php artisan key:generate
```

## run migration
```
php artisan migate
or
php artisan migate:fresh --seed

```
 
## run project
```
php artisan serve
```