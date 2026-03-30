# BDM Systems - acoperisuri.info

Website profesionist pentru servicii de acoperisuri.

## Stack Tehnologic

- **Backend**: PHP 8.x
- **Database**: MySQL 8.x
- **Frontend**: HTML5, CSS3, JavaScript (vanilla)
- **Server local**: Laragon (Apache + MySQL + PHP)

## Setup Local (Laragon)

1. Instaleaza [Laragon](https://laragon.org/download/) (versiunea Full)
2. Cloneaza repository-ul in directorul de lucru:
   ```bash
   git clone https://github.com/bdmsalessuport1-commits/acoperisuri.info.git
   ```
3. Copiaza `.env.example` in `.env` si configureaza credentialele:
   ```bash
   cp .env.example .env
   ```
4. Instaleaza dependintele PHP:
   ```bash
   composer install
   ```
5. Porneste Laragon si acceseaza: `http://localhost:8000`

Alternativ, porneste serverul PHP built-in:
```bash
php -S localhost:8000 -t public
```

## Structura Directoare

```
/public/            Document root (servit de server)
  /css/             Stiluri CSS
  /js/              JavaScript
  /images/          Imagini statice
  /uploads/         Fisiere uploadate de utilizatori
  index.php         Entry point
  .htaccess         Reguli Apache rewrite

/src/               Cod PHP backend
  /controllers/     Controllere (logica request/response)
  /models/          Modele (interactiune cu baza de date)
  /views/           Template-uri HTML
    /layouts/       Layout-uri de baza (header, footer)
    /pages/         Pagini individuale
    /partials/      Componente reutilizabile
    /admin/         View-uri panou administrare
  /helpers/         Functii utilitare
  /config/          Configurari aplicatie
  /middleware/      Middleware (auth, CSRF, etc.)

/admin/             Panou de administrare

/database/          Baza de date
  /migrations/      Migrari structura DB
  /seeds/           Date initiale
  schema.sql        Schema completa

/storage/           Fisiere generate
  /logs/            Log-uri aplicatie
  /cache/           Cache
```

## Branching

- `main` - productie stabila
- `develop` - dezvoltare activa, deploy automat pe staging
