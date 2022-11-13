<!-- Main modal -->
<div id="edit-modal{{$vacante->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="edit-modal{{$vacante->id}}">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Close modal</span>
            </button>

            <div class="py-6 px-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Edición de vacante de la EE {{$vacante->nombreMateria}}</h3>
                <form class="space-y-6" action="{{''}}" method="POST">
                    @csrf

                    <div>
                        <label for="periodo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Periodo</label>
                        <input type="text" name="periodo" id="periodo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required value="{{$vacante->periodo}}">
                    </div>

                    <div>
                        <label for="numZona" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Número de zona</label>
                        <input type="number" name="numZona" id="numZona" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="{{$vacante->numZona}}" readonly="readonly">
                    </div>

                    <div>
                        <label for="numDependencia" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Número de dependencia</label>
                        <input type="number" name="numDependencia" id="numDependencia" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="{{$vacante->numDependencia}}" readonly="readonly">
                    </div>

                    <div>
                        <label for="numArea" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Número de área</label>
                        <input type="number" name="numArea" id="numArea" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="{{$vacante->numArea}}" readonly="readonly">
                    </div>

                    <div>
                        <label for="numPrograma" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Programa</label>
                        <select  id="numPrograma" name="numPrograma" class="estiloSelect">
                            <option value="">{{$vacante->numPrograma}}</option>
{{--
                            @foreach ($programas as $data)
                                <option value="{{$data->clave}}">
                                    {{$data->clave}} {{$data->nombre}}
                                </option>
                            @endforeach
--}}
                        </select>
                    </div>

                    <div>
                        <label for="numPlaza" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Plaza</label>
                        <input type="number" name="numPlaza" id="numPlaza" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required value="{{$vacante->numPlaza}}">
                    </div>

                    <div>
                        <label for="numHoras" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Horas</label>
                        <input type="number" name="numHoras" id="numHoras" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required value="{{$vacante->numHoras}}">
                    </div>

                    <div>
                        <label for="numMateria" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Número de materia</label>
                        <input type="number" name="numMateria" id="numMateria" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required value="{{$vacante->numMateria}}">
                    </div>

                    <div>
                        <label for="nombreMateria" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nombre de la materia</label>
                        <input type="text" name="nombreMateria" id="nombreMateria" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required value="{{$vacante->nombreMateria}}">
                    </div>

                    <div>
                        <label for="grupo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Grupo</label>
                        <input type="text" name="grupo" id="grupo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required value="{{$vacante->grupo}}">
                    </div>

                    <div>
                        <label for="numMotivo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Motivo</label>
                        <select  id="numMotivo" name="numMotivo" class="estiloSelect">
                            <option value="">Selecciona el motivo</option>
{{--                            @foreach ($motivos as $data)
                                <option value="{{$data->numeroMotivo}}">
                                    {{$data->numeroMotivo}} {{$data->nombre}}
                                </option>
                            @endforeach--}}
                        </select>
                    </div>

                    <div>
                        <label for="tipoAsignacion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tipo de asignación</label>
                        <input type="text" name="tipoAsignacion" id="tipoAsignacion" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required value="{{$vacante->tipoAsignacion}}">
                    </div>

                    <div>
                        <label for="numPersonalDocente" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Número personal del docente</label>
                        <input type="number" name="numPersonalDocente" id="numPersonalDocente" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required value="{{$vacante->numPersonalDocente}}">
                    </div>

                    <div>
                        <label for="plan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Plan</label>
                        <input type="number" name="plan" id="plan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required value="{{$vacante->plan}}">
                    </div>

                    <div>
                        <label for="observaciones" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Observaciones</label>
                        <div class="mt-1">
                                        <textarea id="observaciones" name="observaciones" rows="3"
                                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                  placeholder="Ej. Alguna observación">{{$vacante->observaciones}}</textarea>
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

                    <div>
                        <label for="bancoHorasDisponible" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Banco de horas disponible</label>
                        <input type="number" name="bancoHorasDisponible" id="bancoHorasDisponible" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required value="{{$vacante->bancoHorasDisponible}}">
                    </div>


                    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-5">Editar vacante </button>

                </form>
            </div>
        </div>
    </div>
</div>
