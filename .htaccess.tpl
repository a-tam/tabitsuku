php_value display_errors 1
php_value log_errors 1
php_value error_reporting 2047
php_value error_log 'APP_DIR/application/logs/php_error.log'

RewriteEngine on
RewriteCond $1 !^(index\.php|uploads|documents|user_guide|assets|robots\.txt)
RewriteRule ^(.*)$ /index.php/$1 [L]
