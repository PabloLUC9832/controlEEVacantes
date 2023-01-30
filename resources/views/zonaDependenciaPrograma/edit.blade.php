<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Actualizar Programa Educativo</title>
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
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Actualizar programa educativo</h3>
                    <p class="mt-1 text-sm text-gray-600">Por favor ingresa los datos solicitados.</p><br>
                    <p><b>Recuerda que los datos obligatiorios son:</b></p>
                    <li>Id de la zona</li>
                    <li>Nombre de la zona</li>
                    <li>Clave de la dependencia</li>
                    <li>Nombre de la dependencia</li>
                    <li>Clave del programa educativo</li>
                    <li>Nombre del programa educativo</li>
                </div>
            </div>
            <div class="mt-5 md:col-span-2 md:mt-0 md:mr-5">

                <form action="{{ route('zonaDependenciaPrograma.update',$programa->id) }}" method="POST" enctype="multipart/form-data">
                    <div class="overflow-hidden shadow sm:rounded-md">
                        <div class="bg-white px-4 py-5 sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                @csrf

                                @include('zonaDependenciaPrograma.selectZonaDependenciaEdit')

                                <div class="col-span-6">
                                    <label for="clavePrograma" class="labelForms">Clave del programa educativo</label>
                                    <input type="number" name="clavePrograma" id="clavePrograma" class="inputForms"
                                           value="{{$programa->clave_programa}}">
                                </div>

                                <div class="col-span-6">
                                    <label for="nombrePrograma" class="labelForms">Nombre del programa educativo</label>
                                    <input type="text" name="nombrePrograma" id="nombrePrograma" class="inputForms"
                                           value="{{$programa->nombre_programa}}"
                                           >
                                </div>

                                <div class="col-span-6">
                                    <label for="horasIniciales" class="labelForms">Horas Iniciales</label>
                                    <input type="number" name="horasIniciales" id="horasIniciales" class="inputForms"
                                           value="{{$programa->horasIniciales}}" >
                                </div>

                                <div class="col-span-6">
                                    <label for="horasUtilizadas" class="labelForms">Horas Utilizadas</label>
                                    <input type="number" name="horasUtilizadas" id="horasUtilizadas" class="inputForms"
                                           value="{{$programa->horasUtilizadas}}" >
                                </div>

                                <div class="col-span-6">
                                    <label for="horasDisponibles" class="labelForms">Horas Disponibles</label>
                                    <input type="number" name="horasDisponibles" id="horasDisponibles" class="inputForms"
                                           value="{{$programa->horasDisponibles}}" >
                                </div>

                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                            <button type="submit" class="btnGuardar">Actualizar Programa Educativo</button>
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
