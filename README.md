# WordPress Docker Compose

WordPress con MySQL y phpMyAdmin usando Docker Compose.

## Requisitos

- Docker
- Docker Compose

## Configuración Rápida

1. Copia `.env.example` a `.env`
2. Edita las contraseñas en `.env`
3. Ejecuta: `docker-compose up -d`

## Acceso

- **WordPress**: http://localhost:8080
- **phpMyAdmin**: http://localhost:8081

## Comandos

```bash
# Desarrollo
docker-compose up -d

# Producción
docker-compose -f docker-compose.prod.yml up -d

# Detener
docker-compose down

# Ver logs
docker-compose logs -f

# Backup DB
docker-compose exec mysql mysqldump -u root -p wordpress_db > backup.sql
```

## Variables de Entorno (.env)

```env
MYSQL_ROOT_PASSWORD=tu_password_seguro
MYSQL_DATABASE=wordpress_db
MYSQL_USER=wordpress_user
MYSQL_PASSWORD=tu_password_usuario
WORDPRESS_PORT=8080
PHPMYADMIN_PORT=8081
```


La primera vez se debe navegar hasta donde se encuentra el entrypoint.sh y ejecutar: chmod +x entrypoint.sh