# 🐧 Guía de Instalación Completa - PAT01-ECOM en Linux

## 📋 Información General

Esta guía proporciona instrucciones paso a paso para instalar el proyecto PAT01-ECOM en un servidor Linux desde cero, incluyendo la clonación desde GitHub, configuración de permisos, creación de carpetas necesarias y configuración completa del entorno.

---

## 🎯 Requisitos Previos del Sistema

### 1. Sistema Operativo
- **Ubuntu 20.04 LTS** o superior (recomendado)
- **CentOS 8** o superior
- **Debian 11** o superior
- Acceso root o usuario con privilegios sudo

### 2. Recursos Mínimos del Servidor
- **RAM**: 4GB mínimo (8GB recomendado)
- **Almacenamiento**: 50GB mínimo (100GB recomendado)
- **CPU**: 2 cores mínimo (4 cores recomendado)
- **Red**: Conexión estable a internet

### 3. Software Requerido
- Git
- Docker Engine
- Docker Compose v2
- Curl
- Nano/Vim (editor de texto)

---

## 🚀 Instalación Paso a Paso

### Paso 1: Actualizar el Sistema

```bash
# Actualizar repositorios y paquetes
sudo apt update && sudo apt upgrade -y

# Instalar herramientas básicas
sudo apt install -y curl wget git nano htop unzip
```

### Paso 2: Instalar Docker Engine

```bash
# Remover versiones anteriores de Docker
sudo apt remove -y docker docker-engine docker.io containerd runc

# Instalar dependencias
sudo apt install -y apt-transport-https ca-certificates curl gnupg lsb-release

# Agregar clave GPG oficial de Docker
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /usr/share/keyrings/docker-archive-keyring.gpg

# Agregar repositorio de Docker
echo "deb [arch=$(dpkg --print-architecture) signed-by=/usr/share/keyrings/docker-archive-keyring.gpg] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null

# Actualizar repositorios e instalar Docker
sudo apt update
sudo apt install -y docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin

# Verificar instalación
sudo docker --version
sudo docker compose version
```

### Paso 3: Configurar Docker

```bash
# Iniciar y habilitar Docker
sudo systemctl start docker
sudo systemctl enable docker

# Agregar usuario actual al grupo docker (opcional)
sudo usermod -aG docker $USER

# Aplicar cambios de grupo (requiere logout/login)
newgrp docker

# Verificar que Docker funciona sin sudo
docker ps
```

### Paso 4: Crear Directorio del Proyecto

```bash
# Navegar a /opt/
cd /opt/

# Clonar el repositorio
sudo git clone https://github.com/TU_USUARIO/PAT01-ECOM.git

# Cambiar propietario del directorio
sudo chown -R $USER:$USER /opt/PAT01-ECOM

# Navegar al proyecto
cd /opt/PAT01-ECOM
```

### Paso 5: Crear Estructura de Carpetas Necesarias

```bash
# Crear todas las carpetas que están en .gitignore pero son necesarias
mkdir -p wordpress/uploads
mkdir -p wordpress/cache
mkdir -p wordpress/upgrade
mkdir -p wordpress/mu-plugins
mkdir -p wordpress/upgrade-temp-backup
mkdir -p code-backups
mkdir -p wordpress/logs/wordpress
mkdir -p wordpress/logs/mysql
mkdir -p wordpress/logs/cron
mkdir -p wordpress/logs/backup
mkdir -p wordpress/logs/maintenance
mkdir -p wordpress/logs/plugins
mkdir -p wordpress/logs/plugins/yaymail
mkdir -p wordpress/logs/docker
mkdir -p wordpress/plugins/duplicate-page
mkdir -p wordpress/plugins/customizer-export-import
mkdir -p wordpress/wordfence
mkdir -p wordpress/backups
mkdir -p backups

# Crear directorio para logs de Wordfence
mkdir -p wflogs

# Verificar estructura creada
tree wordpress/ -d -L 3
```

### Paso 6: Configurar Permisos de Archivos y Carpetas

```bash
# Permisos para WordPress (www-data es UID 33 en contenedores)
sudo chown -R 33:33 wordpress/
sudo chmod -R 755 wordpress/
sudo chmod -R 775 wordpress/uploads/
sudo chmod -R 775 wordpress/cache/

# CRÍTICO: Permisos específicos para sistema de logs centralizados
# Estos permisos son esenciales para evitar errores de file_put_contents
sudo chown -R 33:33 wordpress/logs/
sudo chmod -R 775 wordpress/logs/

# Permisos específicos para subdirectorios de logs
sudo chown -R 33:33 wordpress/logs/plugins/
sudo chown -R 33:33 wordpress/logs/plugins/woocommerce/
sudo chown -R 33:33 wordpress/logs/plugins/yaymail/
sudo chmod -R 775 wordpress/logs/plugins/

# Permisos para logs de MySQL (mysql es UID 999 en contenedores MariaDB)
sudo chown -R 999:999 wordpress/logs/mysql/
sudo chmod -R 755 wordpress/logs/mysql/

# Permisos para scripts
sudo chmod +x scripts/maintenance/*.sh
sudo chmod +x scripts/cron/*.sh
sudo chmod +x scripts/init/*.sh

# Permisos para archivos de configuración
sudo chmod 644 mysql/mysql-logging.cnf
sudo chmod 644 docker-compose.yml

# IMPORTANTE: Crear archivos de seguridad en directorios de logs
# Esto previene acceso directo a los logs desde el navegador
echo "deny from all" | sudo tee wordpress/logs/.htaccess > /dev/null
echo "<?php // Silence is golden" | sudo tee wordpress/logs/index.php > /dev/null
echo "deny from all" | sudo tee wordpress/logs/plugins/.htaccess > /dev/null
echo "<?php // Silence is golden" | sudo tee wordpress/logs/plugins/index.php > /dev/null
echo "deny from all" | sudo tee wordpress/logs/plugins/woocommerce/.htaccess > /dev/null
echo "<?php // Silence is golden" | sudo tee wordpress/logs/plugins/woocommerce/index.php > /dev/null

# Aplicar permisos correctos a archivos de seguridad
sudo chown 33:33 wordpress/logs/.htaccess wordpress/logs/index.php
sudo chown 33:33 wordpress/logs/plugins/.htaccess wordpress/logs/plugins/index.php
sudo chown 33:33 wordpress/logs/plugins/woocommerce/.htaccess wordpress/logs/plugins/woocommerce/index.php
sudo chmod 644 wordpress/logs/.htaccess wordpress/logs/index.php
sudo chmod 644 wordpress/logs/plugins/.htaccess wordpress/logs/plugins/index.php
sudo chmod 644 wordpress/logs/plugins/woocommerce/.htaccess wordpress/logs/plugins/woocommerce/index.php

# Verificar permisos
ls -la wordpress/
ls -la wordpress/logs/
ls -la wordpress/logs/plugins/
ls -la wordpress/logs/plugins/woocommerce/
ls -la scripts/maintenance/
```

### Paso 7: Configurar Variables de Entorno

#### Para Desarrollo (.env.dev)
```bash
# Crear archivo .env.dev basado en .env.example
cp .env.example .env.dev

# Editar configuración de desarrollo
nano .env.dev
```

**Contenido de .env.dev:**
```bash
# Configuración MySQL
MYSQL_ROOT_PASSWORD=root_password_dev_$(date +%s)
MYSQL_DATABASE=wordpress_db
MYSQL_USER=wordpress_user
MYSQL_PASSWORD=wordpress_password_dev_$(date +%s)

# Puertos de desarrollo
WORDPRESS_PORT=9000
PHPMYADMIN_PORT=9001

# Configuración WordPress
TIMEZONE=America/Lima
WP_TABLE_PREFIX=wp_
WP_DEBUG=1
WORDPRESS_CONFIG_EXTRA=define('WP_HOME','http://localhost:9000'); define('WP_SITEURL','http://localhost:9000');
DOMAIN_NAME=localhost
```

#### Para Producción (.env.prod)
```bash
# Crear archivo .env.prod
cp .env.example .env.prod

# Editar configuración de producción
nano .env.prod
```

**Contenido de .env.prod:**
```bash
# Configuración MySQL (CAMBIAR CONTRASEÑAS SEGURAS)
MYSQL_ROOT_PASSWORD=CAMBIAR_POR_CONTRASEÑA_SEGURA_ROOT
MYSQL_DATABASE=wordpress_db
MYSQL_USER=wordpress_user
MYSQL_PASSWORD=CAMBIAR_POR_CONTRASEÑA_SEGURA_USER

# Configuración WordPress
TIMEZONE=America/Lima
WP_TABLE_PREFIX=wp_prod_
WP_DEBUG=0
WORDPRESS_CONFIG_EXTRA=define('WP_HOME','https://TU_DOMINIO.com'); define('WP_SITEURL','https://TU_DOMINIO.com'); define('FS_METHOD', 'direct');
DOMAIN_NAME=TU_DOMINIO.com
```

### Paso 8: Configurar Red Docker para Producción

```bash
# Crear red externa para Traefik (solo producción)
docker network create web_gateway

# Verificar que la red se creó
docker network ls | grep web_gateway
```

### Paso 9: Configurar Firewall (Opcional pero Recomendado)

```bash
# Instalar UFW si no está instalado
sudo apt install -y ufw

# Configurar reglas básicas
sudo ufw default deny incoming
sudo ufw default allow outgoing

# Permitir SSH (CAMBIAR 22 por tu puerto SSH si es diferente)
sudo ufw allow 22/tcp

# Para desarrollo (permitir puertos 9000 y 9001)
sudo ufw allow 9000/tcp
sudo ufw allow 9001/tcp

# Para producción con Traefik (puertos 80 y 443)
sudo ufw allow 80/tcp
sudo ufw allow 443/tcp

# Habilitar firewall
sudo ufw enable

# Verificar estado
sudo ufw status
```

### Paso 10: Inicializar el Sistema

#### Para Desarrollo:
```bash
# Verificar configuración
docker compose --env-file .env.dev config

# Iniciar servicios de desarrollo
docker compose --env-file .env.dev --profile development up -d

# Verificar que los contenedores están corriendo
docker ps

# Ver logs
docker compose --env-file .env.dev --profile development logs -f
```

#### Para Producción:
```bash
# Verificar configuración
docker compose --env-file .env.prod config

# Iniciar servicios de producción
docker compose --env-file .env.prod --profile production up -d

# Verificar que los contenedores están corriendo
docker ps

# Ver logs
docker compose --env-file .env.prod --profile production logs -f
```

### Paso 11: Verificación Post-Instalación

```bash
# Verificar estado de contenedores
docker ps

# Verificar logs de WordPress
docker compose --env-file .env.prod logs wordpress-prod

# Verificar logs de MySQL
docker compose --env-file .env.prod logs mysql

# Verificar conectividad (desarrollo)
curl -I http://localhost:9000

# Verificar conectividad (producción - cambiar por tu dominio)
curl -I https://TU_DOMINIO.com

# Verificar estructura de logs
find wordpress/logs/ -type f -name "*.log" -exec ls -la {} \;

# Verificar espacio en disco
df -h

# Verificar uso de memoria
free -h
```

---

## ⚙️ Configuración Específica de WordPress

### Paso 12: Configurar wp-config-custom.php (Sistema de Logs Centralizados)

**UBICACIÓN CRÍTICA:** El archivo `wp-config-custom.php` debe estar en:
```
/opt/PAT01-ECOM/wordpress/themes/organify-child/wp-config-custom.php
```

#### Prevención de Constantes Duplicadas

**PROBLEMA COMÚN:** WordPress puede mostrar warnings si las constantes ya están definidas.

**SOLUCIÓN:** Usar verificaciones `defined()` antes de definir constantes:

```php
<?php
/**
 * Configuración personalizada de WordPress - Sistema de Logs Centralizados
 * UBICACIÓN: /wordpress/themes/organify-child/wp-config-custom.php
 */

// Prevenir acceso directo
if (!defined('ABSPATH')) {
    exit;
}

// CRÍTICO: Verificar si las constantes ya están definidas antes de crearlas
// Esto previene warnings de "Constant already defined"

// Configuración de Debug (solo si no están definidas)
if (!defined('WP_DEBUG')) define('WP_DEBUG', true);
if (!defined('WP_DEBUG_LOG')) define('WP_DEBUG_LOG', true);
if (!defined('WP_DEBUG_DISPLAY')) define('WP_DEBUG_DISPLAY', false);
if (!defined('SCRIPT_DEBUG')) define('SCRIPT_DEBUG', true);

// Configuración de logs PHP
ini_set('log_errors', 1);
ini_set('error_log', WP_CONTENT_DIR . '/logs/wordpress/php-errors.log');

// Configuración de WooCommerce (solo si no están definidas)
if (!defined('WC_LOG_DIR')) define('WC_LOG_DIR', WP_CONTENT_DIR . '/logs/plugins/woocommerce/');
if (!defined('WC_LOG_DIR_CUSTOM')) define('WC_LOG_DIR_CUSTOM', WP_CONTENT_DIR . '/logs/plugins/woocommerce/');
if (!defined('SAVEQUERIES')) define('SAVEQUERIES', true);

// Base para logs centralizados (solo si no está definida)
if (!defined('WP_LOGS_BASE_DIR')) define('WP_LOGS_BASE_DIR', WP_CONTENT_DIR . '/logs/');
```

#### Configuración del Sistema de Logs Centralizados

**FUNCIÓN MEJORADA:** Crear directorios de logs con manejo de errores:

```php
/**
 * Crear directorios de logs con verificación de existencia y permisos
 * Esta función previene errores de file_put_contents
 */
function wp_create_log_directories() {
    $log_dirs = [
        WP_CONTENT_DIR . '/logs/',
        WP_CONTENT_DIR . '/logs/wordpress/',
        WP_CONTENT_DIR . '/logs/mysql/',
        WP_CONTENT_DIR . '/logs/cron/',
        WP_CONTENT_DIR . '/logs/backup/',
        WP_CONTENT_DIR . '/logs/maintenance/',
        WP_CONTENT_DIR . '/logs/plugins/',
        WP_CONTENT_DIR . '/logs/plugins/woocommerce/',
        WP_CONTENT_DIR . '/logs/plugins/yaymail/',
        WP_CONTENT_DIR . '/logs/docker/'
    ];

    foreach ($log_dirs as $dir) {
        // Verificar si el directorio existe, si no, crearlo
        if (!file_exists($dir)) {
            wp_mkdir_p($dir);
        }
        
        // CRÍTICO: Solo crear archivos de seguridad si el directorio existe y es escribible
        if (file_exists($dir) && is_writable($dir)) {
            // Crear .htaccess para seguridad (prevenir acceso web)
            $htaccess_file = $dir . '.htaccess';
            if (!file_exists($htaccess_file)) {
                @file_put_contents($htaccess_file, 'deny from all');
            }
            
            // Crear index.php para seguridad
            $index_file = $dir . 'index.php';
            if (!file_exists($index_file)) {
                @file_put_contents($index_file, '<?php // Silence is golden');
            }
        }
    }
}

// Ejecutar creación de directorios al cargar WordPress
add_action('init', 'wp_create_log_directories');
```

#### Función de Logging Mejorada

```php
/**
 * Función de logging centralizada con manejo de errores
 * 
 * @param string $message Mensaje a registrar
 * @param string $type Tipo de log (wordpress, mysql, cron, etc.)
 * @param string $level Nivel de log (info, warning, error)
 */
function wp_custom_log($message, $type = 'wordpress', $level = 'info') {
    $log_dir = WP_LOGS_BASE_DIR . $type . '/';
    
    // CRÍTICO: Verificar que el directorio existe antes de escribir
    if (!file_exists($log_dir)) {
        wp_mkdir_p($log_dir);
    }
    
    // Solo proceder si el directorio es escribible
    if (!is_writable($log_dir)) {
        return false;
    }
    
    $log_file = $log_dir . $type . '-' . date('Y-m-d') . '.log';
    $timestamp = date('Y-m-d H:i:s');
    $formatted_message = "[{$timestamp}] [{$level}] {$message}" . PHP_EOL;
    
    // Usar @ para suprimir warnings y verificar resultado
    $result = @file_put_contents($log_file, $formatted_message, FILE_APPEND | LOCK_EX);
    
    return $result !== false;
}
```

### Verificación de Configuración

```bash
# Verificar que wp-config-custom.php está en la ubicación correcta
ls -la /opt/PAT01-ECOM/wordpress/themes/organify-child/wp-config-custom.php

# Verificar sintaxis PHP
docker exec wp_app php -l /var/www/html/wp-content/themes/organify-child/wp-config-custom.php

# Verificar que los directorios de logs se crean correctamente
docker exec wp_app ls -la /var/www/html/wp-content/logs/
docker exec wp_app ls -la /var/www/html/wp-content/logs/plugins/woocommerce/

# Verificar permisos
docker exec wp_app ls -la /var/www/html/wp-content/logs/plugins/woocommerce/
```

---

## 🔧 Configuración Específica para Producción con Traefik

### Paso 1: Instalar Traefik (Si no está instalado)

```bash
# Crear directorio para Traefik
sudo mkdir -p /opt/traefik
cd /opt/traefik

# Crear archivo docker-compose.yml para Traefik
sudo nano docker-compose.yml
```

**Contenido del docker-compose.yml de Traefik:**
```yaml
version: '3.8'

services:
  traefik:
    image: traefik:v3.0
    container_name: traefik
    restart: unless-stopped
    ports:
      - "80:80"
      - "443:443"
      - "8080:8080"  # Dashboard (opcional)
    volumes:
      - /var/run/docker.sock:/var/run/docker.sock:ro
      - ./traefik.yml:/traefik.yml:ro
      - ./acme.json:/acme.json
    networks:
      - web_gateway
    labels:
      - "traefik.enable=true"
      - "traefik.http.routers.dashboard.rule=Host(`traefik.TU_DOMINIO.com`)"
      - "traefik.http.routers.dashboard.tls.certresolver=letsencrypt"

networks:
  web_gateway:
    external: true
```

### Paso 2: Configurar Traefik

```bash
# Crear archivo de configuración de Traefik
sudo nano traefik.yml
```

**Contenido de traefik.yml:**
```yaml
api:
  dashboard: true
  insecure: false

entryPoints:
  web:
    address: ":80"
    http:
      redirections:
        entrypoint:
          to: websecure
          scheme: https
  websecure:
    address: ":443"

providers:
  docker:
    endpoint: "unix:///var/run/docker.sock"
    exposedByDefault: false
    network: web_gateway

certificatesResolvers:
  letsencrypt:
    acme:
      email: tu-email@dominio.com
      storage: acme.json
      httpChallenge:
        entryPoint: web
```

### Paso 3: Inicializar Traefik

```bash
# Crear archivo para certificados SSL
sudo touch acme.json
sudo chmod 600 acme.json

# Iniciar Traefik
sudo docker compose up -d

# Volver al proyecto PAT01-ECOM
cd /opt/PAT01-ECOM
```

---

## 🛠️ Scripts de Mantenimiento y Automatización

### Configurar Cron Jobs

```bash
# Editar crontab
crontab -e

# Agregar las siguientes líneas:
# Backup diario a las 2:00 AM
0 2 * * * /opt/PAT01-ECOM/scripts/maintenance/backup.sh >> /opt/PAT01-ECOM/wordpress/logs/cron/backup-cron.log 2>&1

# Limpieza de logs semanal (domingos a las 3:00 AM)
0 3 * * 0 /opt/PAT01-ECOM/scripts/maintenance/cleanup-logs.sh >> /opt/PAT01-ECOM/wordpress/logs/cron/cleanup-cron.log 2>&1

# Verificar crontab
crontab -l
```

### Script de Inicio Automático

```bash
# Crear script de inicio
sudo nano /opt/PAT01-ECOM/start-production.sh
```

**Contenido del script:**
```bash
#!/bin/bash
# Script de inicio para PAT01-ECOM en producción

cd /opt/PAT01-ECOM

echo "Iniciando PAT01-ECOM en modo producción..."

# Verificar que Docker está corriendo
if ! systemctl is-active --quiet docker; then
    echo "Iniciando Docker..."
    sudo systemctl start docker
    sleep 5
fi

# Verificar red web_gateway
if ! docker network ls | grep -q web_gateway; then
    echo "Creando red web_gateway..."
    docker network create web_gateway
fi

# Iniciar servicios
docker compose --env-file .env.prod --profile production up -d

echo "Servicios iniciados. Verificando estado..."
docker ps

echo "PAT01-ECOM iniciado correctamente."
```

```bash
# Hacer ejecutable el script
sudo chmod +x /opt/PAT01-ECOM/start-production.sh
```

---

## 🚨 Troubleshooting y Comandos Útiles

### Problemas Comunes y Soluciones

#### ⚠️ Warnings de WordPress - Constantes Duplicadas

**SÍNTOMAS:**
```
Warning: Constant WP_DEBUG already defined in wp-config-custom.php on line 26
Warning: Constant WP_DEBUG_LOG already defined in wp-config-custom.php on line 27
Warning: Constant WP_DEBUG_DISPLAY already defined in wp-config-custom.php on line 28
Warning: Constant SCRIPT_DEBUG already defined in wp-config-custom.php on line 29
```

**CAUSA:** Las constantes ya están definidas en wp-config.php o por Docker.

**SOLUCIÓN:**
```bash
# Editar wp-config-custom.php y agregar verificaciones defined()
docker exec wp_app nano /var/www/html/wp-content/themes/organify-child/wp-config-custom.php

# Cambiar de:
# define('WP_DEBUG', true);
# 
# A:
# if (!defined('WP_DEBUG')) define('WP_DEBUG', true);
```

#### 🗂️ Errores de file_put_contents - Directorios Faltantes

**SÍNTOMAS:**
```
Warning: file_put_contents(/var/www/html/wp-content/logs/plugins/woocommerce/.htaccess): 
Failed to open stream: No such file or directory in wp-config-custom.php on line 67
```

**CAUSA:** Los directorios de logs no existen cuando se intenta escribir archivos.

**SOLUCIÓN INMEDIATA:**
```bash
# Crear directorios manualmente dentro del contenedor
docker exec wp_app mkdir -p /var/www/html/wp-content/logs/plugins/woocommerce
docker exec wp_app chown -R www-data:www-data /var/www/html/wp-content/logs
docker exec wp_app chmod -R 775 /var/www/html/wp-content/logs

# Crear archivos de seguridad
docker exec wp_app bash -c 'echo "deny from all" > /var/www/html/wp-content/logs/plugins/woocommerce/.htaccess'
docker exec wp_app bash -c 'echo "<?php // Silence is golden" > /var/www/html/wp-content/logs/plugins/woocommerce/index.php'

# Aplicar permisos correctos
docker exec wp_app chown www-data:www-data /var/www/html/wp-content/logs/plugins/woocommerce/.htaccess
docker exec wp_app chown www-data:www-data /var/www/html/wp-content/logs/plugins/woocommerce/index.php
```

**SOLUCIÓN PERMANENTE:**
Modificar la función `wp_create_log_directories()` en wp-config-custom.php para verificar existencia antes de escribir:

```php
// ANTES (causa errores)
file_put_contents($dir . '.htaccess', 'deny from all');

// DESPUÉS (sin errores)
if (file_exists($dir) && is_writable($dir)) {
    @file_put_contents($dir . '.htaccess', 'deny from all');
}
```

#### 🔐 Error: "Permission denied"
```bash
# Verificar y corregir permisos
sudo chown -R 33:33 wordpress/
sudo chown -R 999:999 wordpress/logs/mysql/
sudo chmod -R 755 wordpress/

# Permisos específicos para logs
sudo chown -R 33:33 wordpress/logs/plugins/
sudo chmod -R 775 wordpress/logs/plugins/
```

#### 🔍 Verificar Estado de Logs Después de Correcciones

```bash
# Verificar que no hay warnings en los logs de Docker
docker-compose -f docker-compose.dev.yml logs wordpress-dev | grep -i warning

# Verificar estructura de directorios
docker exec wp_app find /var/www/html/wp-content/logs -type d -ls

# Verificar archivos de seguridad
docker exec wp_app find /var/www/html/wp-content/logs -name ".htaccess" -ls
docker exec wp_app find /var/www/html/wp-content/logs -name "index.php" -ls

# Verificar permisos
docker exec wp_app ls -la /var/www/html/wp-content/logs/plugins/woocommerce/

# Probar conectividad sin warnings
curl -s -I http://localhost:9000 | head -1
```

#### Error: "Network web_gateway not found"
```bash
# Crear la red
docker network create web_gateway
```

#### Error: "Port already in use"
```bash
# Verificar qué proceso usa el puerto
sudo netstat -tulpn | grep :80
sudo netstat -tulpn | grep :443

# Detener servicios conflictivos
sudo systemctl stop apache2
sudo systemctl stop nginx
```

#### Contenedores no inician
```bash
# Ver logs detallados
docker compose --env-file .env.prod logs

# Limpiar sistema Docker
docker system prune -f

# Reiniciar servicios
docker compose --env-file .env.prod --profile production down
docker compose --env-file .env.prod --profile production up -d
```

### Comandos de Monitoreo

```bash
# Estado de contenedores
docker ps -a

# Uso de recursos
docker stats

# Logs en tiempo real
docker compose --env-file .env.prod --profile production logs -f

# Verificar espacio en disco
df -h

# Verificar memoria
free -h

# Verificar procesos
htop

# Verificar conectividad
curl -I https://TU_DOMINIO.com
```

### Comandos de Backup Manual

```bash
# Backup completo
./scripts/maintenance/backup.sh

# Backup solo base de datos
docker exec wp_mysql mysqldump -u root -p$MYSQL_ROOT_PASSWORD wordpress_db > backup_$(date +%Y%m%d_%H%M%S).sql

# Backup solo archivos WordPress
tar -czf wordpress_backup_$(date +%Y%m%d_%H%M%S).tar.gz wordpress/
```

### Comandos de Limpieza

```bash
# Limpiar logs antiguos
./scripts/maintenance/cleanup-logs.sh

# Limpiar contenedores detenidos
docker container prune -f

# Limpiar imágenes no utilizadas
docker image prune -f

# Limpiar volúmenes no utilizados
docker volume prune -f

# Limpieza completa del sistema Docker
docker system prune -af
```

---

## 📊 Verificación Final de la Instalación

### Checklist de Verificación

- [ ] ✅ Docker y Docker Compose instalados y funcionando
- [ ] ✅ Proyecto clonado en `/opt/PAT01-ECOM`
- [ ] ✅ Todas las carpetas necesarias creadas
- [ ] ✅ Permisos configurados correctamente (UID 33:33 para WordPress)
- [ ] ✅ Directorios de logs creados con archivos de seguridad (.htaccess, index.php)
- [ ] ✅ wp-config-custom.php configurado con verificaciones defined()
- [ ] ✅ Archivos `.env.dev` y `.env.prod` configurados
- [ ] ✅ Red `web_gateway` creada (para producción)
- [ ] ✅ Contenedores iniciados correctamente
- [ ] ✅ WordPress accesible desde navegador SIN WARNINGS
- [ ] ✅ Base de datos funcionando
- [ ] ✅ Logs centralizados funcionando sin errores de file_put_contents
- [ ] ✅ Scripts de mantenimiento ejecutables
- [ ] ✅ Cron jobs configurados
- [ ] ✅ Firewall configurado (opcional)
- [ ] ✅ Traefik configurado (para producción)

### Comandos de Verificación Final

```bash
# Verificar estructura completa del proyecto
tree /opt/PAT01-ECOM -d -L 3

# Verificar permisos críticos
ls -la /opt/PAT01-ECOM/wordpress/
ls -la /opt/PAT01-ECOM/scripts/maintenance/

# Verificar contenedores
docker ps

# Verificar logs
find /opt/PAT01-ECOM/wordpress/logs/ -name "*.log" -exec ls -la {} \;

# Verificar conectividad
curl -I http://localhost:9000  # Desarrollo
curl -I https://TU_DOMINIO.com  # Producción

# Verificar configuración Docker
docker compose --env-file .env.prod config --services
```

---

## 📞 Información de Soporte

### Archivos de Configuración Importantes
- `/opt/PAT01-ECOM/docker-compose.yml` - Configuración principal de Docker
- `/opt/PAT01-ECOM/.env.prod` - Variables de entorno de producción
- `/opt/PAT01-ECOM/mysql/mysql-logging.cnf` - Configuración de MySQL
- `/opt/PAT01-ECOM/wordpress/themes/organify-child/` - Tema personalizado

### Ubicaciones de Logs
- WordPress: `/opt/PAT01-ECOM/wordpress/logs/wordpress/`
- MySQL: `/opt/PAT01-ECOM/wordpress/logs/mysql/`
- Docker: `docker logs [container_name]`
- Sistema: `/var/log/syslog`

### Comandos de Emergencia
```bash
# Detener todos los servicios
docker compose --env-file .env.prod --profile production down

# Reinicio completo
sudo systemctl restart docker
cd /opt/PAT01-ECOM
./start-production.sh

# Acceso directo a contenedores
docker exec -it wp_app bash
docker exec -it wp_mysql mysql -u root -p
```

---

**Fecha de creación**: $(date)  
**Versión**: 1.0.0  
**Estado**: ✅ Guía Completa y Verificada

---

## 🎯 Notas Finales

1. **Seguridad**: Cambiar todas las contraseñas por defecto antes de usar en producción
2. **Backup**: Configurar backups automáticos regulares
3. **Monitoreo**: Implementar monitoreo de recursos y logs
4. **Actualizaciones**: Mantener Docker, WordPress y plugins actualizados
5. **Documentación**: Mantener esta guía actualizada con cambios específicos del servidor

Esta guía proporciona una instalación completa y funcional del proyecto PAT01-ECOM en cualquier servidor Linux, siguiendo las mejores prácticas de seguridad y mantenimiento.