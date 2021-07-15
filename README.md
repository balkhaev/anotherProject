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
<VirtualHost *:80>
  DocumentRoot /var/www/html/build

  <Directory /var/www/html/>
    Options Indexes FollowSymLinks
    AllowOverride All
    Require all granted
  </Directory>

  Alias "/api" "/var/www/html/api"

  ErrorLog ${APACHE_LOG_DIR}/error.log
  CustomLog ${APACHE_LOG_DIR}/access.log combined

  <IfModule mod_dir.c>
    DirectoryIndex index.php index.pl index.cgi index.html index.xhtml index.htm
  </IfModule>
</VirtualHost>
```
