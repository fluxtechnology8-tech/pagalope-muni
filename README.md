# Pagalope Muni

## Requisitos

- Docker
- Docker Compose

## Instalación

```bash
cd pagalope-muni

cp .env.example .env

docker compose up -d --build
```

## Instalar dependencias

```bash
docker compose exec app composer install
```

## Generar APP_KEY

```bash
docker compose exec app php artisan key:generate
```

## Acceso a la BD
En .env buscar DB_PASSWORD y poner como valor: Password123!
Así debe de quedar:

```bash
DB_PASSWORD=Password123!
```

## Crear la base de datos

```bash
docker compose exec sqlserver /opt/mssql-tools18/bin/sqlcmd -S localhost -U sa -P 'Password123!' -C
```

```sql
CREATE DATABASE pagalope;
GO
```

## Migraciones

```bash
docker compose exec app php artisan migrate
```

## Acceso

http://localhost:8000