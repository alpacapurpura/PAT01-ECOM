# Usar una imagen base ligera
FROM alpine:latest

# Instalar las dependencias: cron y docker-compose
RUN apk add --no-cache cron docker-compose

# Copiar nuestro script de backup al contenedor
COPY backup.sh /usr/local/bin/backup.sh
RUN chmod +x /usr/local/bin/backup.sh

# Copiar el archivo con la definición del cron job
COPY crontab /etc/crontabs/root

# Crear archivo de log para poder ver la salida del cron
RUN touch /var/log/cron.log

# Comando para iniciar el servicio de cron en primer plano
CMD ["crond", "-f", "-l", "2"]