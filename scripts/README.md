# Scripts del Proyecto PAT01-ECOM

Este directorio contiene todos los scripts organizados por categorías según las mejores prácticas de DevOps.

## 📁 Estructura de Carpetas

```
scripts/
├── init/                    # Scripts de inicialización
├── maintenance/             # Scripts de mantenimiento
├── cron/                    # Scripts y configuración de cron
└── README.md               # Este archivo
```

## 🚀 Scripts de Inicialización (`init/`)

Scripts que se ejecutan durante el arranque de contenedores o inicialización del sistema.

- **docker-entrypoint.sh**: Script de entrada para el contenedor WordPress
  - Se ejecuta automáticamente al iniciar el contenedor
  - Configura permisos y estructura inicial de WordPress

## 🔧 Scripts de Mantenimiento (`maintenance/`)

Scripts para tareas de mantenimiento regulares o bajo demanda.

- **backup.sh**: Script de backup automático de WordPress
  - Se ejecuta vía cron a las 2:00 AM diariamente
  - Respalda base de datos y archivos de WordPress
  
- **cleanup-logs.sh**: Script de limpieza de logs
  - Ejecución manual cuando sea necesario
  - Limpia y rota logs de WordPress y Docker

## ⏰ Scripts de Cron (`cron/`)

Configuración y archivos relacionados con tareas programadas.

- **cron.Dockerfile**: Dockerfile para contenedor de cron
- **crontab**: Configuración de trabajos programados

## 📋 Uso General

### Ejecutar Scripts de Mantenimiento

```bash
# Desde la raíz del proyecto
./scripts/maintenance/backup.sh
./scripts/maintenance/cleanup-logs.sh
```

### Construir Contenedor de Cron

```bash
# Desde la raíz del proyecto
docker build -f scripts/cron/cron.Dockerfile -t pat01-cron .
```

## ⚠️ Consideraciones Importantes

1. **Permisos**: Todos los scripts tienen permisos de ejecución configurados
2. **Rutas**: Los scripts están diseñados para ejecutarse desde la raíz del proyecto
3. **Dependencias**: Algunos scripts requieren que Docker esté ejecutándose
4. **Logs**: Los scripts generan logs en sus respectivos directorios

## 🔗 Referencias

- Documentación específica en cada subcarpeta
- Reglas del proyecto en `.trae/rules/project_rules.md`
- Configuración Docker en `docker-compose.yml`