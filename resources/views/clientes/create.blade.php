@extends('admin-layout')
@section('content')
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
        crossorigin="anonymous"></script>
    @if (Session::has('primerFormularioCompletado'))
        <div id="content" class="bg-white/10 col-span-9 rounded-lg p-6">
            <div class="w-full ">
                <div class="bg-white shadow-md rounded pt-2 pl-2 pr-2 ">
                    <div class="mx-auto max-w-2xl text-center">

                        <p class="mt-2 text-lg leading-8 text-gray-600">Datos de conexión</p>
                    </div>
                    <form action="{{ route('clientes.saveInst') }} " method="post">
                        @csrf

                        <input type="hidden" name="cliente_id" id="cliente_id" value="{{ Session::get('cliente_id') }}">
                        <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                            <div class="col-sm-4">

                                <div class="form-group">
                                    <label>Zona cliente</label>
                                    <select
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        id="zona_id" name="zona_id">
                                        @foreach ($zonas as $zona)
                                            <option value="{{ $zona->id }}">{{ $zona->nombre }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Router cliente</label>
                                    <select
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        id="router_id" name="router_id">
                                        @foreach ($zonas as $zona)
                                            <option value="{{ $zona->id }}">{{ $zona->nombre }} </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Plan</label>
                                    <select
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        id="plan_id" name="plan_id">
                                        @foreach ($planes as $plan)
                                            <option value="{{ $plan->id }}">{{ $plan->nombre }} - s/{{ $plan->precio }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>IP</label>
                                    <input type="text" id="ip" name="ip" value="{{ old('ip') }}"
                                        class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-blue-500 ring-1 ring-inset ring-blue-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-400 sm:text-sm sm:leading-6"
                                        placeholder="10.10.5.143">
                                    @error('ip')
                                        <p
                                            class="w-full mb-2 select-none border-l-4 border-yellow-400 bg-yellow-100 p-4 font-medium hover:border-yellow-500">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Fecha de instalación</label>
                                    <input type="date" id="fecha_inst" name="fecha_inst" value="{{ old('fecha_inst') }}"
                                        class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-blue-500 ring-1 ring-inset ring-blue-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-400 sm:text-sm sm:leading-6"
                                        placeholder="Enter ...">
                                    @error('fecha_inst')
                                        <p
                                            class="w-full mb-2 select-none border-l-4 border-yellow-400 bg-yellow-100 p-4 font-medium hover:border-yellow-500">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Día de cobro</label>
                                    <input type="number" id="dia_cobro" name="dia_cobro" value="{{ old('dia_cobro') }}"
                                        class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-blue-500 ring-1 ring-inset ring-blue-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-400 sm:text-sm sm:leading-6"
                                        placeholder="Enter ...">
                                    @error('dia_cobro')
                                        <p
                                            class="w-full mb-2 select-none border-l-4 border-yellow-400 bg-yellow-100 p-4 font-medium hover:border-yellow-500">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Url de google maps</label>
                                    <input type="text" id="url_maps" name="url_maps" value="{{ old('url_maps') }}"
                                        class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-blue-500 ring-1 ring-inset ring-blue-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-400 sm:text-sm sm:leading-6"
                                        placeholder="google.com">
                                    @error('url_maps')
                                        <p
                                            class="w-full mb-2 select-none border-l-4 border-yellow-400 bg-yellow-100 p-4 font-medium hover:border-yellow-500">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Distrito</label>
                                    <input type="text" id="distrito" name="distrito" value="{{ old('distrito') }}"
                                        class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-blue-500 ring-1 ring-inset ring-blue-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-400 sm:text-sm sm:leading-6"
                                        placeholder="Enter ...">
                                    @error('distrito')
                                        <p
                                            class="w-full mb-2 select-none border-l-4 border-yellow-400 bg-yellow-100 p-4 font-medium hover:border-yellow-500">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label>Referencia</label>
                                    <textarea value="{{ old('direccion') }}"
                                        class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-blue-500 ring-1 ring-inset ring-blue-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-400 sm:text-sm sm:leading-6"
                                        id="direccion" name="direccion" rows="3" placeholder="Enter ..."></textarea>
                                    @error('direccion')
                                        <p
                                            class="w-full mb-2 select-none border-l-4 border-yellow-400 bg-yellow-100 p-4 font-medium hover:border-yellow-500">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Otros</label>
                                    <textarea value="{{ old('descripcion') }}"
                                        class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-blue-500 ring-1 ring-inset ring-blue-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-400 sm:text-sm sm:leading-6"
                                        id="descripcion" name="descripcion" rows="3" placeholder="Enter ..."></textarea>
                                    @error('descripcion')
                                        <p
                                            class="w-full mb-2 select-none border-l-4 border-yellow-400 bg-yellow-100 p-4 font-medium hover:border-yellow-500">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <br>
                        <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                            <div>
                                <button type="submit"
                                    class=" bg-green-400 h-max w-max rounded-lg text-white font-bold hover:bg-green-300 ">
                                    <div class="flex items-center justify-center m-[10px]">
                                        Terminar
                                    </div>
                                </button>
                            </div>
                        </div>
                        <br>
                    </form>

                </div>
            </div>
        </div>
    @else
        <div id="content" class="bg-white/10 col-span-9 rounded-lg p-6">
            <div class="w-full ">
                <div class="bg-white shadow-md rounded pt-2 pl-2 pr-2 ">


                    <div class="mx-auto max-w-2xl text-center">

                        <p class="mt-2 text-lg leading-8 text-gray-600">Datos del cliente</p>
                    </div>


                    <!-- Resto de tu formulario -->
                    <form action="{{ route('clientes.save') }} " class="mx-auto mt-16 max-w-xl sm:mt-20" method="post">
                        @csrf
                        <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                            <div>
                                <label for="first-name" class="block text-sm font-semibold leading-6 text-black">
                                    DNI</label>
                                <div class="mt-2.5">
                                    <input type="text" id="dni" name="dni" value="{{ old('dni') }}"
                                        class=" block w-full rounded-md border-0 px-3.5 py-2  shadow-sm shadow-blue-500 ring-1 ring-inset
                                         ring-blue-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-400 sm:text-sm sm:leading-6">
                                    @error('dni')
                                        <div
                                            class="w-full mb-2 select-none border-l-4 border-yellow-400 bg-yellow-100 p-4 font-medium hover:border-yellow-500">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <label for="first-name" class="block text-sm font-semibold leading-6 text-black">
                                    Buscar</label>
                                <button type="button" id="button-search-dni"
                                    class=" bg-indigo-400 h-max w-max rounded-lg text-white font-bold hover:bg-indigo-300 ">
                                    <div class="flex items-center justify-center m-[10px]">
                                        RENIEC
                                    </div>
                                </button>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                            <div>
                                <label for="first-name" class="block text-sm font-semibold leading-6 text-black">
                                    Nombres</label>
                                <div class="mt-2.5">
                                    <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}"
                                        class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-blue-500 ring-1 ring-inset ring-blue-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-400 sm:text-sm sm:leading-6">
                                    @error('nombre')
                                        <div
                                            class="w-full mb-2 select-none border-l-4 border-yellow-400 bg-yellow-100 p-4 font-medium hover:border-yellow-500">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <label for="last-name" class="block text-sm font-semibold leading-6 text-black">
                                    Apellidos</label>
                                <div class="mt-2.5">
                                    <input type="text" name="apellidos" id="apellidos"
                                        value="{{ old('apellidos') }}"
                                        class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset shadow-blue-500 ring-blue-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-400 sm:text-sm sm:leading-6">
                                    @error('apellidos')
                                        <div
                                            class="w-full mb-2 select-none border-l-4 border-yellow-400 bg-yellow-100 p-4 font-medium hover:border-yellow-500">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                            <div>
                                <label for="first-name" class="block text-sm font-semibold leading-6 text-black">
                                    Celular</label>
                                <div class="mt-2.5">
                                    <input type="text" name="celular" id="celular" value="{{ old('celular') }}"
                                        class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-blue-500 ring-1 ring-inset ring-blue-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-400 sm:text-sm sm:leading-6">
                                    @error('celular')
                                        <p
                                            class="w-full mb-2 select-none border-l-4 border-yellow-400 bg-yellow-100 p-4 font-medium hover:border-yellow-500">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <br>
                        <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                            <div>
                                <button type="submit"
                                    class=" bg-green-400 h-max w-max rounded-lg text-white font-bold hover:bg-green-300 ">
                                    <div class="flex items-center justify-center m-[10px]">
                                        Siguiente
                                    </div>
                                </button>
                            </div>
                        </div>
                        <br>

                    </form>

                </div>
            </div>
        </div>
    @endif


    <!-- Bootstrap 4 -->

    <script>
        document.getElementById('button-search-dni').addEventListener('click', function() {
            // Obtener los datos del formulario
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            var formData = new FormData();
            var dni = $('#dni').val();
            formData.append('_token', csrfToken);
            formData.append('dni', dni);
            fetch("/consulta-dni", {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Hubo un problema al buscar dni.');
                    }
                    return response.json();
                })
                .then(data => {
                    // Aquí puedes manejar la respuesta del servidor, si es necesario
                    if (data.tipoDocumento == 1) {
                        var nombre = data.nombres;
                        var apellidos = data.apellidoPaterno + ' ' + data.apellidoMaterno;
                        var dni = data.numeroDocumento;
                        document.getElementById('nombre').value = nombre;
                        document.getElementById('apellidos').value = apellidos;
                        document.getElementById('dni').value = dni;
                    } else if (data.tipoDocumento == 6) {
                        var nombre = data.razonSocial;
                        var apellidos = data.condicion;
                        var dni = data.numeroDocumento;
                        document.getElementById('nombre').value = nombre;
                        document.getElementById('apellidos').value = apellidos;
                        document.getElementById('dni').value = dni;
                    }

                })
                .catch(error => {
                    console.error('Error al buscar dni:', error);
                });
        });
    </script>
@endsection
