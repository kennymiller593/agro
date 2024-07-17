@extends('admin-layout')
@section('content')
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
        crossorigin="anonymous"></script>

    <div id="content" class="bg-white/10 col-span-9 rounded-lg p-6">
        <div class="w-full ">
            <div class="bg-white shadow-md rounded pt-2 pl-2 pr-2 ">
                <div class="mx-auto max-w-2xl text-center">

                    <p class="mt-2 text-lg leading-8 text-gray-600">Información de la Empresa</p>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('empresa.create') }} " method="post" enctype="multipart/form-data">
                    @csrf


                    <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                        <div class="col-sm-4">

                            <div class="form-group">
                                <label>Razón social</label>
                                <input type="text" id="razon_social" name="razon_social"
                                    value="{{ $empresa->razon_social ?? old('razon_social') }}"
                                    class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-blue-500 ring-1 ring-inset ring-blue-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-400 sm:text-sm sm:leading-6"
                                    placeholder="Nombre de tu empresa">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>RUC</label>
                                <input type="text" id="ruc" name="ruc" 
                                    value="{{ $empresa->ruc ?? old('ruc') }}"
                                    class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-blue-500 ring-1 ring-inset ring-blue-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-400 sm:text-sm sm:leading-6"
                                    placeholder="RUC">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Descripción</label>
                                <input type="text" id="descripcion" name="descripcion"
                                    value="{{ $empresa->descripcion ?? old('descripcion') }}"
                                    class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-blue-500 ring-1 ring-inset ring-blue-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-400 sm:text-sm sm:leading-6"
                                    placeholder="A QUE TE DEDICAS?">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Contácto</label>
                                <input type="text" id="telefono" name="telefono"
                                    value="{{ $empresa->telefono ?? old('telefono') }}"
                                    class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-blue-500 ring-1 ring-inset ring-blue-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-400 sm:text-sm sm:leading-6"
                                    placeholder="9000000">
                                @error('telefono')
                                    <p
                                        class="w-full mb-2 select-none border-l-4 border-yellow-400 bg-yellow-100 p-4 font-medium hover:border-yellow-500">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Dirección</label>
                                <input type="text" id="direccion" name="direccion"
                                    value="{{ $empresa->direccion ?? old('direccion') }}"
                                    class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-blue-500 ring-1 ring-inset ring-blue-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-400 sm:text-sm sm:leading-6"
                                    placeholder="jr. Av.">
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
                                <label>Logo</label>
                                <!-- Campo para la foto (si existe) -->
                                @if ($empresa->logo)
                                <div class="p-1 bg-white rounded-full focus:outline-none focus:ring">
                                    <img src="{{ asset('empresa/' . $empresa->logo) }}" class="inline-block shrink-0 rounded-[.95rem] w-[150px] h-[150px]"  alt="Logo de la empresa">

                                </div> 
                                @endif
                                <input type="file" id="logo" name="logo" value="{{ old('logo') }}"
                                    class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-blue-500 ring-1 ring-inset ring-blue-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-400 sm:text-sm sm:leading-6"
                                    placeholder="Enter ...">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                        <div>
                            <button type="submit"
                                class=" bg-green-400 h-max w-max rounded-lg text-white font-bold hover:bg-green-300 ">
                                <div class="flex items-center justify-center m-[10px]">
                                    Guardar
                                </div>
                            </button>
                        </div>
                    </div>
                    <br>
                </form>
                @if (session('success'))
                    <div class="flex bg-green-100 rounded-lg p-4 mb-4 text-sm text-green-700" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>
    </div>



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
