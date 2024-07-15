<x-app-layout>

    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('¿Quiénes somos?') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center mb-6">
                        <img src="tu-foto.jpg" alt="David Berumen Loano" >

                        <div>
                            <h3 class="text-2xl font-bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;David Berumen Loano</h3>
                            <p class="text-sm">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ingeniero en Sistemas Computacionales</p>
                            <p class="mt-2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Teléfono: 437-100-2636</p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Correo: <a href="mailto:david.berumen.lozano@gmail.com" class="text-blue-500">david.berumen.lozano@gmail.com</a></p>
                            <a href="Curriculum_David_Berumen_Lozano.pdf" class="mt-4 inline-block bg-red-500 text-red-600 py-2 px-4 rounded">Descargar CV</a>
                        </div>
                    </div>

                    <p>El propósito de este proyecto es demostrar a mis posibles empleadores mi dominio del framework Laravel y mi capacidad para utilizar las diversas herramientas y tecnologías necesarias para trabajar eficazmente en este entorno. A través de este proyecto, busco evidenciar no solo mis habilidades técnicas, sino también mi capacidad para diseñar y desarrollar soluciones completas y funcionales.</p>

                 

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
