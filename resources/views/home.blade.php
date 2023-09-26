@extends('layout')
@section('content')
    <div class="grid w-full grid-cols-1 my-auto mt-12 mb-8 md:grid-cols-2 xl:gap-14 md:gap-5">
        <div class="flex flex-col justify-center col-span-1 text-center lg:text-start">
            <div class="flex items-center justify-center mb-4 lg:justify-normal">
                <img class="h-5"
                    src="https://raw.githubusercontent.com/Loopple/loopple-public-assets/main/motion-tailwind/img/logos/logo-1.png"
                    alt="logo">
                <h4 class="ml-2 text-sm font-bold tracking-widest text-primary uppercase">Huánuco - Amarilis - Pillco Marca
                </h4>
            </div>
            <h1 class="mb-8 text-4xl font-extrabold leading-tight lg:text-6xl text-dark-grey-900">Internet fijo en zonas sin
                cobertura</h1>
            <p class="mb-6 text-base font-normal leading-7 lg:w-3/4 text-grey-900">
                Internet fijo en tu hogar en zonas sin cobertura en el departamento de Huánuco con planes
                desde s/35 al mes. Si ha estado luchando con velocidades lentas o un pésimo servicio,
                INKANET es tu mejor opción.

            </p>
            <div class="flex flex-col items-center gap-4 lg:flex-row">
                <a href="https://wa.me/51977425905" target="_blank"
                    class="flex items-center py-4 text-sm font-bold text-white px-7 bg-green-500 hover:bg-green-600 focus:ring-4 
                    focus:ring-green-100 transition duration-300 rounded-xl">
                    WhatsApp</a>

            </div>
        </div>
        <div class="items-center justify-end hidden col-span-1 md:flex">
            <img class=" rounded-md " src="{{ asset('images/home1.jpg') }}" alt="header image">
        </div>
    </div>
    <div class="bg-white dark:bg-gray-800 px-3 md:px-4 py-12 flex flex-col justify-center items-center">

        <h1
            class="mt-8 md:mt-12 text-3xl lg:text-4xl  leading-10 text-gray-800 text-center md:w-9/12 lg:w-7/12 dark:text-white font-bold">
            Internet Fijo y Soluciones <span class="text-green-400"> Hogar & Negocios</span>
        </h1>
        <p class="mt-5 font-semibold leading-normal text-center text-gray-600 md:w-9/12 lg:w-7/12 dark:text-white">
            Internet Fijo Ilimitado para zonas sin cobertura en Huánuco

        </p>

    </div>
    <div class="grid grid-cols-3 gap-4">

        <div class="max-w-sm rounded-xl overflow-hidden text-center shadow-lg border border-green-400">
            <div class="px-6 pt-4 pb-2">
                <span class="inline-block   px-3 py-1 text-sm font-semibold "> <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class=" w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                </span>
            </div>
            <div class="px-3 py-2  ">
                <div class="font-bold text-xl mb-2 text-gray-800 font-sans">
                    Internet Hogar
                </div>
                <p class="text-gray-700 text-base">
                    Internet para tu hogar en zonas sin cobertura en Huánuco, Amrilis y PillcoMarca <span
                        class="font-bold">desde S/35 al mes</span>
                </p>
            </div>
            <div class="px-6 pt-4 pb-2">
                <a href="{{ route('internet.hogar') }}" class="inline-block  rounded-full px-3 py-1 text-sm font-semibold text-blue-700 mr-2">Leer
                    más</a>

            </div>
        </div>

        <div class="max-w-sm rounded-xl overflow-hidden text-center shadow-lg border border-green-400">
            <div class="px-6 pt-4 pb-2">
                <span class="inline-block   px-3 py-1 text-sm font-semibold ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" />
                    </svg>

                </span>
            </div>
            <div class="px-3 py-2  ">
                <div class="font-bold text-xl mb-2 text-gray-800 font-sans">
                    Internet Negocios
                </div>
                <p class="text-gray-700 text-base">
                    Internet comercial por enlace Inalámbrico ideal para empresas, colegios, hospitales, etc.
                </p>
            </div>
            <div class="px-6 pt-4 pb-2">
                <a href="{{ route('internet.negocio') }}" class="inline-block  rounded-full px-3 py-1 text-sm font-semibold text-blue-700 mr-2">Leer
                    más</a>

            </div>
        </div>

        <div class="max-w-sm rounded-xl overflow-hidden text-center shadow-lg border border-green-400">
            <div class="px-6 pt-4 pb-2">
                <span class="inline-block   px-3 py-1 text-sm font-semibold ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                    </svg>

                </span>
            </div>
            <div class="px-3 py-2  ">
                <div class="font-bold text-xl mb-2 text-gray-800 font-sans">
                    Otros servicios
                </div>
                <p class="text-gray-700 text-base">
                    Instalación de cámaras, radioenlaces, torres arriostradas, cableado estructurado y desarrollo de
                    aplicaciones web.
                </p>
            </div>
           
        </div>
    </div>
    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="mr-auto place-self-center lg:col-span-7">
                <h1
                    class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">
                    Huánuco. Servicio exclusivo de internet en zonas sin cobertura</h1>
                <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">
                    Con más de 30 repetidoras de internet instaladas en zonas sin cobertura en el departamento de
                    Huánuco, puedes tener internet para tu hogar o negocio hasta en la zona que menos lo imagines. Somos
                    la mejor opción de internet fijo para zonas sin cobertura en Huánuco, AMarilis y PillcoMarca.

                <ul>INKANET TECNOLOGÍAS Y TELECOMUNICACIONES S.A.C.</ul>
                <ul>RUC: 20608731653</ul>
                </p>
                <a href="#"
                    class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900">
                    Get started
                    <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
                <a href="#"
                    class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                    Necesito información
                </a>
            </div>
            <div class="hidden lg:mt-0 lg:col-span-5 lg:flex rounded-lg">
                <img src="{{ asset('images/img1.png') }}" alt="mockup" class="rounded-lg ">
            </div>
        </div>
    </section>
    <div class="bg-white dark:bg-gray-800 px-3 md:px-4 py-12 flex flex-col justify-center items-center">

        <h1
            class="mt-8 md:mt-12 text-3xl lg:text-4xl  leading-10 text-gray-800 text-center md:w-9/12 lg:w-7/12 dark:text-white font-bold">
            Nuestros clientes nos <span class="text-green-400">respaldan</span>
        </h1>


    </div>
    <div class="grid grid-cols-3 gap-4">
        <div class="px-10">
            <div class="bg-white max-w-xl rounded-2xl px-10 py-8 shadow-lg hover:shadow-2xl transition duration-500">
                <div class="w-14 h-14 bg-yellow-500 rounded-full flex items-center justify-center font-bold text-white">
                    LOGO</div>
                <div class="mt-4">
                    <h1 class="text-lg text-gray-700 font-semibold hover:underline cursor-pointer">Cliente top</h1>
                    <div class="flex mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                    </div>
                    <p class="mt-4 text-md text-gray-600">Llame a varios operadores y ninguno tenia servicio de internet
                        por mi domicilio hasta que vi un anuncio de INKANET y no lo dudé, me comuniqué e inmediatamente
                        procedieron
                        hacer la instalación. ya 2 años con el servicio y no me quejo. Se los recomiendo </p>
                    <div class="flex justify-between items-center">
                        <div class="mt-4 flex items-center space-x-4 py-6">
                            <div class="">
                                <img class="w-12 h-12 rounded-full"
                                    src="https://images.unsplash.com/photo-1593104547489-5cfb3839a3b5?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1036&q=80"
                                    alt="" />
                            </div>
                            <div class="text-sm font-semibold">Thalia Sánchez • <span class="font-normal"> hace 20
                                    días</span></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="px-10">
            <div class="bg-white max-w-xl rounded-2xl px-10 py-8 shadow-lg hover:shadow-2xl transition duration-500">
                <div class="w-14 h-14 bg-yellow-500 rounded-full flex items-center justify-center font-bold text-white">
                    LOGO</div>
                <div class="mt-4">
                    <h1 class="text-lg text-gray-700 font-semibold hover:underline cursor-pointer">Cliente top</h1>
                    <div class="flex mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                    </div>
                    <p class="mt-4 text-md text-gray-600">Anteriormente tenia contratado otro proveedor de internet
                        y nunca respondian para los soportes, ahora me cambié a INKANET y todo fluye bien. no me arrepiento
                        de haberles elegido, ahora mis hijos pueden hacer sus tareas universitarios con normalidad.
                    </p>
                    <div class="flex justify-between items-center">
                        <div class="mt-4 flex items-center space-x-4 py-6">
                            <div class="">
                                <img class="w-12 h-12 rounded-full"
                                    src="https://images.unsplash.com/photo-1593104547489-5cfb3839a3b5?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1036&q=80"
                                    alt="" />
                            </div>
                            <div class="text-sm font-semibold">John Piero • <span class="font-normal"> hace 1 mes</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="px-10">
            <div class="bg-white max-w-xl rounded-2xl px-10 py-8 shadow-lg hover:shadow-2xl transition duration-500">
                <div class="w-14 h-14 bg-yellow-500 rounded-full flex items-center justify-center font-bold text-white">
                    LOGO</div>
                <div class="mt-4">
                    <h1 class="text-lg text-gray-700 font-semibold hover:underline cursor-pointer">Cliente top</h1>
                    <div class="flex mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                    </div>
                    <p class="mt-4 text-md text-gray-600">Soy directora de un colegio, Me encontraba en busca de INTERNET
                        para mi institución y todos
                        me ofrecian precios muy elevados, hasta que una profesora me recomendó INKANET. La instalacion lo
                        hicieron muy rapido
                        y tambien contraté la instalacion de camaras, un servicio 10 de 10
                    </p>
                    <div class="flex justify-between items-center">
                        <div class="mt-4 flex items-center space-x-4 py-6">
                            <div class="">
                                <img class="w-12 h-12 rounded-full"
                                    src="https://images.unsplash.com/photo-1593104547489-5cfb3839a3b5?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1036&q=80"
                                    alt="" />
                            </div>
                            <div class="text-sm font-semibold">Marisol EF • <span class="font-normal"> hace 1 hora</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
