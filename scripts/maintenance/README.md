# Scripts de Mantenimiento

Esta carpeta contiene scripts para tareas de mantenimiento regulares o bajo demanda del proyecto PAT01-ECOM.

## 📋 Scripts Disponibles

### `backup.sh`

**Propósito**: Script de backup automático completo de WordPress (base de datos y archivos).

**Cuándo se ejecuta**: 
- Automáticamente vía cron a las 2:00 AM diariamente
- Manualmente cuando sea necesario

**Funciones principales**:
1. **Backup de base de datos**: Exporta MySQL con compresión gzip
2. **Backup de archivos**: Respalda volumen `wordpress_data` 
3. **Limpieza automática**: Elimina backups antiguos según retención configurada
4. **Logging**: Registra todas las operaciones

**Uso**:
```bash
# Ejecución manual desde la raíz del proyecto
./scripts/maintenance/backup.sh

# Verificar configuración
source .env && echo "Retención: $BACKUP_RETENTION_DAYS días"
```

**Configuración requerida**:
- Archivo `.env` con variables de base de datos
- Directorio de backup: `/home/ubuntu/backups/andessuyo`
- Variables: `MYSQL_USER`, `MYSQL_PASSWORD`, `MYSQL_DATABASE`, `BACKUP_RETENTION_DAYS`

---

### `cleanup-logs.sh`

**Propósito**: Script de limpieza y rotación de logs de WordPress y Docker.

**Cuándo se ejecuta**: 
- Manualmente cuando los logs crecen demasiado
- Recomendado ejecutar semanalmente

**Funciones principales**:
1. **Análisis de logs**: Examina tamaño y contenido de debug.log
2. **Rotación automática**: Rota archivos que excedan 50MB
3. **Limpieza por antigüedad**: Elimina logs antiguos (>7 días)
4. **Verificación Docker**: Comprueba configuración de rotación
5. **Reportes**: Genera informes detallados de limpieza

**Uso**:
```bash
# Ejecución manual desde la raíz del proyecto
./scripts/maintenance/cleanup-logs.sh

# Ver logs del script
tail -f cleanup-logs.log
```

**Configuración**:
- Directorio WordPress: `/home/chris/PAT01-ECOM/wordpress`
- Retención: 7 días
- Tamaño máximo por archivo: 50MB
- Log del script: `cleanup-logs.log`

## 🔧 Configuración General

### Variables de Entorno Requeridas

**Para backup.sh**:
```bash
MYSQL_USER=tu_usuario
MYSQL_PASSWORD=tu_password
MYSQL_DATABASE=wordpress_db
BACKUP_RETENTION_DAYS=30
```

**Para cleanup-logs.sh**:
- No requiere variables adicionales
- Usa configuración hardcodeada en el script

### Permisos Requeridos
```bash
chmod +x scripts/maintenance/*.sh
```

### Dependencias
- Docker y Docker Compose ejecutándose
- Contenedor `wp_mysql` activo (para backup.sh)
- Acceso de escritura al directorio de backup

## 📊 Monitoreo y Logs

### Backup Script
- **Logs de cron**: `/var/log/cron.log` (en contenedor cron)
- **Archivos generados**: 
  - `db-backup-YYYY-MM-DD_HH-MM-SS.sql.gz`
  - `wp-files-backup-YYYY-MM-DD_HH-MM-SS.tar.gz`

### Cleanup Script
- **Log principal**: `cleanup-logs.log`
- **Reportes**: `cleanup-report-YYYYMMDD_HHMMSS.txt`
- **Salida en pantalla**: Coloreada y detallada

## 🚨 Consideraciones de Seguridad

1. **Credenciales**: Nunca hardcodear passwords en scripts
2. **Permisos de backup**: Verificar acceso al directorio de destino
3. **Espacio en disco**: Monitorear espacio disponible
4. **Logs sensibles**: Los logs pueden contener información sensible

## 🔄 Automatización

### Cron Jobs Configurados
```bash
# Backup diario a las 2:00 AM
0 2 * * * /usr/local/bin/backup.sh >> /var/log/cron.log 2>&1
```

### Recomendaciones de Ejecución
- **backup.sh**: Diario (automático)
- **cleanup-logs.sh**: Semanal (manual)

## 🆘 Troubleshooting

### Problemas Comunes

**Backup falla**:
1. Verificar que el contenedor MySQL esté ejecutándose
2. Comprobar credenciales en `.env`
3. Verificar espacio en disco en directorio de backup

**Cleanup no funciona**:
1. Verificar permisos en directorio WordPress
2. Comprobar que el script se ejecute desde la raíz del proyecto
3. Verificar que los contenedores estén ejecutándose