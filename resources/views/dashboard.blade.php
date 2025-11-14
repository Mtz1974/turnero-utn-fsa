<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-100 leading-tight">
            Panel del Usuario · Turnero UTN-FSA
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-4">

            {{-- Bienvenida --}}
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow p-6 mb-8 border border-slate-200 dark:border-slate-700">
                <h3 class="text-xl font-bold text-slate-800 dark:text-slate-100">
                    ¡Bienvenido/a, {{ Auth::user()->name }}!
                </h3>
                <p class="mt-2 text-slate-600 dark:text-slate-300 text-sm leading-relaxed">
                    Desde este panel podés acceder rápidamente a los módulos principales del turnero.
                    Elegí la opción que corresponda según tu rol o tarea.
                </p>
            </div>

            {{-- Grid de acciones --}}
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

                {{-- BOTÓN /PUESTO --}}
                <a href="{{ url('/puesto') }}"
                   class="group block rounded-xl border border-sky-400 bg-sky-500/10 dark:bg-sky-500/20 p-6 hover:bg-sky-500/30 transition shadow-lg shadow-sky-500/20">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-bold text-sky-400">Panel de Puesto</h3>
                        <span class="text-3xl group-hover:scale-110 transition">🎛️</span>
                    </div>
                    <p class="mt-2 text-sm text-slate-700 dark:text-slate-300">
                        Accedé al panel para llamar, atender, relamar o cerrar turnos.
                    </p>
                </a>

                {{-- BOTÓN /KIOSCO --}}
                <a href="{{ url('/kiosco') }}"
                   class="group block rounded-xl border border-emerald-400 bg-emerald-500/10 dark:bg-emerald-500/20 p-6 hover:bg-emerald-500/30 transition shadow-lg shadow-emerald-500/20">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-bold text-emerald-400">Kiosco de Turnos</h3>
                        <span class="text-3xl group-hover:scale-110 transition">🧾</span>
                    </div>
                    <p class="mt-2 text-sm text-slate-700 dark:text-slate-300">
                        Emisión de turnos para usuarios. Ideal para mostradores o recepción.
                    </p>
                </a>

                {{-- BOTÓN /PANTALLA --}}
                <a href="{{ url('/pantalla') }}"
                   class="group block rounded-xl border border-indigo-400 bg-indigo-500/10 dark:bg-indigo-500/20 p-6 hover:bg-indigo-500/30 transition shadow-lg shadow-indigo-500/20">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-bold text-indigo-400">Pantalla TV</h3>
                        <span class="text-3xl group-hover:scale-110 transition">📺</span>
                    </div>
                    <p class="mt-2 text-sm text-slate-700 dark:text-slate-300">
                        Vista tipo TV con turnos llamados y actualizaciones en tiempo real.
                    </p>
                </a>

            </div>

            {{-- Info adicional --}}
            <div class="mt-10 text-sm text-slate-600 dark:text-slate-400">
                <p>💡 Si sos administrador, podés gestionar el sistema desde estos accesos rápidos.</p>
            </div>
        </div>
    </div>
</x-app-layout>
