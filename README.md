# 🟦 Turnero En Vivo — UTN FSA

Sistema de turnos en tiempo real desarrollado con **Laravel 12**, **Livewire 3**, **Tailwind CSS**, y **WebSockets usando Laravel Reverb + Laravel Echo**.

> Proyecto académico para la Tecnicatura Universitaria en Programación (UTN-FSA), simulando un turnero tipo banco / organismo público, con kiosco → puesto → pantalla TV.

---

## 🚀 Descripción general

Este sistema permite:

- 🧾 **Emitir turnos** desde un kiosco.
- 🎛️ **Gestionar turnos** desde un panel de agente / admin:
  - Llamar turno
  - Asignar módulo (1–5)
  - Re-llamar
  - Marcar ausente
  - Cerrar (atendido)
- 📺 **Visualizar turnos en pantalla TV**, en tiempo real.
- 🔔 Reproducir el sonido **“ding.mp3”** al llamar un turno.
- 🌐 Usar **WebSockets reales (Reverb)**.
- 🌗 Modo claro / oscuro incluido.

---

## 🧩 Módulos principales

| Ruta         | Función |
|--------------|---------|
| `/`          | Pantalla de bienvenida con accesos |
| `/kiosco`    | Emisión de turnos |
| `/puesto`    | Gestión completa de turnos |
| `/pantalla`  | Vista TV en tiempo real |

---

## 🧱 Tecnologías usadas

### **Backend**
- PHP 8.2+
- Laravel 12
- Livewire 3
- Laravel Reverb (WebSockets)
- Laravel Echo

### **Frontend**
- Tailwind CSS 3
- Alpine.js (modo oscuro)
- Vite

### **Base de datos**
- SQLite por defecto  
- Compatible con MySQL

---

## 🗃 Modelo de datos (simplificado)

### **Tabla `tickets`**
- servicio_id (FK)
- numero
- prioritario
- estado:  
  `en_espera`, `llamado`, `atendiendo`, `atendido`, `ausente`
- llamado_at
- puesto_id (FK)

### Relaciones:

- Un servicio tiene muchos tickets.
- Un puesto tiene muchos tickets.
- Un ticket pertenece a un servicio y puede asignarse a un módulo.

---

## 🔄 Flujo completo de un turno

1. Usuario emite turno en `/kiosco`.
2. El turno entra en estado **en_espera**.
3. En `/puesto` el agente:
   - selecciona un turno  
   - asigna módulo  
   - presiona “Llamar”
4. Se dispara el evento **TurnoLlamado**.
5. Laravel Reverb manda el evento a `/pantalla` en tiempo real.
6. La pantalla actualiza y suena el **ding.mp3**.
7. El agente puede:
   - comenzar
   - cerrar (atendido)
   - marcar ausente
   - re-llamar

---

## ⚙️ Instalación y ejecución local

### 1. Clonar el repositorio
```bash
git clone https://github.com/Mtz1974/turnero-utn-fsa.git
cd turnero-utn-fsa
```

### 2. Instalar dependencias de backend
```bash
composer install
```

### 3. Instalar dependencias de frontend
```bash
npm install
```

### 4. Configurar .env
```env
APP_NAME="Turnero En Vivo UTN-FSA"
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
```

Crear base de datos:
```bash
mkdir -p database
touch database/database.sqlite
```

### 5. Generar claves y migrar
```bash
php artisan key:generate
php artisan migrate --seed
```

### 🔥 6. Ejecutar en 3 terminales

**Terminal 1 — Laravel**
```bash
php artisan serve
```

**Terminal 2 — Frontend**
```bash
npm run dev
```

**Terminal 3 — WebSockets Reverb**
```bash
php artisan reverb:start
```

---

## 🧪 Rutas para probar

- http://127.0.0.1:8000/
- http://127.0.0.1:8000/kiosco
- http://127.0.0.1:8000/puesto
- http://127.0.0.1:8000/pantalla

---

## 🌗 Modo claro / oscuro

- Implementado con Alpine.js.
- Tailwind configurado en `darkMode: 'class'`.
- Persistencia usando localStorage.

---

## 👨‍💻 Autores

Proyecto desarrollado por:
 **Arce Leonardo Agustin**
 **Fabio Arias,**
 **Maria Teresa Zamboni,**  

Como trabajo académico para la:
**UTN — Facultad Regional Formosa**.

---

## ✔️ Estado del proyecto

Versión **1.0.0** totalmente funcional.  
Listo para entregar y mostrar como portfolio profesional.

