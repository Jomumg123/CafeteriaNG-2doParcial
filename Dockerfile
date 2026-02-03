# Usamos una imagen oficial de PHP con Apache 
FROM php:8.2-apache

# Instalamos extensiones necesarias para MySQL [cite: 20]
RUN docker-php-ext-install pdo pdo_mysql

# Habilitamos el módulo rewrite de Apache para las rutas [cite: 19]
RUN a2enmod rewrite

# Copiamos los archivos del proyecto al servidor [cite: 49]
COPY . /var/www/html/

# Ajustamos los permisos para que Apache pueda leer los archivos
RUN chown -R www-data:www-data /var/www/html/

# Configuramos el DocumentRoot a la carpeta public [cite: 35]
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Exponemos el puerto 80
EXPOSE 80