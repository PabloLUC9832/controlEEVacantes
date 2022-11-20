<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrar Docente</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Registrar nuevo docente</h3>
                    <p class="mt-1 text-sm text-gray-600">Por favor ingresa los datos solicitados.</p><br>
                    <p><b>Recuerda que los datos obligatiorios son:</b></p>
                    <li>Número de personal</li>
                    <li>Nombre</li>
                    <li>Apellido Paterno</li>
                    <li>Apellido Materno</li>
                </div>
            </div>
            <div class="mt-5 md:col-span-2 md:mt-0 md:mr-5">

                <form action="" method="POST">
                    <div class="overflow-hidden shadow sm:rounded-md">
                        <div class="bg-white px-4 py-5 sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                @csrf

                                <div class="col-span-6">
                                    <label for="nPersonal" class="labelForms">Número de personal</label>
                                    <input type="number" name="nPersonal" id="nPersonal" class="inputForms"
                                           placeholder="Ej. 1523" required>
                                </div>

                                <div class="col-span-6">
                                    <label for="nombre" class="labelForms">Nombre del docente</label>
                                    <input type="text" name="nombre" id="nombre" class="inputForms"
                                           placeholder="Ej. Jose Arturo" required>
                                </div>

                                <div class="col-span-6">
                                    <label for="apellidoPaterno" class="labelForms">Apellido paterno del docente</label>
                                    <input type="text" name="apellidoPaterno" id="apellidoPaterno" class="inputForms"
                                           placeholder="Ej. Perez" required>
                                </div>

                                <div class="col-span-6">
                                    <label for="apellidoMaterno" class="labelForms">Apellido materno del docente</label>
                                    <input type="text" name="apellidoMaterno" id="apellidoMaterno" class="inputForms"
                                           placeholder="Ej. López" required>
                                </div>

                                <div class="col-span-6">
                                    <label for="email" class="labelForms">Email del docente</label>
                                    <input type="email" name="email" id="email" class="inputForms"
                                           placeholder="Ej. perez1800@email.com">
                                </div>

                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                            <button type="submit" class="btnGuardar">Registar Docente</button>
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
