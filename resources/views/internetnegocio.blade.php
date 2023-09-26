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
            <h1 class="mb-8 text-4xl font-extrabold leading-tight lg:text-6xl text-dark-grey-900">Internet Negocio ILIMITADO
                en
                zonas sin
                cobertura</h1>
            <p class="mb-6 text-base font-normal leading-7 lg:w-3/4 text-grey-900">
                Brindamos internet a Grifos, Colegios, Postas, Empresas y más...
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
            <img class=" rounded-md " src="{{ asset('images/bu1.jpg') }}" alt="header image">
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
                    <h1 class="text-black font-semibold text-2xl">Plan Emprendedor</h1>
                    <p class="pt-2 tracking-wide">
                        <span class="text-gray-400 align-top">s/ </span>
                        <span class="text-3xl font-semibold">95</span>

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
                                <span class="text-black">Velocidad de 20 mbps de subida y bajada</span>
                            </span>
                        </p>
                        <p class="font-semibold text-gray-400 text-left pt-5">
                            <span class="material-icons align-middle">
                                done
                            </span>
                            <span class="pl-2 text-black">
                                Recomendable para 7 a 10 equipos
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
                <!-- StartUp Card -->
                <div
                    class="w-80 p-8 bg-gray-900 text-center rounded-3xl text-white border-4 shadow-xl border-white transform scale-125">
                    <h1 class="text-white font-semibold text-2xl">Plan Despegar</h1>
                    <p class="pt-2 tracking-wide">
                        <span class="text-gray-400 align-top">s/ </span>
                        <span class="text-3xl font-semibold">120</span>

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
                                <span class="text-white">Velocidad de 30 mbps de bajada y subida</span>
                            </span>
                        </p>
                        <p class="font-semibold text-gray-400 text-left pt-5">
                            <span class="material-icons align-middle">
                                done
                            </span>
                            <span class="pl-2 text-white">
                                Recomendado de 10 a + equipos
                            </span>
                        </p>
                        <p class="font-semibold text-gray-400 text-left pt-5">
                            <span class="material-icons align-middle">
                                done
                            </span>
                            <span class="pl-2 text-white">
                                Soporte 24/7
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

            </div>
        </div>
    </div>

    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="mr-auto place-self-center lg:col-span-7">
                <h1
                    class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">
                    Internet ilimitado para negocios en zonas sin acceso</h1>
                <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">
                    Con más de 30 repetidoras de internet instaladas en zonas sin cobertura en el departamento de
                    Huánuco, puedes tener internet para tu hogar o negocio hasta en la zona que menos lo imagines. Somos
                    la mejor opción de internet fijo para zonas sin cobertura en Huánuco, Amarilis y PillcoMarca.
                </p>
            </div>
            <div class="hidden lg:mt-0 lg:col-span-5 lg:flex rounded-lg">
                <img src="{{ asset('images/bu3.jpg') }}" alt="mockup" class="rounded-lg ">
            </div>
        </div>


    </section>
@endsection
