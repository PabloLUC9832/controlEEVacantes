<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrar EE Vacante</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite('node_modules/flowbite/dist/flowbite.js')
    @vite('node_modules/flowbite/dist/datepicker.js')
    @livewireStyles
</head>
<body>

    <div class="fondo">
        <!--Menu-->
        @livewire('navigation-menu')

        <div class="hidden sm:block" aria-hidden="true">
            <div class="py-5">
            </div>
        </div>

        <div class="mt-10 sm:mt-0">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-5">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Registrar nueva Experiencia Educativa Vacante</h3>
                        <p class="mt-1 text-sm text-gray-600">Por favor ingresa los datos solicitados.</p><br>
                        <p><b>Recuerda que los datos obligatiorios son:</b></p>
                        <li>Periodo</li>
                        <li>Número de zona</li>
                        <li>Número de dependencia</li>
                        <li>Número de área</li>
                        <li>Número de programa</li>
                        <li>Número de plaza</li>
                        <li>Número de horas</li>
                        <li>Número de materia</li>
                        <li>Nombre de materia</li>
                        <li>Grupo</li>
                        <li>Motivo</li>
                    </div>
                </div>
                <div class="mt-5 md:col-span-2 md:mt-0 md:mr-5">

                    <form action="{{ route('vacante.store') }}" method="POST">
                        <div class="overflow-hidden shadow sm:rounded-md">
                            <div class="bg-white px-4 py-5 sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    @csrf
                                    <div class="col-span-6">
                                        <label for="periodo" class="labelForms">Periodo</label>
                                        <input type="text" name="periodo" id="periodo" class="inputForms"
                                               placeholder="Ej. 01 AGO. 2022 AL 31 ENE. 2023" required>
                                    </div>

                                    <div class="col-span-6">
                                        <label for="numZona" class="labelForms">Número de zona</label>
                                        <input type="number" name="numZona" id="numZona" class="inputForms"
                                                 value="{{$user->zona}}" readonly="readonly">
                                    </div>

                                    <div class="col-span-6">
                                        <label for="numDependencia" class="labelForms">Número de dependencia</label>
                                        <input type="number" name="numDependencia" id="numDependencia"
                                               class="inputForms" value="{{$user->dependencia}}" readonly="readonly">
                                    </div>

                                    <div class="col-span-6">
                                        <label for="numArea" class="labelForms">Número de área</label>
                                        <input type="text" name="numArea" id="numArea" class="inputForms" disabled
                                               value="3 ECONOMICO ADMINISTRATIVA">
                                    </div>

                                    <div class="col-span-6">
                                        <label for="numPrograma" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Programa</label>
                                        <select  id="numPrograma" name="numPrograma" class="estiloSelect">
                                            <option value="">Selecciona el programa</option>
                                            @foreach ($programas as $data)
                                                <option value="{{$data->clave}}">
                                                    {{$data->clave}} {{$data->nombre}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-span-6">
                                        <label for="numPlaza" class="labelForms">Número de plaza</label>
                                        <input type="number" name="numPlaza" id="numPlaza" class="inputForms"
                                               placeholder="Ej. 1523" required>
                                    </div>

                                    <div class="col-span-6">
                                        <label for="numHoras" class="labelForms">Número de horas</label>
                                        <input type="number" name="numHoras" id="numHoras" class="inputForms"
                                               placeholder="Ej. 6" required>
                                    </div>

                                    <div class="col-span-6">
                                        <label for="numMateria" class="labelForms">Número de materia</label>
                                        <input type="number" name="numMateria" id="numMateria" class="inputForms"
                                               placeholder="Ej. 28375" required>
                                    </div>

                                    <div class="col-span-6">
                                        <label for="nombreMateria" class="labelForms">Nombre de la materia</label>
                                        <input type="text" name="nombreMateria" id="nombreMateria" class="inputForms"
                                               placeholder="Ej. MET. ESTAD. PARA LA INVES" required>
                                    </div>

                                    <div class="col-span-6">
                                        <label for="grupo" class="labelForms">Grupo</label>
                                        <input type="text" name="grupo" id="grupo" class="inputForms"
                                               placeholder="Ej. SEC1"
                                               required>
                                    </div>

                                    <div class="col-span-6">
                                        <label for="numMotivo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Motivo</label>
                                        <select  id="numMotivo" name="numMotivo" class="estiloSelect">
                                            <option value="">Selecciona el motivo</option>
                                            @foreach ($motivos as $data)
                                                <option value="{{$data->numeroMotivo}}">
                                                    {{$data->numeroMotivo}} {{$data->nombre}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-span-6">
                                        <label for="tipoAsignacion" class="labelForms">Tipo de asignación</label>
                                        <input type="text" name="tipoAsignacion" id="tipoAsignacion" class="inputForms"
                                               placeholder="Ej. ">
                                    </div>

                                    <div class="col-span-6">
                                        <label for="numPersonalDocente" class="labelForms">Número personal del
                                            docente</label>
                                        <input type="number" name="numPersonalDocente" id="numPersonalDocente"
                                               class="inputForms" placeholder="Ej. ">
                                    </div>

                                    <div class="col-span-6">
                                        <label for="plan" class="labelForms">Plan</label>
                                        <input type="number" name="plan" id="plan" class="inputForms" placeholder="Ej. ">
                                    </div>

                                    <div class="col-span-6">
                                        <label for="observaciones" class="labelForms">Observaciones</label>
                                        <div class="mt-1">
                                        <textarea id="observaciones" name="observaciones" rows="3"
                                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                  placeholder="Ej. Alguna observación"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                        <label for="fechaApertura" class="labelForms">Fecha de apertura</label>
                                        <div class="relative">
                                            <div
                                                class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                     fill="currentColor" viewBox="0 0 20 20"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                          d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                          clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                            <input datepicker type="text"
                                                   class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                   placeholder="Selecciona la fecha" id="fechaApertura"
                                                   name="fechaApertura">
                                        </div>
                                    </div>

                                    <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                        <label for="fechaCierre" class="labelForms">Fecha de cierre</label>
                                        <div class="relative">
                                            <div
                                                class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                     fill="currentColor" viewBox="0 0 20 20"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                          d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                          clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                            <input datepicker type="text"
                                                   class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                   placeholder="Selecciona la fecha" id="fechaCierre"
                                                   name="fechaCierre">
                                        </div>
                                    </div>

                                    <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                        <label for="fechaRenuncia" class="labelForms">Fecha de renuncia</label>
                                        <div class="relative">
                                            <div
                                                class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                     fill="currentColor" viewBox="0 0 20 20"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                          d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                          clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                            <input datepicker type="text"
                                                   class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                   placeholder="Selecciona la fecha" id="fechaRenuncia"
                                                   name="fechaRenuncia">
                                        </div>
                                    </div>

                                    <div class="col-span-6">
                                        <label for="bancoHorasDisponible" class="labelForms">Banco de horas
                                            disponible</label>
                                        <input type="number" name="bancoHorasDisponible" id="bancoHorasDisponible"
                                               class="inputForms" placeholder="Ej. ">
                                    </div>

                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                                <button type="submit" class="btnGuardar">Registar Vacante</button>
                            </div>
                        </div>
                    </form>
                </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="hidden sm:block" aria-hidden="true">
            <div class="py-5">
            </div>
        </div>

    </div>

</body>
</html>
