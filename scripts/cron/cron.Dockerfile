# Usar una imagen base ligera
FROM alpine:latest

# Instalar las dependencias: dcron, docker CLI y curl
RUN apk add --no-cache dcron docker-cli curl



# Copiar nuestro script de backup al contenedor
COPY scripts/maintenance/backup.sh /usr/local/bin/backup.sh
RUN chmod +x /usr/local/bin/backup.sh

# Copiar el archivo con la definición del cron job
COPY scripts/cron/crontab /etc/crontabs/root

# Establecer permisos correctos para el archivo crontab
RUN chmod 600 /etc/crontabs/root

# Crear archivo de log para poder ver la salida del cron
RUN touch /var/log/cron.log

# Comando para iniciar el servicio de cron en primer plano
# Usar -f para foreground, -d 8 para debug level, -L /var/log/cron.log para logging
CMD ["crond", "-f", "-d", "8", "-L", "/var/log/cron.log"]