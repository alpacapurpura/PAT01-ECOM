#!/bin/bash
# ----------------------------------------------------------------
# Script para hacer backup de tu sitio WordPress "andessuyo.com" en Docker
# ----------------------------------------------------------------
set -e # Termina el script si algún comando falla

# --- CONFIGURACIÓN ---
# Carga las variables de entorno de tu archivo .env
# Asegúrate que este script esté en la misma carpeta que tu .env
source .env 

# Directorio en el servidor donde se guardarán los backups
# VERIFICA QUE ESTA RUTA EXISTA Y SEA CORRECTA PARA TU SERVIDOR
BACKUP_DIR="/home/ubuntu/backups/andessuyo"

# Nombre del proyecto de Docker Compose. Por defecto, es el nombre
# de la carpeta que contiene tu docker-compose.yml. AJÚSTALO si es necesario.
PROJECT_NAME="pat01_ecom"

# Nombre del servicio de la base de datos en docker-compose.yml
MYSQL_SERVICE_NAME="mysql"

# Nombre del volumen de Docker que contiene los archivos de WordPress
# Se construye a partir del nombre del proyecto.
WP_FILES_VOLUME="${PROJECT_NAME}_wordpress_data"
# --- FIN DE LA CONFIGURACIÓN ---

# Crea el directorio de backup si no existe
mkdir -p $BACKUP_DIR

# Genera un timestamp para el nombre de los archivos
DATE=$(date +%Y-%m-%d_%H-%M-%S)

echo "✅ Iniciando backup para andessuyo.com..."

# 1. Backup de la Base de Datos
# Usa las credenciales cargadas desde tu archivo .env
echo "  -> Creando backup de la base de datos (wordpress_db)..."
docker-compose exec -T $MYSQL_SERVICE_NAME mysqldump -u$MYSQL_USER -p$MYSQL_PASSWORD $MYSQL_DATABASE | gzip > $BACKUP_DIR/db-backup-$DATE.sql.gz
echo "  -> Backup de la base de datos completado: db-backup-$DATE.sql.gz"

# 2. Backup de los Archivos de WordPress (volumen wordpress_data)
# Esto incluye tu carpeta /uploads y cualquier otro archivo no gestionado por Git.
echo "  -> Creando backup de los archivos..."
docker run --rm -v $WP_FILES_VOLUME:/volume_data -v $BACKUP_DIR:/backup alpine \
  tar czf /backup/wp-files-backup-$DATE.tar.gz -C /volume_data .
echo "  -> Backup de archivos completado: wp-files-backup-$DATE.tar.gz"

# 3. Limpieza de backups antiguos
# Usa el valor de BACKUP_RETENTION_DAYS de tu archivo .env
echo "  -> Eliminando backups de más de $BACKUP_RETENTION_DAYS días..."
find $BACKUP_DIR -name "*.gz" -type f -mtime +$BACKUP_RETENTION_DAYS -delete
echo "  -> Limpieza completada."

echo "✅ Proceso de backup finalizado con éxito."