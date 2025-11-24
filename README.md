🟦 Turnero En Vivo — UTN FSA

Sistema de turnos en tiempo real desarrollado con Laravel 12, Livewire 3, Tailwind CSS, y WebSockets usando Laravel Reverb + Laravel Echo.

Proyecto académico para la Tecnicatura Universitaria en Programación (UTN-FSA), pensado para simular un turnero tipo banco / organismo público, con flujo completo de kiosco → puesto → pantalla TV.

🚀 Descripción general

Este sistema permite:

🧾 Emitir turnos desde un kiosco (sin autenticación)

🎛️ Gestionar turnos desde un panel de puesto

Llamar turno

Asignar módulo (Módulo 1–5)

Re-llamar

Marcar ausente

Cerrar (atendido)

📺 Visualizar turnos en pantalla tipo TV, en tiempo real

🔔 Ejecutar un sonido “ding” al llamar un turno

🌐 Usar WebSockets reales mediante Laravel Reverb

🌗 Cambiar entre modo claro / oscuro

🧩 Módulos principales
Ruta	Descripción
/	Welcome con explicación y accesos directos
/kiosco	Emisión de turnos por parte del usuario
/puesto	Panel de agente/admin para gestionar turnos
/pantalla	Pantalla TV con actualizaciones en vivo
🧱 Tecnologías usadas
Backend

PHP 8.2+

Laravel 12

Laravel Reverb (WebSockets nativos)

Laravel Echo (cliente WebSocket)

Livewire 3

Frontend

Tailwind CSS 3

Vite

Alpine.js (modo Dark/Light)

Tiempo real

Eventos broadcast (TurnoLlamado)

Canales públicos con Reverb

Echo escuchando en pantalla

Base de datos

SQLite por defecto (database/database.sqlite)

Se puede usar MySQL sin cambios en el código

🗃 Modelo de datos (simplificado)
users

id, name, email, password

role: admin / agente / publico

servicios

id, nombre, codigo

Ej.: ME → Mesa de Entradas, AD → Administración

puestos

id, codigo, nombre

Ej.: “Módulo 1”, “Módulo 2”, etc.

tickets

servicio_id → pertenece a un Servicio

numero → correlativo

prioritario → sí/no

estado → en_espera, llamado, atendiendo, atendido, ausente

llamado_at → datetime

puesto_id → módulo asignado

Relaciones

Un Servicio tiene muchos Tickets

Un Puesto tiene muchos Tickets

Un Ticket pertenece a un Servicio y (si ya fue llamado) a un Puesto

🔄 Flujo del sistema

Usuario genera turno desde /kiosco

El turno queda en estado en_espera

En /puesto, el agente:

visualiza todos los turnos

elige uno

asigna el módulo

lo llama

Se dispara TurnoLlamado

Laravel Reverb manda el evento por WebSocket

En /pantalla:

Se actualiza en vivo

Suena el “ding”

El agente puede:

comenzar → atendiendo

cerrar → atendido

ausente → ausente

re-llamar → vuelve a sonar

⚙️ Instalación y ejecución local
🟦 1. Clonar el repositorio
git clone https://github.com/Mtz1974/turnero-utn-fsa.git
cd turnero-utn-fsa

🟦 2. Instalar dependencias de PHP
composer install

🟦 3. Instalar dependencias de Node
npm install

🟦 4. Configurar el archivo .env

Copiar el archivo:

cp .env.example .env


Configurar estas variables:

APP_NAME="Turnero En Vivo UTN-FSA"
APP_ENV=local
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite

BROADCAST_CONNECTION=reverb
QUEUE_CONNECTION=database

REVERB_APP_ID=local
REVERB_APP_KEY=local-key
REVERB_APP_SECRET=local-secret
REVERB_HOST=127.0.0.1
REVERB_PORT=8080
REVERB_SCHEME=http

VITE_REVERB_APP_KEY="${REVERB_APP_KEY}"
VITE_REVERB_HOST="${REVERB_HOST}"
VITE_REVERB_PORT="${REVERB_PORT}"
VITE_REVERB_SCHEME="${REVERB_SCHEME}"


Crear el archivo SQLite:

mkdir -p database
touch database/database.sqlite

🟦 5. Generar Key + Migrar BD
php artisan key:generate
php artisan migrate --seed


El seed crea:

Servicios

Puestos (Módulos 1–5)

Usuarios de prueba

▶️ Correr el sistema (3 terminales)
🟩 Terminal 1 – Backend Laravel
php artisan serve

🟦 Terminal 2 – Vite
npm run dev

🟧 Terminal 3 – WebSocket Reverb
php artisan reverb:start

🧪 Rutas para pruebas
Ruta	Función
/	Welcome informativo
/kiosco	Generación de turnos
/puesto	Gestión del agente (requiere login)
/pantalla	Pantalla TV en tiempo real
Prueba recomendada

Abrir /pantalla (dejar abierta)

Desde /kiosco, generar 2–3 turnos

En /puesto, asignar módulo y llamar

Ver cómo /pantalla actualiza en vivo y suena el ding

🌗 Modo claro / oscuro

✔ Controlado por Alpine
✔ Guarda preferencia en localStorage
✔ Soporte completo con clases dark: de Tailwind

👨‍💻 Autor

Proyecto desarrollado por María Teresa Zamboni,
para la Tecnicatura Universitaria en Programación – UTN Facultad Regional Formosa.

Incluye:

Migraciones, seeders, modelos correctamente diseñados

WebSockets nativos con Laravel Reverb + Echo

Interfaz moderna con Tailwind + Livewire

Flujo completo y funcional de turnos

📌 Listo para presentar

Este README está optimizado para:

Profesores

Corrección académica

Repositorios públicos

Documentación clara