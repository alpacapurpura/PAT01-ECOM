# Procedimiento de Migración Producción a Desarrollo

## 📋 Resumen del Procedimiento

Este documento detalla el proceso completo para migrar un backup de producción a desarrollo local, incluyendo las verificaciones y correcciones necesarias para evitar problemas comunes como los de Elementor.

## 🎯 Pasos Previos a la Migración

### 1. Verificar Estado del Proyecto

```bash
# Verificar estado de Git
git status
git log -1 --oneline

# Verificar que estamos en desarrollo
pwd
# Debe estar en /home/chris/PAT01-ECOM

# Verificar que el entorno local esté detenido
docker-compose -f docker-compose.dev.yml down
```

### 2. Preparar Entorno Local

```bash
# Crear backup del desarrollo actual (opcional pero recomendado)
cp -r wordpress backups/wordpress-dev-$(date +%Y%m%d-%H%M%S)

# Verificar que .env.dev existe y está configurado
cat .env.dev | grep WORDPRESS_PORT
# Debe mostrar WORDPRESS_PORT=9000
```

## 📦 Procedimiento de Backup en Producción

### 1. Conectar a Producción

```bash
# Conectar al servidor de producción
ssh -i /ruta/al/archivo/id_rsa -p 22022 root@161.132.41.191

# Navegar al proyecto
cd ../opt/PAT01-ECOM
```

### 2. Crear Backup Completo

```bash
# Crear directorio de backups con fecha
mkdir -p backups/$(date +%Y%m%d-%H%M%S)
cd backups/$(date +%Y%m%d-%H%M%S)

# Backup de la base de datos
docker exec wp_db mysqldump -u root -p${MYSQL_ROOT_PASSWORD} wordpress > wordpress_backup.sql

# Backup de wp-content (temas, plugins, uploads)
tar -czf wp-content_backup.tar.gz ../../wordpress/wp-content/

# Backup de .env (para referencia, NO para usar directamente)
cp ../../.env ./env_backup.txt

# Verificar tamaño de archivos
ls -lh

# Salir del servidor
exit
```

### 3. Descargar Backups a Local

```bash
# En tu máquina local, crear directorio para backups
mkdir -p backups/produccion/$(date +%Y%m%d-%H%M%S)
cd backups/produccion/$(date +%Y%m%d-%H%M%S)

# Descargar archivos desde producción
scp -P 22022 -i /ruta/al/archivo/id_rsa root@161.132.41.191:/opt/PAT01-ECOM/backups/$(date +%Y%m%d-%H%M%S)/wordpress_backup.sql .
scp -P 22022 -i /ruta/al/archivo/id_rsa root@161.132.41.191:/opt/PAT01-ECOM/backups/$(date +%Y%m%d-%H%M%S)/wp-content_backup.tar.gz .
scp -P 22022 -i /ruta/al/archivo/id_rsa root@161.132.41.191:/opt/PAT01-ECOM/backups/$(date +%Y%m%d-%H%M%S)/env_backup.txt .

# Verificar descarga
ls -lh
```

## 🔄 Procedimiento de Restauración en Desarrollo

### 1. Preparar Restauración

```bash
# Volver al directorio del proyecto
cd /home/chris/PAT01-ECOM

# Levantar el entorno de desarrollo
docker-compose -f docker-compose.dev.yml up -d

# Esperar 30 segundos para que los contenedores estén listos
sleep 30

# Verificar que estén corriendo
docker-compose -f docker-compose.dev.yml ps
```

### 2. Restaurar Base de Datos

```bash
# Copiar backup al contenedor
docker cp backups/produccion/$(date +%Y%m%d-%H%M%S)/wordpress_backup.sql wp_db:/tmp/

# Restaurar base de datos (esto borrará todo el contenido actual)
docker exec wp_db mysql -u root -p${MYSQL_ROOT_PASSWORD} wordpress < /tmp/wordpress_backup.sql

# Verificar que la restauración fue exitosa
docker exec wp_app wp option get siteurl
# Debe mostrar la URL de producción (ej: https://andessuyo.com)
```

### 3. Restaurar wp-content

```bash
# Extraer el backup de wp-content
cd backups/produccion/$(date +%Y%m%d-%H%M%S)
tar -xzf wp-content_backup.tar.gz

# Copiar al contenedor (esto sobrescribirá el contenido actual)
docker cp wordpress/wp-content wp_app:/var/www/html/

# Verificar permisos (importante para Elementor)
docker exec wp_app chown -R www-data:www-data /var/www/html/wp-content/uploads
docker exec wp_app chmod -R 755 /var/www/html/wp-content/uploads
```

## 🔧 Correcciones Post-Migración (CRÍTICO)

### 1. Reemplazar URLs (Paso Más Importante)

```bash
# Obtener la URL original del backup
URL_ORIGINAL=$(docker exec wp_app wp option get siteurl)
echo "URL original encontrada: $URL_ORIGINAL"

# Reemplazar URLs de producción a desarrollo
# Primero HTTPS
 docker exec wp_app wp search-replace "https://andessuyo.com" "http://localhost:9000" --all-tables

# Luego HTTP (por si acaso)
 docker exec wp_app wp search-replace "http://andessuyo.com" "http://localhost:9000" --all-tables

# Verificar el cambio
docker exec wp_app wp option get siteurl
# Ahora debe mostrar: http://localhost:9000
```

### 2. Regenerar Archivos de Elementor

```bash
# Regenerar CSS de Elementor
docker exec wp_app wp elementor flush-css

# Regenerar archivos de Elementor
docker exec wp_app wp elementor regenerate-files

# Limpiar archivos temporales de Elementor
docker exec wp_app wp elementor library sync

# Limpiar caché de WordPress
docker exec wp_app wp cache flush
```

### 3. Actualizar Permalinks y Transients

```bash
# Flushear permalinks
docker exec wp_app wp rewrite flush --hard

# Limpiar transients
docker exec wp_app wp transient delete-all

# Limpiar opciones de cron
docker exec wp_app wp cron event run --due-now
```

## ✅ Verificaciones Post-Migración

### 1. Verificar URLs y Configuración

```bash
# Verificar URLs principales
docker exec wp_app wp option get siteurl
docker exec wp_app wp option get home

# Verificar que Elementor esté activo
docker exec wp_app wp plugin list | grep elementor

# Verificar páginas con Elementor
docker exec wp_app wp post list --post_type=page --meta_key=_elementor_data
```

### 2. Verificar Editor de Elementor

```bash
# Activar debug si es necesario
docker exec wp_app wp config set WP_DEBUG true --raw
docker exec wp_app wp config set WP_DEBUG_LOG true --raw
docker exec wp_app wp config set WP_DEBUG_DISPLAY false --raw

# Verificar logs de debug
docker exec wp_app tail -f /var/www/html/wp-content/debug.log
# Presionar Ctrl+C para salir
```

### 3. Verificar Contenido y Permisos

```bash
# Verificar uploads de Elementor
docker exec wp_app ls -la /var/www/html/wp-content/uploads/elementor/

# Verificar que existan archivos CSS
docker exec wp_app find /var/www/html/wp-content/uploads/elementor -name "*.css"

# Verificar tamaño de uploads
docker exec wp_app du -sh /var/www/html/wp-content/uploads
```

## 🚨 Solución de Problemas Comunes

### Problema 1: Elementor muestra páginas en blanco

**Síntomas:** El editor de Elementor carga pero las páginas aparecen vacías.

**Solución:**
```bash
# 1. Verificar que se hizo el reemplazo de URLs
docker exec wp_app wp search-replace "https://andessuyo.com" "http://localhost:9000" --all-tables --dry-run

# 2. Si hay reemplazos pendientes, ejecutar sin --dry-run
docker exec wp_app wp search-replace "https://andessuyo.com" "http://localhost:9000" --all-tables

# 3. Regenerar CSS de Elementor
docker exec wp_app wp elementor flush-css

# 4. Sincronizar librería
docker exec wp_app wp elementor library sync
```

### Problema 2: Imágenes no se muestran

**Síntomas:** Las imágenes aparecen rotas o no cargan.

**Solución:**
```bash
# 1. Verificar permisos de uploads
docker exec wp_app chown -R www-data:www-data /var/www/html/wp-content/uploads
docker exec wp_app chmod -R 755 /var/www/html/wp-content/uploads

# 2. Reemplazar URLs de imágenes
docker exec wp_app wp search-replace "https://andessuyo.com/wp-content/uploads" "http://localhost:9000/wp-content/uploads" --all-tables
```

### Problema 3: Plugins conflictuados

**Síntomas:** Error 500 o comportamiento inesperado.

**Solución:**
```bash
# 1. Ver plugins activos
docker exec wp_app wp plugin list --status=active

# 2. Desactivar plugins problemáticos (ej: Wordfence)
docker exec wp_app wp plugin deactivate wordfence

# 3. Si es necesario, desactivar todos los plugins
docker exec wp_app wp plugin deactivate --all

# 4. Reactivar uno por uno para identificar el problema
docker exec wp_app wp plugin activate [nombre-del-plugin]
```

### Problema 4: Contenedores Docker con conflictos

**Síntomas:** Error de nombres de contenedores duplicados.

**Solución:**
```bash
# 1. Ver contenedores activos
docker ps -a

# 2. Detener y eliminar contenedores conflictivos
docker stop wp_app_prod wp_cron
docker rm wp_app_prod wp_cron

# 3. O usar el comando más directo
docker-compose -f docker-compose.dev.yml down --remove-orphans
```

## 📋 Checklist Final de Verificación

### ✅ Verificaciones Obligatorias

- [ ] URLs reemplazadas correctamente (siteurl y home muestran localhost:9000)
- [ ] Elementor puede editar páginas sin mostrar blanco
- [ ] Imágenes cargan correctamente
- [ ] Plugins críticos están activos
- [ ] No hay errores en debug.log
- [ ] Permisos de archivos son correctos
- [ ] Contenedores Docker están corriendo sin errores

### 📝 Comandos de Verificación Rápida

```bash
# Verificación completa en un solo script
echo "=== VERIFICACIÓN POST-MIGRACIÓN ==="
echo "URLs:"; docker exec wp_app wp option get siteurl; docker exec wp_app wp option get home
echo "Elementor:"; docker exec wp_app wp plugin list | grep elementor
echo "Páginas Elementor:"; docker exec wp_app wp post list --post_type=page --meta_key=_elementor_data --format=count
echo "Permisos uploads:"; docker exec wp_app ls -la /var/www/html/wp-content/uploads | head -5
echo "=== FIN VERIFICACIÓN ==="
```

## 🎯 Notas Importantes

1. **Siempre** hacer backup antes de migrar
2. **Nunca** saltarse el reemplazo de URLs
3. **Verificar** Elementor inmediatamente después de migrar
4. **Documentar** cualquier problema y solución encontrada
5. **Probar** el flujo completo de edición con Elementor

## 📞 Contacto y Emergencias

Si algo sale mal:
1. Verificar logs: `docker-compose -f docker-compose.dev.yml logs -f`
2. Revisar este documento paso a paso
3. Documentar el problema para futuras migraciones
4. En último caso, restaurar desde backup local anterior

---

**Última actualización:** $(date +%Y-%m-%d)
**Versión:** 1.0.0
**Autor:** Sistema de documentación automática