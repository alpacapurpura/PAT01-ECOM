# Configuración Docker Compose - WordPress

## 1. Estructura del Proyecto

```
wordpress-docker/
├── .env                          # Variables de entorno
├── .env.example                  # Plantilla de variables
├── docker-compose.yml            # Configuración desarrollo
├── docker-compose.prod.yml       # Configuración producción
├── setup.bat                     # Script setup Windows
├── setup.sh                      # Script setup Linux/Mac
├── backup.bat                    # Script backup Windows
├── backup.sh                     # Script backup Linux/Mac
├── wordpress/
│   ├── themes/                   # Temas personalizados
│   ├── plugins/                  # Plugins personalizados
│   └── wp-config-docker.php      # Config WordPress para Docker
├── mysql/
│   ├── data/                     # Datos MySQL (auto-generado)
│   └── init/
│       └── 01-init.sql           # Configuración inicial DB
├── backups/                      # Backups automáticos
│   ├── mysql/                    # Backups base de datos
│   └── wordpress/                # Backups archivos WordPress
└── logs/                         # Logs de aplicación
    ├── wordpress/
    └── mysql/
```

## 2. Docker Compose - Desarrollo

### 2.1 docker-compose.yml (Acceso Directo)

```yaml
version: '3.8'

services:
  # MySQL Database
  mysql:
    image: mysql:8.0
    container_name: wp_mysql
    restart: unless-stopped
    environment:
      MYSQL_ROOT_PASSWORD: ${MYSQL_ROOT_PASSWORD}
      MYSQL_DATABASE: ${MYSQL_DATABASE}
      MYSQL_USER: ${MYSQL_USER}
      MYSQL_PASSWORD: ${MYSQL_PASSWORD}
    volumes:
      - mysql_data:/var/lib/mysql
      - ./mysql/init:/docker-entrypoint-initdb.d
    networks:
      - wordpress_network
    healthcheck:
      test: ["CMD", "mysqladmin", "ping", "-h", "localhost"]
      timeout: 20s
      retries: 10
    command: >
      --character-set-server=utf8mb4
      --collation-server=utf8mb4_unicode_ci
      --innodb-buffer-pool-size=256M
      --max-connections=100

  # WordPress Application
  wordpress:
    image: wordpress:latest
    container_name: wp_app
    restart: unless-stopped
    depends_on:
      mysql:
        condition: service_healthy
    ports:
      - "${WORDPRESS_PORT:-8080}:80"
    environment:
      # Database Configuration
      WORDPRESS_DB_HOST: mysql:3306
      WORDPRESS_DB_NAME: ${MYSQL_DATABASE}
      WORDPRESS_DB_USER: ${MYSQL_USER}
      WORDPRESS_DB_PASSWORD: ${MYSQL_PASSWORD}
      
      # WordPress Configuration
      WORDPRESS_TABLE_PREFIX: ${WP_TABLE_PREFIX:-wp_}
      WORDPRESS_DEBUG: ${WP_DEBUG:-false}
      
      # WordPress Configuration
      WORDPRESS_CONFIG_EXTRA: |
        // WordPress URLs
        define('WP_HOME', 'http://localhost:${WORDPRESS_PORT:-8080}');
        define('WP_SITEURL', 'http://localhost:${WORDPRESS_PORT:-8080}');
        
        // Memory and execution limits for WooCommerce
        ini_set('memory_limit', '${PHP_MEMORY_LIMIT:-256M}');
        ini_set('max_execution_time', '${PHP_MAX_EXECUTION_TIME:-300}');
        ini_set('max_input_vars', '${PHP_MAX_INPUT_VARS:-3000}');
        
        // WordPress Debugging
        define('WP_DEBUG', ${WP_DEBUG:-false});
        define('WP_DEBUG_LOG', ${WP_DEBUG_LOG:-false});
        define('WP_DEBUG_DISPLAY', ${WP_DEBUG_DISPLAY:-false});
    volumes:
      - wordpress_data:/var/www/html
      - ./wordpress/themes:/var/www/html/wp-content/themes
      - ./wordpress/plugins:/var/www/html/wp-content/plugins
      - ./wordpress/uploads:/var/www/html/wp-content/uploads
    networks:
      - wordpress_network
    healthcheck:
      test: ["CMD", "curl", "-f", "http://localhost:80/wp-admin/install.php"]
      interval: 30s
      timeout: 10s
      retries: 5

  # phpMyAdmin (Development Only)
  phpmyadmin:
    image: phpmyadmin:latest
    container_name: wp_phpmyadmin
    restart: unless-stopped
    depends_on:
      mysql:
        condition: service_healthy
    ports:
      - "${PHPMYADMIN_PORT:-8081}:80"
    environment:
      PMA_HOST: mysql
      PMA_PORT: 3306
      PMA_USER: ${MYSQL_USER}
      PMA_PASSWORD: ${MYSQL_PASSWORD}
      UPLOAD_LIMIT: 100M
    networks:
      - wordpress_network
    profiles:
      - development

volumes:
  mysql_data:
    driver: local
  wordpress_data:
    driver: local

networks:
  wordpress_network:
    driver: bridge
```

### Características Clave de esta Configuración:

1. **Acceso Directo**: WordPress accesible directamente en puerto 8080
2. **Configuración Simplificada**: Sin configuraciones complejas de red
3. **Desarrollo Optimizado**: Bind mounts para edición en tiempo real
4. **Health Checks**: Monitoreo de salud de servicios
5. **Perfiles de Desarrollo**: phpMyAdmin solo en desarrollo
6. **Configuración Flexible**: Variables de entorno para diferentes ambientes

## 3. Variables de Entorno

### 3.1 Archivo .env (Desarrollo)

```bash
# =============================================================================
# CONFIGURACIÓN WORDPRESS DOCKER - DESARROLLO
# =============================================================================

# -----------------------------------------------------------------------------
# CONFIGURACIÓN MYSQL
# -----------------------------------------------------------------------------
MYSQL_ROOT_PASSWORD=root_password_secure_2024
MYSQL_DATABASE=wordpress_db
MYSQL_USER=wp_user
MYSQL_PASSWORD=wp_password_secure_2024

# -----------------------------------------------------------------------------
# CONFIGURACIÓN WORDPRESS
# -----------------------------------------------------------------------------
WP_TABLE_PREFIX=wp_
WP_DEBUG=true
WP_DEBUG_LOG=true
WP_DEBUG_DISPLAY=false

# -----------------------------------------------------------------------------
# PUERTOS DE ACCESO
# -----------------------------------------------------------------------------
WORDPRESS_PORT=8080
PHPMYADMIN_PORT=8081

# -----------------------------------------------------------------------------
# CONFIGURACIÓN BACKUP
# -----------------------------------------------------------------------------
BACKUP_SCHEDULE=0 2 * * *
BACKUP_RETENTION_DAYS=30
BACKUP_COMPRESS=true

# -----------------------------------------------------------------------------
# CONFIGURACIÓN WOOCOMMERCE
# -----------------------------------------------------------------------------
PHP_MEMORY_LIMIT=256M
PHP_MAX_EXECUTION_TIME=300
PHP_MAX_INPUT_VARS=3000

# -----------------------------------------------------------------------------
# CONFIGURACIÓN PROYECTO
# -----------------------------------------------------------------------------
COMPOSE_PROJECT_NAME=pat01-ecom
```

### 3.2 Archivo .env.example

```bash
# =============================================================================
# PLANTILLA DE CONFIGURACIÓN WORDPRESS DOCKER
# Copia este archivo como .env y modifica los valores según tu entorno
# =============================================================================

# -----------------------------------------------------------------------------
# CONFIGURACIÓN MYSQL
# -----------------------------------------------------------------------------
MYSQL_ROOT_PASSWORD=tu_password_root_seguro
MYSQL_DATABASE=wordpress_db
MYSQL_USER=wp_user
MYSQL_PASSWORD=tu_password_wp_seguro

# -----------------------------------------------------------------------------
# CONFIGURACIÓN WORDPRESS
# -----------------------------------------------------------------------------
WP_TABLE_PREFIX=wp_
WP_DEBUG=false
WP_DEBUG_LOG=false
WP_DEBUG_DISPLAY=false

# -----------------------------------------------------------------------------
# PUERTOS DE ACCESO
# -----------------------------------------------------------------------------
WORDPRESS_PORT=8080
PHPMYADMIN_PORT=8081

# -----------------------------------------------------------------------------
# CONFIGURACIÓN BACKUP
# -----------------------------------------------------------------------------
BACKUP_SCHEDULE=0 2 * * *
BACKUP_RETENTION_DAYS=30
BACKUP_COMPRESS=true

# -----------------------------------------------------------------------------
# CONFIGURACIÓN WOOCOMMERCE
# -----------------------------------------------------------------------------
PHP_MEMORY_LIMIT=256M
PHP_MAX_EXECUTION_TIME=300
PHP_MAX_INPUT_VARS=3000

# -----------------------------------------------------------------------------
# CONFIGURACIÓN PROYECTO
# -----------------------------------------------------------------------------
COMPOSE_PROJECT_NAME=pat01-ecom
```

## 4. Archivo docker-compose.prod.yml (Producción)

```yaml
version: '3.8'

services:
  mysql:
    image: mysql:8.0
    restart: always
    environment:
      MYSQL_ROOT_PASSWORD_FILE: /run/secrets/mysql_root_password
      MYSQL_DATABASE: ${MYSQL_DATABASE}
      MYSQL_USER: ${MYSQL_USER}
      MYSQL_PASSWORD_FILE: /run/secrets/mysql_password
    volumes:
      - mysql_data:/var/lib/mysql
      - ./mysql/init:/docker-entrypoint-initdb.d:ro
    networks:
      - wordpress_network
    secrets:
      - mysql_root_password
      - mysql_password
    command: >
      --default-authentication-plugin=mysql_native_password
      --character-set-server=utf8mb4
      --collation-server=utf8mb4_unicode_ci
      --innodb-buffer-pool-size=1G
      --max-connections=200
      --innodb-log-file-size=256M
      --innodb-flush-log-at-trx-commit=2
    deploy:
      resources:
        limits:
          memory: 2G
          cpus: '1.0'
        reservations:
          memory: 1G

  wordpress:
    image: wordpress:latest
    restart: always
    depends_on:
      - mysql
    ports:
      - "${WORDPRESS_PORT:-80}:80"
    environment:
      WORDPRESS_DB_HOST: mysql:3306
      WORDPRESS_DB_NAME: ${MYSQL_DATABASE}
      WORDPRESS_DB_USER: ${MYSQL_USER}
      WORDPRESS_DB_PASSWORD_FILE: /run/secrets/mysql_password
      WORDPRESS_TABLE_PREFIX: ${WP_TABLE_PREFIX:-wp_}
      WORDPRESS_DEBUG: 0
      
      # Configuración de WordPress para Producción
      WORDPRESS_CONFIG_EXTRA: |
        // WordPress URLs para Producción
        define('WP_HOME', '${WORDPRESS_URL}');
        define('WP_SITEURL', '${WORDPRESS_URL}');
        
        // Configuración de seguridad
        define('DISALLOW_FILE_EDIT', true);
        define('AUTOMATIC_UPDATER_DISABLED', true);
        define('WP_AUTO_UPDATE_CORE', false);
        
        // Configuración de memoria y rendimiento
        define('WP_MEMORY_LIMIT', '512M');
        define('WP_MAX_MEMORY_LIMIT', '1024M');
        define('WP_POST_REVISIONS', 3);
        define('AUTOSAVE_INTERVAL', 300);
        define('WP_CRON_LOCK_TIMEOUT', 60);
        
        // Configuración para WooCommerce
        define('WC_LOG_HANDLER', 'WC_Log_Handler_File');
        ini_set('max_execution_time', 300);
        ini_set('max_input_vars', 3000);
        
        // Configuración de cache
        define('WP_CACHE', true);
        define('COMPRESS_CSS', true);
        define('COMPRESS_SCRIPTS', true);
    volumes:
      # Named volumes para producción (más seguro)
      - wordpress_themes:/var/www/html/wp-content/themes
      - wordpress_plugins:/var/www/html/wp-content/plugins
      - wordpress_uploads:/var/www/html/wp-content/uploads
      - wordpress_core:/var/www/html
    networks:
      - wordpress_network
    secrets:
      - mysql_password
    deploy:
      resources:
        limits:
          memory: 1G
          cpus: '0.5'
        reservations:
          memory: 512M

secrets:
  mysql_root_password:
    file: ./secrets/mysql_root_password.txt
  mysql_password:
    file: ./secrets/mysql_password.txt

volumes:
  mysql_data:
    driver: local
  wordpress_core:
    driver: local
  wordpress_themes:
    driver: local
  wordpress_plugins:
    driver: local
  wordpress_uploads:
    driver: local

networks:
  wordpress_network:
    driver: bridge
```

## 5. Scripts de Configuración Cross-Platform

### 5.1 setup.bat (Windows)

```batch
@echo off
echo Configurando WordPress Docker Environment...

:: Crear directorios necesarios
if not exist "wordpress\themes" mkdir wordpress\themes
if not exist "wordpress\plugins" mkdir wordpress\plugins
if not exist "wordpress\uploads" mkdir wordpress\uploads
if not exist "mysql\init" mkdir mysql\init
if not exist "secrets" mkdir secrets
if not exist "backups" mkdir backups

:: Copiar archivo de entorno si no existe
if not exist ".env" (
    copy ".env.example" ".env"
    echo Archivo .env creado. Por favor, configura las variables necesarias.
)

:: Generar secretos si no existen
if not exist "secrets\mysql_root_password.txt" (
    echo %RANDOM%%RANDOM%%RANDOM% > secrets\mysql_root_password.txt
    echo Contraseña root de MySQL generada.
)

if not exist "secrets\mysql_password.txt" (
    echo %RANDOM%%RANDOM%%RANDOM% > secrets\mysql_password.txt
    echo Contraseña de usuario MySQL generada.
)

:: Configurar permisos de archivos
attrib +R secrets\*.txt

echo.
echo Configuración completada!
echo.
echo Próximos pasos:
echo 1. Edita el archivo .env con tus configuraciones
echo 2. Ejecuta: docker-compose up -d
echo 3. Accede a WordPress en http://localhost:8080
echo.
pause
```

### 5.2 setup.sh (Linux/Mac)

```bash
#!/bin/bash

echo "Configurando WordPress Docker Environment..."

# Crear directorios necesarios
mkdir -p wordpress/{themes,plugins,uploads}
mkdir -p mysql/init
mkdir -p secrets
mkdir -p backups

# Copiar archivo de entorno si no existe
if [ ! -f ".env" ]; then
    cp ".env.example" ".env"
    echo "Archivo .env creado. Por favor, configura las variables necesarias."
fi

# Generar secretos si no existen
if [ ! -f "secrets/mysql_root_password.txt" ]; then
    openssl rand -base64 32 > secrets/mysql_root_password.txt
    echo "Contraseña root de MySQL generada."
fi

if [ ! -f "secrets/mysql_password.txt" ]; then
    openssl rand -base64 32 > secrets/mysql_password.txt
    echo "Contraseña de usuario MySQL generada."
fi

# Configurar permisos de archivos
chmod 600 secrets/*.txt
chmod +x setup.sh

echo ""
echo "Configuración completada!"
echo ""
echo "Próximos pasos:"
echo "1. Edita el archivo .env con tus configuraciones"
echo "2. Ejecuta: docker-compose up -d"
echo "3. Accede a WordPress en http://localhost:8080"
echo ""
```

## 6. Instrucciones de Instalación

### 6.1 Instalación Inicial

1. **Clonar o descargar el proyecto**
2. **Ejecutar script de configuración**:
   - Windows: `setup.bat`
   - Linux/Mac: `./setup.sh`
3. **Editar archivo .env** con tus configuraciones específicas
4. **Iniciar servicios**: `docker-compose up -d`

### 6.2 Acceso a Servicios

- **WordPress**: http://localhost:8080
- **phpMyAdmin**: http://localhost:8081

### 6.3 Comandos Útiles de Docker

```bash
# Ver logs de todos los servicios
docker-compose logs -f

# Ver logs de un servicio específico
docker-compose logs -f wordpress
docker-compose logs -f mysql

# Reiniciar servicios
docker-compose restart

# Detener servicios
docker-compose down

# Detener y eliminar volúmenes (¡CUIDADO!)
docker-compose down -v

# Actualizar imágenes
docker-compose pull
docker-compose up -d

# Acceder al contenedor de WordPress
docker-compose exec wordpress bash

# Acceder al contenedor de MySQL
docker-compose exec mysql mysql -u root -p

# Backup de base de datos
docker-compose exec mysql mysqldump -u root -p${MYSQL_ROOT_PASSWORD} ${MYSQL_DATABASE} > backup.sql

# Restaurar base de datos
docker-compose exec -T mysql mysql -u root -p${MYSQL_ROOT_PASSWORD} ${MYSQL_DATABASE} < backup.sql
```

## 7. Configuración de Producción

### 7.1 Consideraciones de Seguridad

- **Secretos de Docker**: Usar Docker secrets para contraseñas
- **Variables de entorno**: No incluir credenciales en archivos de configuración
- **SSL/TLS**: Configurar certificados si es necesario
- **Firewall**: Restringir acceso a puertos según necesidades
- **Actualizaciones**: Mantener imágenes actualizadas

### 7.2 Optimizaciones de Rendimiento

- **Recursos de contenedor**: Limitar CPU y memoria
- **Cache de WordPress**: Configurar plugins de cache
- **Base de datos**: Optimizar configuración de MySQL
- **Volúmenes**: Usar volúmenes nombrados para mejor rendimiento

## 8. Troubleshooting

### 8.1 Problemas Comunes

**WordPress no accesible:**
- Verificar que el puerto 8080 esté disponible
- Comprobar que los servicios estén ejecutándose: `docker-compose ps`
- Revisar logs: `docker-compose logs wordpress`

**Error de conexión a base de datos:**
- Verificar variables de entorno de MySQL
- Comprobar que MySQL esté saludable: `docker-compose ps`
- Revisar logs: `docker-compose logs mysql`

**phpMyAdmin no accesible:**
- Verificar que el puerto 8081 esté disponible
- Comprobar variables de entorno PMA_HOST
- Revisar logs: `docker-compose logs phpmyadmin`

### 8.2 Comandos de Diagnóstico

```bash
# Verificar estado de servicios
docker-compose ps

# Verificar logs de todos los servicios
docker-compose logs

# Verificar redes de Docker
docker network ls

# Verificar configuración
docker-compose config

# Probar conectividad interna
docker-compose exec wordpress curl -I http://localhost:80
```

## 9. Backup y Restauración

### 9.1 Backup Automatizado

```bash
#!/bin/bash
# backup.sh

DATE=$(date +%Y%m%d_%H%M%S)
BACKUP_DIR="./backups"

# Crear directorio de backup
mkdir -p $BACKUP_DIR

# Backup de base de datos
docker-compose exec -T mysql mysqldump -u root -p$MYSQL_ROOT_PASSWORD $MYSQL_DATABASE > $BACKUP_DIR/db_$DATE.sql

# Backup de archivos de WordPress
docker-compose exec -T wordpress tar czf - /var/www/html/wp-content > $BACKUP_DIR/wp-content_$DATE.tar.gz

echo "Backup completado: $DATE"
```

### 9.2 Restauración

```bash
#!/bin/bash
# restore.sh

if [ -z "$1" ]; then
    echo "Uso: ./restore.sh FECHA (ej: 20231201_143000)"
    exit 1
fi

DATE=$1
BACKUP_DIR="./backups"

# Restaurar base de datos
if [ -f "$BACKUP_DIR/db_$DATE.sql" ]; then
    docker-compose exec -T mysql mysql -u root -p$MYSQL_ROOT_PASSWORD $MYSQL_DATABASE < $BACKUP_DIR/db_$DATE.sql
    echo "Base de datos restaurada"
fi

# Restaurar archivos de WordPress
if [ -f "$BACKUP_DIR/wp-content_$DATE.tar.gz" ]; then
    docker-compose exec -T wordpress tar xzf - -C / < $BACKUP_DIR/wp-content_$DATE.tar.gz
    echo "Archivos de WordPress restaurados"
fi
```

Esta configuración proporciona una solución completa y simplificada de WordPress con Docker, optimizada para desarrollo local y preparada para producción con acceso directo sin necesidad de configuraciones complejas de proxy.