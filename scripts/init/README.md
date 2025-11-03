# Scripts de Inicialización

Esta carpeta contiene scripts que se ejecutan durante el arranque de contenedores o la inicialización del sistema.

## 📋 Scripts Disponibles

### `docker-entrypoint.sh`

**Propósito**: Script de entrada para el contenedor WordPress que configura el entorno inicial.

**Cuándo se ejecuta**: 
- Automáticamente al iniciar el contenedor WordPress
- Durante la primera ejecución del contenedor

**Funciones principales**:
1. **Verificación de instalación**: Detecta si es la primera ejecución
2. **Copia de WordPress core**: Instala WordPress desde la imagen oficial
3. **Configuración de permisos**: Establece propietarios y permisos correctos
   - `www-data:www-data` para todos los archivos de WordPress
   - `755` para directorios, `644` para archivos
4. **Inicialización de Apache**: Inicia el servidor web

**Uso**:
```bash
# Se ejecuta automáticamente, pero puede probarse manualmente:
./scripts/init/docker-entrypoint.sh
```

**Ubicación original**: `docker/entrypoint.sh`

**Notas importantes**:
- Este script NO se usa actualmente en `docker-compose.yml`
- Está disponible para uso futuro o configuraciones personalizadas
- Mantiene compatibilidad con la imagen oficial de WordPress

## 🔧 Configuración

### Permisos requeridos
- Ejecutable: `chmod +x docker-entrypoint.sh`
- Usuario: Debe ejecutarse como root dentro del contenedor

### Variables de entorno utilizadas
- Ninguna específica (usa configuración estándar de WordPress)

## 🚨 Consideraciones de Seguridad

1. **Propietario de archivos**: Siempre establece `www-data:www-data`
2. **Permisos restrictivos**: No otorga permisos de escritura innecesarios
3. **Validación de rutas**: Verifica existencia de directorios antes de operar

## 📝 Logs

- Los logs se muestran en la salida estándar del contenedor
- Usar `docker logs wp_app` para ver la ejecución del script