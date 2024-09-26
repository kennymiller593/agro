<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<div class="bg-no-repeat bg-cover bg-center relative"
   
style="background-image:  url('{{ asset('empresa/portada2.jpg') }}');">
   
<img src="" alt="">
<div class="absolute bg-gradient-to-b from-yellow-500 to-yellow-400 opacity-40 inset-0 z-0"></div>
    <div class="min-h-screen sm:flex sm:flex-row mx-0 justify-center">
        <div class="flex-col flex  self-center p-10 sm:max-w-5xl xl:max-w-2xl  z-10">
            <div class="self-start hidden lg:flex flex-col  text-white">
                <img src="" class="mb-3">
                <h1 class="mb-3 font-bold text-5xl">Bienvenido {{ $empresa->nombre_comercial }} </h1>
                <h4>Estamos contentos de que formes parte de la familia InkaTec.</h4>
            </div>
        </div>
        <div class="flex justify-center self-center  z-10">
            <div class="p-12 bg-white mx-auto rounded-2xl w-100 ">
                <div class="mb-4">
                    <h3 class="font-semibold text-2xl text-gray-800">Login </h3>
                    <p class="text-gray-500">Ingresa con tu cuenta.</p>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="space-y-5">
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700 tracking-wide">Usuario</label>
                            <input
                                class=" w-full text-base px-4 py-2 border  border-gray-300 rounded-lg focus:outline-none focus:border-green-400"
                                type="text" placeholder="tu usuario" value="agrovet" id="username" name="username">
                            @error('username')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-500"><span
                                        class="font-medium">Oops!</span>
                                    {{ $message }}</p>
                            @enderror

                        </div>
                        <div class="space-y-2">
                            <label class="mb-5 text-sm font-medium text-gray-700 tracking-wide">
                                Contraseña
                            </label>
                            <input id="password" name="password"
                                class="w-full content-center text-base px-4 py-2 border  border-gray-300 rounded-lg focus:outline-none focus:border-green-400"
                                type="password" placeholder="**********">
                            @error('password')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-500"><span
                                        class="font-medium">Oops!</span>
                                    {{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <button type="submit"
                                class="w-full flex justify-center bg-green-400  hover:bg-green-500 text-gray-100 p-3  rounded-md tracking-wide font-semibold  shadow-lg cursor-pointer transition ease-in duration-500">
                                Ingresar
                            </button>
                        </div>
                    </div>
                </form>
                <div class="pt-5 text-center text-gray-400 text-xs">
                    <span>
                        Copyright © 2023-2028
                        <a href="https://codepen.io/uidesignhub" rel="" target="_blank" title="Ajimon"
                            class="text-green hover:text-green-500 ">InkaTec</a></span>
                </div>
            </div>
        </div>
    </div>
</div>
