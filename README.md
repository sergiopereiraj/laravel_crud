# API RESTful de Notas – Laravel 12

Este proyecto es una API RESTful desarrollada con Laravel 12 para gestionar notas. Permite crear, listar, visualizar y eliminar notas. Usa base de datos SQLite para simplificar la ejecución.

---

## 🧩 Características Técnicas

- **Framework**: Laravel 12
- **Base de datos**: SQLite
- **Modelo**: Eloquent Model
- **Controlador**: Resource Controller (`NoteController`)
- **Testing**: PHPUnit, tests de feature implementados
- **Validaciones**: Título requerido, contenido opcional

---

## 🚀 Instalación

1. Clona el repositorio:

   ```bash
   git clone https://github.com/tu-usuario/laravel-notes-api.git
   cd laravel-notes-api
   ```

2. Instala las dependencias del proyecto:

   ```bash
   composer install
   ```

3. Copia el archivo `.env` y configura la base de datos SQLite:

   ```bash
   cp .env.example .env
   touch database/database.sqlite
   ```

4. En el archivo `.env`, configura:

   ```
   DB_CONNECTION=sqlite
   DB_DATABASE=database/database.sqlite
   ```

---

## 🛠️ Migraciones

Ejecuta las migraciones para crear la tabla `notes`:

```bash
php artisan migrate
```

---

## 🧪 Ejecución de Tests

Este proyecto incluye 2 tests de feature para validar la creación de una nota:

```bash
php artisan test
```

> Asegúrate de tener configurado el entorno de test con base de datos SQLite en memoria (`.env.testing`):

```env
DB_CONNECTION=sqlite
DB_DATABASE=:memory:
```

---

## 📡 Ejecutar el servidor local

Levanta el servidor en entorno local con:

```bash
php artisan serve
```

Accede a la API en: [http://localhost:8000/api/notes](http://localhost:8000/api/notes)

---

## 📚 Rutas API

| Método | Ruta              | Acción                    |
|--------|-------------------|---------------------------|
| GET    | /api/notes        | Listar todas las notas    |
| GET    | /api/notes/{id}   | Ver detalle de una nota   |
| POST   | /api/notes        | Crear una nueva nota      |
| DELETE | /api/notes/{id}   | Eliminar una nota         |
| PUT    | /api//notes/{id}  | Actualizar nota           |

*A pesar de no ser solicitado en la prueba tecnica, agregue el metodo PUT
---

## ✨ Extras (Versión Plus)

Se incluyen validaciones adicionales al crear una nota:

- `title` es requerido y máximo 255 caracteres
- `content` es opcional
- Validaciones implementadas directamente en el controlador

---

## 🧾 Licencia

Proyecto desarrollado como parte de la prueba técnica para **Núcleo Factory**.
