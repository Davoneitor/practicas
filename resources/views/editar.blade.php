
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Cliente  Id: '.$cliente->id.' Nombre: '.$cliente->nombre) }}

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Mensaje de éxito -->
                    @if (session('message'))
                        <div class="mb-4 text-sm font-medium text-green-600 dark:text-green-400">
                            {{ session('message') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('tablaCliente.actualizar', $cliente->id) }}">
                        @csrf
                        @method('PUT')
                        <!-- Nombre Completo -->
                        <div>
                            <x-input-label for="nombre" :value="__('Nombre Completo')" />
                            <x-text-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" :value="$cliente->nombre ?? old('nombre')" required autofocus />
                            <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                        </div>

                        <!-- Correo Electrónico -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Correo Electrónico')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="$cliente->email ?? old('email')" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Teléfono -->
                        <div class="mt-4">
                            <x-input-label for="telefono" :value="__('Teléfono')" />
                            <x-text-input id="telefono" class="block mt-1 w-full" type="text" name="telefono" :value="$cliente->telefono ?? old('telefono')" required />
                            <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
                        </div>

                        <!-- Fecha de Nacimiento -->
                        <div class="mt-4">
                            <x-input-label for="fecha_nacimiento" :value="__('Fecha de Nacimiento')" />
                            <x-text-input id="fecha_nacimiento" class="block mt-1 w-full" type="date" name="fecha_nacimiento" :value="$cliente->fecha_nacimiento ?? old('fecha_nacimiento')" required />
                            <x-input-error :messages="$errors->get('fecha_nacimiento')" class="mt-2" />
                        </div>

                        <!-- Dirección -->
                        <div class="mt-4">
                            <x-input-label for="direccion" :value="__('Dirección')" />
                            <x-text-input id="direccion" class="block mt-1 w-full" type="text" name="direccion" :value="$cliente->direccion ?? old('direccion')" required />
                            <x-input-error :messages="$errors->get('direccion')" class="mt-2" />
                        </div>

                        <!-- Número de Identificación -->
                        <div class="mt-4">
                            <x-input-label for="identificacion" :value="__('Número de Identificación')" />
                            <x-text-input id="identificacion" class="block mt-1 w-full" type="text" name="identificacion" :value="$cliente->identificacion ?? old('identificacion')" required />
                            <x-input-error :messages="$errors->get('identificacion')" class="mt-2" />
                        </div>

                        <!-- Número de Cuenta -->
                        <div class="mt-4">
                            <x-input-label for="numero_cuenta" :value="__('Número de Cuenta')" />
                            <x-text-input id="numero_cuenta" class="block mt-1 w-full" type="text" name="numero_cuenta" :value="$cliente->numero_cuenta ?? old('numero_cuenta')" required />
                            <x-input-error :messages="$errors->get('numero_cuenta')" class="mt-2" />
                        </div>

                        <!-- Saldo Inicial -->
                        <div class="mt-4">
                            <x-input-label for="saldo" :value="__('Saldo Inicial')" />
                            <x-text-input id="saldo" class="block mt-1 w-full" type="number" name="saldo" :value="$cliente->saldo ?? old('saldo')" required />
                            <x-input-error :messages="$errors->get('saldo')" class="mt-2" />
                        </div>

                        <!-- Fecha de Apertura de Cuenta -->
                        <div class="mt-4">
                            <x-input-label for="fecha_apertura" :value="__('Fecha de Apertura de Cuenta')" />
                            <x-text-input id="fecha_apertura" class="block mt-1 w-full" type="date" name="fecha_apertura" :value="$cliente->fecha_apertura ?? old('fecha_apertura')" required />
                            <x-input-error :messages="$errors->get('fecha_apertura')" class="mt-2" />
                        </div>

                        <!-- Nombre del Empleador -->
                        <div class="mt-4">
                            <x-input-label for="empleador" :value="__('Nombre del Empleador')" />
                            <x-text-input id="empleador" class="block mt-1 w-full" type="text" name="empleador" :value="$cliente->empleador ?? old('empleador')" required />
                            <x-input-error :messages="$errors->get('empleador')" class="mt-2" />
                        </div>

                        <!-- Ingresos Mensuales -->
                        <div class="mt-4">
                            <x-input-label for="ingresos" :value="__('Ingresos Mensuales')" />
                            <x-text-input id="ingresos" class="block mt-1 w-full" type="number" name="ingresos" :value="$cliente->ingresos ?? old('ingresos')" required />
                            <x-input-error :messages="$errors->get('ingresos')" class="mt-2" />
                        </div>

                        <!-- Autorización de Datos -->
                        <div class="mt-4">
                            <label for="autorizacion_datos" class="inline-flex items-center">
                                <input id="autorizacion_datos" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="autorizacion_datos" value="1" {{ $cliente->autorizacion_datos ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Autorizo el manejo de mis datos personales y financieros.') }}</span>
                            </label>
                        </div>

                        <!-- Consentimiento de Comunicaciones -->
                        <div class="mt-4">
                            <label for="consentimiento_comunicaciones" class="inline-flex items-center">
                                <input id="consentimiento_comunicaciones" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="consentimiento_comunicaciones" value="1" {{ $cliente->consentimiento_comunicaciones ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Acepto recibir comunicaciones y notificaciones.') }}</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-3">
                                {{ __('Actualizar Cliente') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


