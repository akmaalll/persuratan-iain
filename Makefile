r:
	php artisan migrate:reset
	# php artisan optimize:clear
	php artisan config:cache
	php artisan view:clear
	php artisan route:clear
	php artisan migrate 
	php artisan db:seed

reset:
	php artisan migrate:reset

roll:
	php artisan migrate:rollback