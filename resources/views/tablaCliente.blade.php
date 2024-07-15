
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Listado de Clientes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900 dark:text-gray-100">


                    <style>
                        .row {
                            display: flex;
                            justify-content: space-between;
                            margin-bottom: 20px; /* Ajusta el margen inferior según necesites */
                        }
                        .column {
                            flex: 1;
                            margin-right: 10px; /* Espacio entre columnas */
                        }
                    </style>
                    <div class="row">
                        <div class="column">
                            <x-input-label for="nombre" :value="__('Nombre :')" />
                            <x-text-input class="block mt-1 w-full" type="text" id="inputSearchName" onkeypress='return event.charCode >= 69 && event.charCode <= 90 ||  event.charCode >= 97 && event.charCode <= 122' onkeyup="searchTableName(0)" />
                            <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                        </div>

                        <div class="column">
                            <x-input-label for="identificación" :value="__('Identificación :')" />
                            <x-text-input class="block mt-1 w-full" type="text" id="inputSearchIde" onkeypress='return event.charCode >= 48 && event.charCode <= 57' onkeyup="searchTableCount(1)" />
                            <x-input-error :messages="$errors->get('identificación')" class="mt-2" />
                        </div>

                        <div class="column">
                            <x-input-label for="year" :value="__('Año de apertura :')" />
                            <x-text-input class="block mt-1 w-full" type="text" id="inputSearchYear" onkeypress='return event.charCode >= 48 && event.charCode <= 57' onkeyup="searchTableYear(2)" />
                            <x-input-error :messages="$errors->get('year')" class="mt-2" />
                        </div>
                    </div>


                    <table id='tablaClientes' class="table-auto w-full mt-6 bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg">
                        <thead>
                        <tr>
{{--                            <th class="px-4 py-2">ID</th>--}}
                            <th class="px-4 py-2">Nombre</th>
                            <th class="px-4 py-2">Identificación</th>
                            <th class="px-4 py-2">Fecha de Apertura</th>
                            <th class="px-4 py-2">Saldo</th>
                            <th class="px-4 py-2">Teléfono</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Ver</th>
                            <th class="px-4 py-2">Pdf</th>
                            <th class="px-4 py-2">Editar</th>
                            <th class="px-4 py-2">Eliminar</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($clientes as $cliente)


{{--                                <tr data-cliente-id="{{ $cliente->id }}" class="detalle-cliente">--}}
{{--                                <td class="border px-4 py-2">{{ $cliente->id }}</td>--}}
                                <td class="border px-4 py-2">{{ $cliente->nombre }}</td>
                                <td class="border px-4 py-2">{{ $cliente->identificacion }}</td>
                                <td class="border px-4 py-2">{{ $cliente->fecha_apertura }}</td>
                                <td class="border px-4 py-2">{{ $cliente->saldo }}</td>
                                <td class="border px-4 py-2">{{ $cliente->telefono }}</td>
                                <td class="border px-4 py-2">{{ $cliente->email }}</td>
                                <td>
                                    <button type="button" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" onclick="showClientDetails({{ json_encode($cliente) }})">Ver</button>
                                </td>
<td>
    <a href="{{ route('pdfHistorial', $cliente->identificacion ) }}" class="btn btn-primary" style="background-color: blue; color: white; font-weight: bold; padding: 0.5rem 1rem; border: none; border-radius: 0.25rem; text-decoration: none;">Pdf</a>
</td>
                                <td>
                                    <a href="{{ route('tablaCliente.editar', $cliente->id) }}" class="btn btn-primary" style="background-color: blue; color: white; font-weight: bold; padding: 0.5rem 1rem; border: none; border-radius: 0.25rem; text-decoration: none;">Editar</a>
                                </td>
                                <td>
                                    <form id="delete-form-{{ $cliente->id }}" action="{{ route('tablaCliente.eliminarCliente', $cliente->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger" style="background-color: red; color: white; font-weight: bold; padding: 0.5rem 1rem; border: none; border-radius: 0.25rem;" onclick="confirmDelete({{ $cliente->id }})">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>




                </div>
            </div>
        </div>
    </div>
</x-app-layout>
