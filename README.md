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

## Migraciones

```bash
docker compose exec app php artisan migrate
```

## Acceso

http://localhost:8000