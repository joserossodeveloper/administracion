# Usa la imagen base de PHP con Apache
FROM php:apache

# Configura el contenedor para montar el directorio de trabajo actual en /var/www/html/
WORKDIR /var/www/html/

# Expone el puerto 9090
EXPOSE 9090

# Comando predeterminado para iniciar el servidor Apache
CMD ["apache2-foreground"]
