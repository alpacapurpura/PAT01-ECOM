# 🐳 Sistema Docker Unificado - WordPress Organify

## 📋 Resumen

Se ha consolidado exitosamente los archivos `docker-compose.dev.yml` y `docker-compose.prod.yml` en un **único archivo `docker-compose.yml`** que funciona tanto para desarrollo como para producción usando **perfiles de Docker Compose** y **variables de entorno**.

## 🎯 Beneficios del Sistema Unificado

- ✅ **Un solo archivo** `docker-compose.yml` para mantener
- ✅ **Configuración por variables** de entorno (.env.dev / .env.prod)
- ✅ **Perfiles automáticos** (development/production)
- ✅ **Menos duplicación** de código
- ✅ **Más fácil mantenimiento** y actualizaciones

## 🚀 Uso del Sistema

### 🔧 Desarrollo Local

```bash
# Iniciar entorno de desarrollo
docker-compose --env-file .env.dev --profile development up -d

# Ver logs en tiempo real
docker-compose --env-file .env.dev --profile development logs -f

# Detener entorno
docker-compose --env-file .env.dev --profile development down
```

**Servicios incluidos en desarrollo:**
- `mysql` - Base de datos MariaDB
- `wordpress-dev` - WordPress con debug habilitado
- `phpmyadmin` - Administrador de base de datos

**Puertos expuestos:**
- WordPress: `http://localhost:9000`
- phpMyAdmin: `http://localhost:9001`

### 🌐 Producción

```bash
# Iniciar entorno de producción
docker-compose --env-file .env.prod --profile production up -d

# Ver logs
docker-compose --env-file .env.prod --profile production logs -f

# Detener entorno
docker-compose --env-file .env.prod --profile production down
```

**Servicios incluidos en producción:**
- `mysql` - Base de datos MariaDB
- `wordpress-prod` - WordPress optimizado para producción
- `cron` - Tareas programadas (si existe cron.Dockerfile)

**Características de producción:**
- Sin puertos expuestos (gestionado por Traefik)
- Debug deshabilitado
- Labels de Traefik configurados
- Logging optimizado

## 📁 Estructura de Archivos

```
PAT01-ECOM/
├── docker-compose.yml          # ✅ ARCHIVO UNIFICADO
├── .env.dev                    # ✅ Variables de desarrollo
├── .env.prod                   # ✅ Variables de producción
├── .env.example                # ✅ Plantilla actualizada
├── docker-compose.dev.yml      # ⚠️  RESPALDO (no usar)
├── docker-compose.prod.yml     # ⚠️  RESPALDO (no usar)
└── README-DOCKER-UNIFICADO.md  # 📖 Esta documentación
```

## ⚙️ Configuración de Variables

### 📝 Archivo .env.dev (Desarrollo)

```bash
# Configuración MySQL
MYSQL_ROOT_PASSWORD=root_password_dev
MYSQL_DATABASE=wordpress_db
MYSQL_USER=wordpress_user
MYSQL_PASSWORD=wordpress_password_dev

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

### 🔒 Archivo .env.prod (Producción)

```bash
# Configuración MySQL (usar contraseñas seguras)
MYSQL_ROOT_PASSWORD=secure_root_password_prod
MYSQL_DATABASE=wordpress_db
MYSQL_USER=wordpress_user
MYSQL_PASSWORD=secure_wordpress_password_prod

# Configuración WordPress
TIMEZONE=America/Lima
WP_TABLE_PREFIX=wp_a4b7_
WP_DEBUG=0
WORDPRESS_CONFIG_EXTRA=define('WP_HOME','https://andessuyo.com'); define('WP_SITEURL','https://andessuyo.com'); define('FS_METHOD', 'direct');
DOMAIN_NAME=andessuyo.com
```

## 🔄 Migración desde Sistema Anterior

### ✅ Lo que YA NO necesitas hacer:

```bash
# ❌ ANTES (sistema separado)
docker-compose -f docker-compose.dev.yml up -d
docker-compose -f docker-compose.prod.yml up -d
```

### ✅ Lo que AHORA debes hacer:

```bash
# ✅ AHORA (sistema unificado)
docker-compose --env-file .env.dev --profile development up -d
docker-compose --env-file .env.prod --profile production up -d
```

## 🛠️ Comandos Útiles

### 🔍 Verificar Configuración

```bash
# Ver servicios de desarrollo
docker-compose --env-file .env.dev --profile development config --services

# Ver servicios de producción  
docker-compose --env-file .env.prod --profile production config --services

# Validar sintaxis completa
docker-compose --env-file .env.dev config
```

### 📊 Monitoreo

```bash
# Estado de contenedores
docker ps

# Logs específicos
docker-compose --env-file .env.dev logs wordpress-dev
docker-compose --env-file .env.prod logs wordpress-prod

# Uso de recursos
docker stats
```

### 🧹 Limpieza

```bash
# Limpiar contenedores detenidos
docker container prune -f

# Limpiar imágenes no utilizadas
docker image prune -f

# Limpiar todo el sistema
docker system prune -f
```

## 🚨 Consideraciones Importantes

### 🔐 Seguridad

- ✅ **NUNCA** commitear archivos `.env.dev` o `.env.prod`
- ✅ Usar contraseñas **seguras** en producción
- ✅ El archivo `.env.example` es seguro para commitear

### 🌐 Redes

- **Desarrollo**: Solo usa red `wordpress_network`
- **Producción**: Usa `wordpress_network` + `web_gateway` (Traefik)

### 💾 Volúmenes

- **Desarrollo**: Monta `./wordpress` completo para desarrollo
- **Producción**: Monta directorios específicos (themes, plugins, languages)

### 🔄 Perfiles

- **development**: mysql + wordpress-dev + phpmyadmin
- **production**: mysql + wordpress-prod + cron

## 🆘 Solución de Problemas

### ❌ Error: "invalid empty volume spec"

```bash
# Verificar que las variables estén definidas
cat .env.dev
cat .env.prod

# Verificar sintaxis
docker-compose --env-file .env.dev config
```

### ❌ Error: "network web_gateway not found"

```bash
# Solo afecta producción - crear la red si no existe
docker network create web_gateway
```

### ❌ Contenedores no inician

```bash
# Verificar logs
docker-compose --env-file .env.dev logs

# Limpiar y reiniciar
docker-compose --env-file .env.dev down
docker system prune -f
docker-compose --env-file .env.dev --profile development up -d
```

## 📞 Comandos de Referencia Rápida

```bash
# DESARROLLO
docker-compose --env-file .env.dev --profile development up -d
docker-compose --env-file .env.dev --profile development down
docker-compose --env-file .env.dev --profile development logs -f

# PRODUCCIÓN  
docker-compose --env-file .env.prod --profile production up -d
docker-compose --env-file .env.prod --profile production down
docker-compose --env-file .env.prod --profile production logs -f

# VERIFICACIÓN
docker-compose --env-file .env.dev config --services
docker-compose --env-file .env.prod config --services
```

---

## ✅ Estado del Proyecto

- ✅ **Sistema unificado** implementado y probado
- ✅ **Desarrollo** funcionando correctamente
- ✅ **Producción** validada (configuración)
- ✅ **Documentación** completa
- ✅ **Variables de entorno** optimizadas

# 📋 Documentación de Logs Centralizados - PAT01-ECOM

## 🎯 Resumen

Se ha implementado un sistema de logs centralizados para el proyecto PAT01-ECOM, consolidando todos los logs en la ubicación `/PAT01-ECOM/wordpress/logs/` con una estructura organizada y siguiendo las mejores prácticas.

---

## 📁 Estructura de Directorios

```
/PAT01-ECOM/wordpress/logs/
├── wordpress/          # Logs de WordPress (debug.log, errores PHP)
├── mysql/             # Logs de MySQL/MariaDB (error.log, general.log, slow.log)
├── cron/              # Logs de tareas programadas
├── backup/            # Logs de scripts de backup
├── maintenance/       # Logs de scripts de mantenimiento
├── plugins/           # Logs de plugins
│   └── yaymail/       # Logs específicos de YayMail
└── docker/            # Logs específicos de Docker
```

---

## 🔧 Configuraciones Implementadas

### 1. WordPress
- **Archivo**: `/PAT01-ECOM/wordpress/themes/organify-child/wp-config-custom.php`
- **Configuración**:
  - `WP_DEBUG_LOG` apunta a `/wp-content/logs/wordpress/debug.log`
  - `WP_LOGS_BASE_DIR` define la base de logs centralizados
  - Configuración de rotación automática de logs
  - Logging personalizado para plugins

### 2. MySQL/MariaDB
- **Archivo de configuración**: `/PAT01-ECOM/mysql/mysql-logging.cnf`
- **Logs configurados**:
  - `error.log` - Errores del servidor MySQL
  - `general.log` - Todas las consultas SQL
  - `slow.log` - Consultas lentas (>2 segundos)
- **Montaje en Docker**: `./mysql/mysql-logging.cnf:/etc/mysql/conf.d/mysql-logging.cnf:ro`

### 3. Docker Compose
- **Archivo**: `/PAT01-ECOM/docker-compose.yml`
- **Configuración de logging**:
  - Driver: `json-file`
  - Tamaño máximo: `50m`
  - Archivos máximos: `7`
- **Volúmenes montados**:
  - `./wordpress/logs:/var/www/html/wp-content/logs`
  - `./wordpress/logs/mysql:/var/log/mysql`

### 4. Scripts de Backup
- **Archivo**: `/PAT01-ECOM/scripts/maintenance/backup.sh`
- **Log**: `/PAT01-ECOM/wordpress/logs/backup/backup.log`
- **Funcionalidades**:
  - Logging con timestamp
  - Manejo de errores
  - Registro de éxito/fallo de operaciones

### 5. Scripts de Mantenimiento
- **Archivo**: `/PAT01-ECOM/scripts/maintenance/cleanup-logs.sh`
- **Log**: `/PAT01-ECOM/wordpress/logs/maintenance/cleanup-logs.log`
- **Funcionalidades**:
  - Limpieza de logs antiguos en todos los directorios
  - Backup automático de archivos grandes antes de eliminar
  - Logging detallado de operaciones

### 6. Cron Jobs
- **Script**: `/PAT01-ECOM/scripts/cron/cron-logger.sh`
- **Log**: `/PAT01-ECOM/wordpress/logs/cron/cron.log`
- **Funciones disponibles**:
  - `log_cron()` - Logging con timestamp
  - `execute_and_log()` - Ejecutar comandos con logging automático

---

## 🚀 Uso y Ejemplos

### Logging en WordPress
```php
// El logging se hace automáticamente a través de wp-config-custom.php
error_log("Mensaje de debug", 0); // Se guarda en wordpress/debug.log
```

### Logging en Scripts de Backup
```bash
# El script ya incluye logging automático
./scripts/maintenance/backup.sh
# Los logs se guardan en wordpress/logs/backup/backup.log
```

### Logging en Cron Jobs
```bash
# Cargar las funciones de logging
source /PAT01-ECOM/scripts/cron/cron-logger.sh

# Usar la función de logging
log_cron "Mensaje de cron job"

# Ejecutar comando con logging automático
execute_and_log "comando_a_ejecutar" "Descripción de la tarea"
```

### Verificar Logs de MySQL
```bash
# Ver logs de errores
tail -f /PAT01-ECOM/wordpress/logs/mysql/error.log

# Ver consultas generales
tail -f /PAT01-ECOM/wordpress/logs/mysql/general.log

# Ver consultas lentas
tail -f /PAT01-ECOM/wordpress/logs/mysql/slow.log
```

---

## 🔍 Monitoreo y Mantenimiento

### Verificar Estado de Logs
```bash
# Ver estructura completa
find /PAT01-ECOM/wordpress/logs/ -type f -exec ls -la {} \;

# Verificar tamaños de archivos
du -sh /PAT01-ECOM/wordpress/logs/*

# Ver logs más recientes
find /PAT01-ECOM/wordpress/logs/ -name "*.log" -mtime -1
```

### Limpieza Automática DEV
```bash
# Ejecutar script de limpieza
/.../PAT01-ECOM/scripts/maintenance/cleanup-logs.sh

# El script limpia automáticamente:
# - Archivos de log más antiguos que 7 días
# - Crea backups de archivos grandes antes de eliminar
# - Registra todas las operaciones
```

---

## 📊 Rotación de Logs

### WordPress
- Rotación automática configurada en `wp-config-custom.php`
- Archivos rotan cuando superan el tamaño máximo
- Se mantienen múltiples archivos históricos

### MySQL
- Configurado en `mysql-logging.cnf`
- Rotación basada en tamaño (`max_binlog_size = 100M`)
- Logs antiguos se eliminan automáticamente

### Docker
- Configurado en `docker-compose.yml`
- Máximo 7 archivos de 50MB cada uno
- Rotación automática por Docker

---

## 🛠️ Troubleshooting

### Problemas Comunes

1. **Permisos de archivos**
   ```bash
   # Corregir permisos de logs de WordPress
   sudo chown -R www-data:www-data /home/chris/PAT01-ECOM/wordpress/logs/wordpress/
   
   # Corregir permisos de logs de MySQL
   sudo chown -R 999:999 /home/chris/PAT01-ECOM/wordpress/logs/mysql/
   ```

2. **Logs no se generan**
   ```bash
   # Verificar configuración de WordPress
   docker exec wp_app php -l /var/www/html/wp-content/themes/organify-child/wp-config-custom.php
   
   # Verificar configuración de MySQL
   docker exec wp_mysql mysql -e "SHOW VARIABLES LIKE '%log%';"
   ```

3. **Espacio en disco**
   ```bash
   # Verificar espacio disponible
   df -h /home/chris/PAT01-ECOM/wordpress/logs/
   
   # Ejecutar limpieza manual
   /home/chris/PAT01-ECOM/scripts/maintenance/cleanup-logs.sh
   ```

---

## 📝 Migración Completada

### Archivos Movidos
- ✅ `/home/chris/PAT01-ECOM/wordpress/debug.log` → `wordpress/logs/wordpress/debug.log`
- ✅ `/home/chris/PAT01-ECOM/cleanup-logs.log` → `wordpress/logs/maintenance/cleanup-logs.log`
- ✅ `/home/chris/PAT01-ECOM/wordpress/yaymail-logs/` → `wordpress/logs/plugins/yaymail/`

### Configuraciones Actualizadas
- ✅ WordPress (`wp-config-custom.php`)
- ✅ Docker Compose (`docker-compose.yml`)
- ✅ MySQL (`mysql-logging.cnf`)
- ✅ Scripts de backup (`backup.sh`)
- ✅ Scripts de mantenimiento (`cleanup-logs.sh`)
- ✅ Scripts de cron (`cron-logger.sh`)

---

## 🎯 Beneficios Implementados

1. **Centralización**: Todos los logs en una ubicación única
2. **Organización**: Estructura clara por tipo de servicio
3. **Automatización**: Rotación y limpieza automática
4. **Monitoreo**: Fácil acceso y seguimiento de logs
5. **Mantenimiento**: Scripts automatizados para gestión
6. **Escalabilidad**: Estructura preparada para nuevos servicios
7. **Debugging**: Logs detallados para troubleshooting
8. **Compliance**: Siguiendo mejores prácticas de logging

---

## 📞 Soporte

Para cualquier problema o consulta relacionada con el sistema de logs centralizados, revisar:

1. Esta documentación
2. Los archivos de configuración mencionados
3. Los logs de error en cada directorio específico
4. Las reglas del proyecto en `.trae/rules/project_rules.md`

---

**Fecha de implementación**: 3 de Noviembre, 2025  
**Versión**: 1.0.0  
**Estado**: ✅ Completado y Funcional