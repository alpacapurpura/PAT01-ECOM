# WordPress Docker Compose - Acceso Directo

Solución completa de WordPress con Docker Compose para desarrollo y producción, configurada para acceso directo sin proxy inverso.

## 🚀 Características

- **WordPress** última versión con configuración optimizada
- **MySQL 8.0** como base de datos
- **phpMyAdmin** para administración de base de datos
- **Acceso directo** sin configuraciones complejas de proxy
- **Cross-platform** compatible con Windows, Linux y macOS
- **Configuración de producción** con Docker secrets
- **Scripts automatizados** de backup y restauración
- **Extensible** para WooCommerce y otros plugins

## 📋 Requisitos Previos

- Docker Engine 20.10+
- Docker Compose 2.0+
- Puertos disponibles: 8080 (WordPress), 8081 (phpMyAdmin)

## ⚡ Instalación Rápida

### Windows
```cmd
# Clonar y configurar
git clone <repository-url> wordpress-docker
cd wordpress-docker

# Ejecutar script de configuración
setup.bat

# Iniciar servicios
docker-compose up -d
```

### Linux/macOS
```bash
# Clonar y configurar
git clone <repository-url> wordpress-docker
cd wordpress-docker

# Ejecutar script de configuración
chmod +x setup.sh
./setup.sh

# Iniciar servicios
docker-compose up -d
```

## 🌐 Acceso a los Servicios

- **WordPress**: http://localhost:8080
- **phpMyAdmin**: http://localhost:8081
- **Usuario phpMyAdmin**: `wordpress_user` (configurado en .env)
- **Contraseña phpMyAdmin**: `wordpress_password_change_me` (configurado en .env)

## ⚙️ Configuración

### Variables de Entorno

Edita el archivo `.env` con tus configuraciones:

```env
# Configuración de MySQL
MYSQL_ROOT_PASSWORD=tu_password_seguro
MYSQL_DATABASE=wordpress_db
MYSQL_USER=wordpress_user
MYSQL_PASSWORD=tu_password_usuario

# Configuración de WordPress
WORDPRESS_PORT=8080
WORDPRESS_URL=http://localhost:8080

# Configuración de phpMyAdmin
PHPMYADMIN_PORT=8081
```

### Configuración de Producción

Para producción, usa `docker-compose.prod.yml`:

```bash
# Configurar secretos
echo "tu_password_root_seguro" > secrets/mysql_root_password.txt
echo "tu_password_usuario_seguro" > secrets/mysql_password.txt

# Iniciar en producción
docker-compose -f docker-compose.prod.yml up -d
```

## 🛠️ Comandos Útiles

```bash
# Ver logs
docker-compose logs -f

# Reiniciar servicios
docker-compose restart

# Detener servicios
docker-compose down

# Backup de base de datos
docker-compose exec mysql mysqldump -u root -p wordpress_db > backup.sql

# Restaurar base de datos
docker-compose exec -i mysql mysql -u root -p wordpress_db < backup.sql

# Acceder a contenedor WordPress
docker-compose exec wordpress bash

# Ver estado de servicios
docker-compose ps
```

## 📁 Estructura del Proyecto

```
wordpress-docker/
├── docker-compose.yml          # Configuración de desarrollo
├── docker-compose.prod.yml     # Configuración de producción
├── .env                        # Variables de entorno
├── .env.example               # Plantilla de variables
├── setup.bat                  # Script de configuración Windows
├── setup.sh                   # Script de configuración Linux/Mac
├── wordpress/                 # Archivos de WordPress
│   ├── themes/               # Temas personalizados
│   ├── plugins/              # Plugins personalizados
│   └── uploads/              # Archivos subidos
├── mysql/
│   └── init/                 # Scripts de inicialización DB
├── secrets/                   # Secretos para producción
└── backups/                   # Respaldos automáticos
```

## 🔧 Troubleshooting

### Problemas Comunes

**Puerto ocupado:**
```bash
# Cambiar puerto en .env
WORDPRESS_PORT=8090
PHPMYADMIN_PORT=8091
```

**Error de conexión a base de datos:**
```bash
# Verificar que MySQL esté funcionando
docker-compose logs mysql

# Reiniciar servicios
docker-compose restart
```

**Permisos de archivos:**
```bash
# Linux/Mac - Ajustar permisos
sudo chown -R www-data:www-data wordpress/
chmod -R 755 wordpress/
```

## 🔒 Seguridad

- Cambia todas las contraseñas por defecto
- Usa contraseñas seguras (mínimo 16 caracteres)
- En producción, configura HTTPS
- Mantén WordPress y plugins actualizados
- Configura backups automáticos

## 📦 Extensiones

### WooCommerce
```env
# Habilitar en .env
WOOCOMMERCE_ENABLED=true
WOOCOMMERCE_CURRENCY=USD
WOOCOMMERCE_COUNTRY=US
```

### Backup Automático
```bash
# Configurar en .env
BACKUP_SCHEDULE=daily
BACKUP_RETENTION_DAYS=7
```

## 📄 Licencia

Este proyecto está bajo la Licencia MIT. Ver `LICENSE` para más detalles.

## 🤝 Contribuir

1. Fork del proyecto
2. Crear rama feature (`git checkout -b feature/AmazingFeature`)
3. Commit cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abrir Pull Request

## 📞 Soporte

Para soporte y preguntas:
- Crear un issue en GitHub
- Revisar la documentación en `.trae/documents/`
- Consultar logs: `docker-compose logs`