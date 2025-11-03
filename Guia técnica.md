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

**¡El sistema está listo para usar!** 🎉