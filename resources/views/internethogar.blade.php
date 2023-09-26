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
            <h1 class="mb-8 text-4xl font-extrabold leading-tight lg:text-6xl text-dark-grey-900">Internet hogar ILIMITADO en
                zonas sin
                cobertura</h1>
            <p class="mb-6 text-base font-normal leading-7 lg:w-3/4 text-grey-900">
                Contamos con planes desde s/35 mensual, ideal para Estudiantes, docentes, y más
            </p>
            <div class="flex flex-col items-center gap-4 lg:flex-row">
                <button
                    class="flex items-center py-4 text-sm font-bold text-white px-7 bg-purple-blue-500 hover:bg-purple-blue-600 
                    focus:ring-4 focus:ring-purple-blue-100 transition duration-300 rounded-xl">
                    Ver planes</button>
                <button
                    class="flex items-center py-4 text-sm font-medium px-7 text-dark-grey-700 hover:text-dark-grey-900 transition duration-300 rounded-2xl">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 mr-2">
                        <path fill-rule="evenodd"
                            d="M1.5 4.5a3 3 0 013-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 01-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 006.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 011.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 01-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Book a free call
                </button>
            </div>
        </div>
        <div class="items-center justify-end hidden col-span-1 md:flex">
            <img class=" rounded-md " src="{{ asset('images/ho1.jpg') }}" alt="header image">
        </div>
    </div>
    <div class="bg-white dark:bg-gray-800 px-3 md:px-4 py-12 flex flex-col justify-center items-center">

        <h1
            class="mt-8 md:mt-12 text-3xl lg:text-4xl  leading-10 text-gray-800 text-center md:w-9/12 lg:w-7/12 dark:text-white font-bold">
            Principales razones para contratar <span class="text-green-400"> INKANET</span>
        </h1>
        <p class="mt-5 font-semibold leading-normal text-center text-gray-600 md:w-9/12 lg:w-7/12 dark:text-white">
            Donde crees que no hay cobertura, ahí estamos

        </p>

    </div>
    <div class="grid grid-cols-3 gap-4">

        <div class="max-w-sm rounded-xl overflow-hidden text-center shadow-lg ">
            <div class="px-6 pt-4 pb-2">
                <span class="inline-block   px-3 py-1 text-sm font-semibold ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                    </svg>

                </span>
            </div>
            <div class="px-3 py-2  ">
                <div class="font-bold text-xl mb-2 text-gray-800 font-sans">
                    Super rápido
                </div>
                <p class="text-gray-700 text-base">
                    Contamos con internet simétrico en todas nuestras repetidoras
            </div>

        </div>

        <div class="max-w-sm rounded-xl overflow-hidden text-center shadow-lg ">
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
                    Uso ilimitado
                </div>
                <p class="text-gray-700 text-base">
                    Carga y descarga todo lo que necesites sin ningún aumento en tu facturación
                </p>
            </div>

        </div>

        <div class="max-w-sm rounded-xl overflow-hidden text-center shadow-lg ">
            <div class="px-6 pt-4 pb-2">
                <span class="inline-block   px-3 py-1 text-sm font-semibold ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.666 3.888A2.25 2.25 0 0013.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 01-.75.75H9a.75.75 0 01-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 01-2.25 2.25H6.75A2.25 2.25 0 014.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 011.927-.184" />
                    </svg>


                </span>
            </div>
            <div class="px-3 py-2  ">
                <div class="font-bold text-xl mb-2 text-gray-800 font-sans">
                    Sin contratos
                </div>
                <p class="text-gray-700 text-base">
                    Esperamos que te quedes con nosotros para siempre, pero no queremos amarrarte.
                </p>
            </div>

        </div>
        <div class="max-w-sm rounded-xl overflow-hidden text-center shadow-lg ">
            <div class="px-6 pt-4 pb-2">
                <span class="inline-block   px-3 py-1 text-sm font-semibold ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                    </svg>


                </span>
            </div>
            <div class="px-3 py-2  ">
                <div class="font-bold text-xl mb-2 text-gray-800 font-sans">
                    Soporte 24/7
                </div>
                <p class="text-gray-700 text-base">
                    Nuestro equipo de soporte está listo para ayudarte en cualquier problema técnico.
                </p>
            </div>

        </div>
    </div>

    <div class="min-h-screen flex justify-center items-center">

        <div class="">
            <div class="text-center font-semibold">
                <h1 class="text-5xl">
                    <span class="text-blue-700 tracking-wide">Nuestros </span>
                    <span>Planes</span>
                </h1>

            </div>
            <div class="pt-24 flex flex-row">
                <!-- Basic Card -->
                <div class="w-96 p-8 bg-white text-center rounded-3xl pr-16 shadow-xl">
                    <h1 class="text-black font-semibold text-2xl">Plan Basico</h1>
                    <p class="pt-2 tracking-wide">
                        <span class="text-gray-400 align-top">s/ </span>
                        <span class="text-3xl font-semibold">35</span>

                    </p>
                    <hr class="mt-4 border-1">
                    <div class="pt-8">
                        <p class="font-semibold text-gray-400 text-left">
                            <span class="material-icons align-middle">
                                done
                            </span>
                            <span class="pl-2">
                                <span class="text-black">Ilimitado</span>
                            </span>
                        </p>
                        <p class="font-semibold text-gray-400 text-left pt-5">
                            <span class="material-icons align-middle">
                                done
                            </span>
                            <span class="pl-2">
                                <span class="text-black">Velocidad de 5 mbps</span>
                            </span>
                        </p>
                        <p class="font-semibold text-gray-400 text-left pt-5">
                            <span class="material-icons align-middle">
                                done
                            </span>
                            <span class="pl-2 text-black">
                                Recomendable para 2 a 3 equipos
                            </span>
                        </p>
                        <p class="font-semibold text-gray-400 text-left pt-5">
                            <span class="material-icons align-middle">
                                done
                            </span>
                            <span class="pl-2 text-black">
                                Soporte 12/7
                            </span>
                        </p>
                        <a href="#" class="">
                            <p class="w-full py-4 bg-green-500 mt-8 rounded-xl text-white">
                                <span class="font-medium">
                                    Lo quiero
                                </span>
                                <span class="pl-2 material-icons align-middle text-sm">
                                    east
                                </span>
                            </p>
                        </a>
                    </div>
                </div>
                <!-- StartUp Card -->
                <div
                    class="w-80 p-8 bg-gray-900 text-center rounded-3xl text-white border-4 shadow-xl border-white transform scale-125">
                    <h1 class="text-white font-semibold text-2xl">Plan Universitario</h1>
                    <p class="pt-2 tracking-wide">
                        <span class="text-gray-400 align-top">s/ </span>
                        <span class="text-3xl font-semibold">50</span>

                    </p>
                    <hr class="mt-4 border-1 border-gray-600">
                    <div class="pt-8">
                        <p class="font-semibold text-gray-400 text-left">
                            <span class="material-icons align-middle">
                                done
                            </span>
                            <span class="pl-2">
                                <span class="text-white">Ilimitado</span>
                            </span>
                        </p>
                        <p class="font-semibold text-gray-400 text-left pt-5">
                            <span class="material-icons align-middle">
                                done
                            </span>
                            <span class="pl-2">
                                <span class="text-white">Velocidad de 10 mbps</span>
                            </span>
                        </p>
                        <p class="font-semibold text-gray-400 text-left pt-5">
                            <span class="material-icons align-middle">
                                done
                            </span>
                            <span class="pl-2 text-white">
                                Recomendado de 3 a 5 equipos
                            </span>
                        </p>
                        <p class="font-semibold text-gray-400 text-left pt-5">
                            <span class="material-icons align-middle">
                                done
                            </span>
                            <span class="pl-2 text-white">
                                Soporte 12/7
                            </span>
                        </p>
                        <a href="#" class="">
                            <p class="w-full py-4 bg-blue-500 mt-8 rounded-xl text-white">
                                <span class="font-medium">
                                    Lo quiero
                                </span>
                                <span class="pl-2 material-icons align-middle text-sm">
                                    east
                                </span>
                            </p>
                        </a>
                    </div>
                    <div class="absolute top-4 right-4">
                        <p class="bg-green-600 font-semibold px-4 py-1 rounded-full uppercase text-xs">Popular</p>
                    </div>
                </div>
                <!-- Enterprise Card -->
                <div class="w-96 p-8 bg-white text-center rounded-3xl pl-16 shadow-xl">
                    <h1 class="text-black font-semibold text-2xl">Plan Familiar</h1>
                    <p class="pt-2 tracking-wide">
                        <span class="text-gray-400 align-top">s/ </span>
                        <span class="text-3xl font-semibold">60</span>

                    </p>
                    <hr class="mt-4 border-1">
                    <div class="pt-8">
                        <p class="font-semibold text-gray-400 text-left">
                            <span class="material-icons align-middle">
                                done
                            </span>
                            <span class="pl-2">
                                <span class="text-black">Ilimitado</span>
                            </span>
                        </p>
                        <p class="font-semibold text-gray-400 text-left pt-5">
                            <span class="material-icons align-middle">
                                done
                            </span>
                            <span class="pl-2">
                                <span class="text-black">Velocidad de 20 mbps</span>
                            </span>
                        </p>
                        <p class="font-semibold text-gray-400 text-left pt-5">
                            <span class="material-icons align-middle">
                                done
                            </span>
                            <span class="pl-2 text-black">
                                Recomendado de 5 a 7 equipos
                            </span>
                        </p>
                        <p class="font-semibold text-gray-400 text-left pt-5">
                            <span class="material-icons align-middle">
                                done
                            </span>
                            <span class="pl-2 text-black">
                                Soporte 24/7
                            </span>
                        </p>
                        <a href="#" class="">
                            <p class="w-full py-4 bg-green-500 mt-8 rounded-xl text-white">
                                <span class="font-medium">
                                    Lo quiero
                                </span>
                                <span class="pl-2 material-icons align-middle text-sm">
                                    east
                                </span>
                            </p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="mr-auto place-self-center lg:col-span-7">
                <h1
                    class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">
                    Internet ilimitado Hogar
                    para zonas rurales y áreas sin cobertura</h1>
                <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">
                    Con más de 30 repetidoras de internet instaladas en zonas sin cobertura en el departamento de
                    Huánuco, puedes tener internet para tu hogar o negocio hasta en la zona que menos lo imagines. Somos
                    la mejor opción de internet fijo para zonas sin cobertura en Huánuco, AMarilis y PillcoMarca.


                </p>


                <div id="task"
                    class="flex justify-between items-center border-b border-slate-200 py-3 px-2 border-l-4 border-l-indigo-300 bg-gradient-to-r from-indigo-100 to-transparent hover:from-indigo-200 transition ease-linear duration-150">
                    <div class="inline-flex items-center space-x-2">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor"
                                class="w-6 h-6 text-slate-500 hover:text-indigo-600 hover:cursor-pointer">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>

                        </div>
                        <div>Cayhuayna Alta</div>
                    </div>
                </div>
                <div id="task"
                    class="flex justify-between items-center border-b border-slate-200 py-3 px-2 border-l-4 border-l-indigo-300 bg-gradient-to-r from-indigo-100 to-transparent hover:from-indigo-200 transition ease-linear duration-150">
                    <div class="inline-flex items-center space-x-2">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor"
                                class="w-6 h-6 text-slate-500 hover:text-indigo-600 hover:cursor-pointer">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>

                        </div>
                        <div>Jorge chavez</div>
                    </div>
                </div>
                <div id="task"
                    class="flex justify-between items-center border-b border-slate-200 py-3 px-2 border-l-4 border-l-indigo-300 bg-gradient-to-r from-indigo-100 to-transparent hover:from-indigo-200 transition ease-linear duration-150">
                    <div class="inline-flex items-center space-x-2">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor"
                                class="w-6 h-6 text-slate-500 hover:text-indigo-600 hover:cursor-pointer">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>

                        </div>
                        <div>Jancao</div>
                    </div>
                </div>
                <div id="task"
                    class="flex justify-between items-center border-b border-slate-200 py-3 px-2 border-l-4 border-l-indigo-300 bg-gradient-to-r from-indigo-100 to-transparent hover:from-indigo-200 transition ease-linear duration-150">
                    <div class="inline-flex items-center space-x-2">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor"
                                class="w-6 h-6 text-slate-500 hover:text-indigo-600 hover:cursor-pointer">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>

                        </div>
                        <div>La pedrosa</div>
                    </div>
                </div>
                <div id="task"
                    class="flex justify-between items-center border-b border-slate-200 py-3 px-2 border-l-4 border-l-indigo-300 bg-gradient-to-r from-indigo-100 to-transparent hover:from-indigo-200 transition ease-linear duration-150">
                    <div class="inline-flex items-center space-x-2">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor"
                                class="w-6 h-6 text-slate-500 hover:text-indigo-600 hover:cursor-pointer">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>

                        </div>
                        <div>Loma blanca</div>
                    </div>
                </div>

                <div class="max-w-sm rounded-xl overflow-hidden text-center shadow-lg ">
                    <div class="px-6 pt-4 pb-2">
                        <span class="inline-block   px-3 py-1 text-sm font-semibold ">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.288 15.038a5.25 5.25 0 017.424 0M5.106 11.856c3.807-3.808 9.98-3.808 13.788 0M1.924 8.674c5.565-5.565 14.587-5.565 20.152 0M12.53 18.22l-.53.53-.53-.53a.75.75 0 011.06 0z" />
                              </svg>                              
                        </span>
                    </div>
                    <div class="px-3 py-2  ">
                        <div class="font-bold text-xl mb-2 text-gray-800 font-sans">
                           + 840
                        </div>
                        <p class="text-gray-700 text-base">
                            Clientes en todo Huánuco
                        </p>
                    </div>

                </div>
              

            </div>
            <div class="hidden lg:mt-0 lg:col-span-5 lg:flex rounded-lg">
                <img src="{{ asset('images/hi1.jpg') }}" alt="mockup" class="rounded-lg ">
            </div>
        </div>


    </section>
@endsection
