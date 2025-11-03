# Scripts y Configuración de Cron

Esta carpeta contiene la configuración y archivos relacionados con tareas programadas (cron jobs) del proyecto PAT01-ECOM.

## 📋 Archivos Disponibles

### `cron.Dockerfile`

**Propósito**: Dockerfile para crear un contenedor dedicado que ejecuta tareas programadas.

**Funciones principales**:
1. **Imagen base**: Alpine Linux (ligera y segura)
2. **Dependencias**: Instala `dcron`, `docker-cli` y `curl`
3. **Scripts**: Copia el script de backup al contenedor
4. **Configuración**: Establece crontab y permisos
5. **Logging**: Configura logs de cron en `/var/log/cron.log`

**Uso**:
```bash
# Construir la imagen desde la raíz del proyecto
docker build -f scripts/cron/cron.Dockerfile -t pat01-cron .

# Ejecutar el contenedor
docker run -d --name pat01-cron \
  -v /var/run/docker.sock:/var/run/docker.sock \
  -v $(pwd)/.env:/app/.env \
  pat01-cron
```

**Características**:
- **Modo foreground**: Ejecuta cron en primer plano para Docker
- **Debug level 8**: Logging detallado para troubleshooting
- **Permisos seguros**: crontab con permisos 600

---

### `crontab`

**Propósito**: Archivo de configuración que define cuándo y cómo ejecutar las tareas programadas.

**Configuración actual**:
```bash
# Backup diario a las 2:00 AM
0 2 * * * /usr/local/bin/backup.sh >> /var/log/cron.log 2>&1
```

**Formato explicado**:
- `0 2 * * *`: Minuto 0, Hora 2, Cualquier día del mes, Cualquier mes, Cualquier día de la semana
- `/usr/local/bin/backup.sh`: Script a ejecutar
- `>> /var/log/cron.log 2>&1`: Redirige salida y errores al log

**Modificación**:
```bash
# Para cambiar horarios, editar el archivo y reconstruir la imagen
vim scripts/cron/crontab
docker build -f scripts/cron/cron.Dockerfile -t pat01-cron .
```

## 🔧 Configuración y Despliegue

### Construcción de la Imagen

```bash
# Desde la raíz del proyecto PAT01-ECOM
docker build -f scripts/cron/cron.Dockerfile -t pat01-cron .
```

### Ejecución del Contenedor

```bash
# Ejecutar con acceso a Docker socket y variables de entorno
docker run -d \
  --name pat01-cron \
  --restart unless-stopped \
  -v /var/run/docker.sock:/var/run/docker.sock \
  -v $(pwd)/.env:/app/.env \
  -v $(pwd)/scripts:/app/scripts \
  pat01-cron
```

### Integración con Docker Compose

Para integrar en `docker-compose.yml`:

```yaml
services:
  cron:
    build:
      context: .
      dockerfile: scripts/cron/cron.Dockerfile
    container_name: pat01_cron
    restart: unless-stopped
    volumes:
      - /var/run/docker.sock:/var/run/docker.sock
      - ./.env:/app/.env
      - ./scripts:/app/scripts
    depends_on:
      - mysql
      - wordpress-dev
```

## 📊 Monitoreo y Logs

### Ver Logs de Cron

```bash
# Logs del contenedor
docker logs pat01-cron

# Logs específicos de cron (dentro del contenedor)
docker exec pat01-cron tail -f /var/log/cron.log

# Ver logs en tiempo real
docker exec pat01-cron tail -f /var/log/cron.log | grep backup
```

### Verificar Estado del Cron

```bash
# Verificar que el contenedor esté ejecutándose
docker ps | grep pat01-cron

# Verificar procesos de cron dentro del contenedor
docker exec pat01-cron ps aux | grep cron

# Listar trabajos de cron configurados
docker exec pat01-cron crontab -l
```

## 🕐 Programación de Tareas

### Formato de Crontab

```
# ┌───────────── minuto (0 - 59)
# │ ┌───────────── hora (0 - 23)
# │ │ ┌───────────── día del mes (1 - 31)
# │ │ │ ┌───────────── mes (1 - 12)
# │ │ │ │ ┌───────────── día de la semana (0 - 6) (Domingo=0)
# │ │ │ │ │
# * * * * * comando a ejecutar
```

### Ejemplos de Programación

```bash
# Cada día a las 2:00 AM
0 2 * * * /usr/local/bin/backup.sh

# Cada hora
0 * * * * /usr/local/bin/cleanup-logs.sh

# Cada lunes a las 3:00 AM
0 3 * * 1 /usr/local/bin/maintenance.sh

# Cada 15 minutos
*/15 * * * * /usr/local/bin/health-check.sh
```

## 🚨 Consideraciones de Seguridad

### Permisos y Acceso

1. **Docker Socket**: El contenedor tiene acceso al socket de Docker
   - Necesario para ejecutar comandos docker
   - Implica privilegios elevados
   
2. **Variables de Entorno**: Acceso al archivo `.env`
   - Contiene credenciales sensibles
   - Montar como read-only si es posible

3. **Logs**: Los logs pueden contener información sensible
   - Rotar logs regularmente
   - Configurar permisos restrictivos

### Mejores Prácticas

```bash
# Montar .env como read-only
-v $(pwd)/.env:/app/.env:ro

# Limitar recursos del contenedor
--memory=128m --cpus=0.5

# Usar usuario no-root (si es posible)
--user 1000:1000
```

## 🔄 Mantenimiento

### Actualización de Tareas

1. Modificar `scripts/cron/crontab`
2. Reconstruir la imagen: `docker build -f scripts/cron/cron.Dockerfile -t pat01-cron .`
3. Recrear el contenedor: `docker stop pat01-cron && docker rm pat01-cron`
4. Ejecutar el nuevo contenedor

### Backup de Configuración

```bash
# Backup de la configuración de cron
cp scripts/cron/crontab backups/crontab.backup.$(date +%Y%m%d)

# Backup de logs
docker exec pat01-cron cp /var/log/cron.log /tmp/
docker cp pat01-cron:/tmp/cron.log backups/
```

## 🆘 Troubleshooting

### Problemas Comunes

**Cron no ejecuta tareas**:
1. Verificar que el contenedor esté ejecutándose
2. Comprobar sintaxis del crontab
3. Verificar permisos de los scripts
4. Revisar logs: `docker logs pat01-cron`

**Scripts fallan en cron**:
1. Verificar variables de entorno
2. Comprobar rutas absolutas en scripts
3. Verificar acceso al socket de Docker
4. Revisar logs específicos de la tarea

**Contenedor se detiene**:
1. Verificar logs de Docker
2. Comprobar recursos disponibles
3. Verificar sintaxis del Dockerfile
4. Revisar dependencias y volúmenes