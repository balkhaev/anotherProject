# anotherProject

## Install

### DB
создаем таблицу токенс, там 2 столбца

- token, VARCHAR, 40 символов
- usedCount, INT

затем указываем в services/db.php данные для входа в базу

### Apache
настраиваем апач, в существующий конфиг добавляем `Alias "/api" "/path/to/another"`, что-то типо

```
Alias /api /var/www/api_tarkov

<Directory /var/www/api_tarkov>
   Options Indexes FollowSymLinks MultiViews ExecCGI
   AllowOverride All
   Order allow,deny
   Allow from all
   Require all granted

   RewriteEngine On
   RewriteBase /api_tarkov/

   RewriteRule ^/index\.php$ - [L,NC]

   RewriteCond %{REQUEST_FILENAME} !-f
   RewriteCond %{REQUEST_FILENAME} !-d
   RewriteRule . index.php [L]
</Directory>
```
