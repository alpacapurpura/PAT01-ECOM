# Arquitectura Docker para WordPress

## 1. Arquitectura del Sistema

```mermaid
graph TD
    A[Usuario] --> C[WordPress Container]
    C --> D[MySQL Database]
    C --> E[phpMyAdmin]
    E --> D
    
    subgraph "Docker Network"
        C
        D
        E
    end
    
    subgraph "Volúmenes Persistentes"
        F[wp_data]
        G[db_data]
        H[wp_uploads]
    end
    
    C --> F
    C --> H
    D --> G
```

## 2. Descripción de Tecnologías

* **Frontend**: WordPress 6.4 (PHP 8.1 + Apache)

* **Base de Datos**: MySQL 8.0

* **Administración DB**: phpMyAdmin 5.2

* **Orquestación**: Docker Compose v2

* **Red**: Red interna Docker personalizada

* **Almacenamiento**: Volúmenes Docker persistentes

* **Acceso**: Directo a través de puertos expuestos

## 3. Definición de Rutas

| Ruta                    | Propósito                            |
| ----------------------- | ------------------------------------ |
| <http://localhost:8080> | Sitio WordPress principal            |
| <http://localhost:8081> | phpMyAdmin para administración de BD |
| /wp-admin               | Panel de administración WordPress    |
| /wp-content/uploads     | Archivos multimedia subidos          |

## 4. Definiciones de API

### 4.1 APIs Core de WordPress

**API REST de WordPress**

```
GET /wp-json/wp/v2/posts
```

Request:

| Parámetro | Tipo    | Requerido | Descripción                          |
| --------- | ------- | --------- | ------------------------------------ |
| per\_page | integer | false     | Número de posts por página (máx 100) |
| page      | integer | false     | Página a mostrar                     |
| search    | string  | false     | Término de búsqueda                  |

Response:

| Campo   | Tipo    | Descripción                            |
| ------- | ------- | -------------------------------------- |
| id      | integer | ID único del post                      |
| title   | object  | Título del post                        |
| content | object  | Contenido del post                     |
| status  | string  | Estado del post (publish, draft, etc.) |

Ejemplo:

```json
{
  "id": 1,
  "title": {
    "rendered": "Hola Mundo"
  },
  "content": {
    "rendered": "<p>Bienvenido a WordPress...</p>"
  },
  "status": "publish"
}
```

## 5. Arquitectura del Servidor

```mermaid
graph TD
    A[Docker Host] --> B[Docker Compose]
    B --> C[WordPress Service]
    B --> D[MySQL Service]
    B --> E[phpMyAdmin Service]
    
    subgraph "Capa de Aplicación"
        C
        E
    end
    
    subgraph "Capa de Datos"
        D
    end
    
    subgraph "Capa de Red"
        F[wordpress_network]
    end
    
    C --> F
    D --> F
    E --> F
```

## 6. Modelo de Datos

### 6.1 Definición del Modelo de Datos

```mermaid
erDiagram
    USERS ||--o{ POSTS : creates
    POSTS ||--o{ COMMENTS : has
    POSTS ||--o{ POST_META : has
    USERS ||--o{ USER_META : has
    POSTS }o--|| TERMS : categorized_by
    
    USERS {
        bigint ID PK
        varchar user_login
        varchar user_email
        varchar user_pass
        datetime user_registered
        varchar user_status
    }
    
    POSTS {
        bigint ID PK
        bigint post_author FK
        datetime post_date
        longtext post_content
        text post_title
        varchar post_status
        varchar post_type
    }
    
    COMMENTS {
        bigint comment_ID PK
        bigint comment_post_ID FK
        text comment_content
        varchar comment_author
        varchar comment_author_email
        datetime comment_date
    }
    
    TERMS {
        bigint term_id PK
        varchar name
        varchar slug
        bigint term_group
    }
```

### 6.2 Lenguaje de Definición de Datos (DDL)

**Configuración de Base de Datos MySQL**

```sql
-- Crear base de datos
CREATE DATABASE wordpress_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Crear usuario
CREATE USER 'wp_user'@'%' IDENTIFIED BY 'secure_password_123';
GRANT ALL PRIVILEGES ON wordpress_db.* TO 'wp_user'@'%';
FLUSH PRIVILEGES;

-- Configurar parámetros de rendimiento
SET GLOBAL innodb_buffer_pool_size = 256M;
SET GLOBAL max_connections = 100;
SET GLOBAL query_cache_size = 32M;

-- Índices recomendados para WordPress
CREATE INDEX idx_post_name ON wp_posts(post_name);
CREATE INDEX idx_post_parent ON wp_posts(post_parent);
CREATE INDEX idx_comment_approved_date_gmt ON wp_comments(comment_approved, comment_date_gmt);
```

**Configuración inicial de WordPress**

```sql
-- Datos iniciales de configuración
INSERT INTO wp_options (option_name, option_value) VALUES 
('siteurl', 'http://localhost:8080'),
('home', 'http://localhost:8080'),
('blogname', 'Mi Sitio WordPress'),
('admin_email', 'admin@midominio.com'),
('default_role', 'subscriber'),
('timezone_string', 'America/Lima');
```

