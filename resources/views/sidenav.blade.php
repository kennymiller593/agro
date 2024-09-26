 <!--sidenav -->
 <div class="fixed left-0 top-0 w-64 h-full bg-[#f8f4f3] p-4 z-50 sidebar-menu transition-transform">
     <a href="#" class="flex items-center pb-4 border-b border-b-gray-800">

         <h2 class="font-bold text-2xl">

             @if (isset($empresa))
                 {{ $empresa->nombre_comercial }}
             @else
             @endif
         </h2>


     </a>
     <ul class="mt-4">
         <span class="text-gray-400 font-bold">ADMIN</span>
         <li class="mb-1 group">
             <a href="{{ route('dash.admin') }}"
                 class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                 <i class="ri-home-2-line mr-3 text-lg"></i>
                 <span class="text-sm">Dashboard</span>
             </a>
         </li>

         <li class="mb-1 group">
             <a href=""
                 class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 sidebar-dropdown-toggle">
                 <i class='bx bx-stats mr-3 text-lg'></i>
                 <span class="text-sm">Ventas</span>
                 <i class="ri-arrow-right-s-line ml-auto group-[.selected]:rotate-90"></i>
             </a>
             <ul class="pl-7 mt-2 hidden group-[.selected]:block">

                 <li class="mb-4 flex">
                     <i class="bx bx-cart-alt"></i>
                     <a href="{{ route('vender') }}"
                         class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Vender</a>
                 </li>

                 <li class="mb-4 flex">
                     <i class=" bx bx-loader-circle"></i>
                     <a href="{{ route('verComprobante', ['date' => date('Y-m-d')]) }}"
                         class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">Ver
                         comprobantes</a>
                 </li>
             </ul>
         </li>

         <li class="mb-1 group">
             <a href=""
                 class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 sidebar-dropdown-toggle">
                 <i class='bx bx-detail mr-3 text-lg'></i>
                 <span class="text-sm">Productos/Servicios</span>
                 <i class="ri-arrow-right-s-line ml-auto group-[.selected]:rotate-90"></i>
             </a>
             <ul class="pl-7 mt-2 hidden group-[.selected]:block">
                 <li class="mb-4 flex">
                     <i class="bx bx-detail"></i>
                     <a href="{{ route('verProducto') }}"
                         class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">
                         Productos</a>
                 </li>

             </ul>

             <ul class="pl-7 mt-2 hidden group-[.selected]:block">
                 <li class="mb-4 flex">
                     <i class="bx bx-diamond"></i>
                     <a href="{{ route('categoria.show') }}"
                         class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">
                         Categorías</a>
                 </li>

             </ul>
         </li>

         <li class="mb-1 group">
             <a href=""
                 class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 sidebar-dropdown-toggle">
                 <i class='bx bx-cuboid mr-3 text-lg'></i>
                 <span class="text-sm">Compras</span>
                 <i class="ri-arrow-right-s-line ml-auto group-[.selected]:rotate-90"></i>
             </a>
             <ul class="pl-7 mt-2 hidden group-[.selected]:block">
                 <li class="mb-1 group flex">
                     <i class='bx bx-purchase-tag-alt  text-lg'></i>
                     <a href="{{ route('comprar.producto') }}"
                         class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] 
                       before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">

                         <span class="text-sm">Nueva compra</span>
                     </a>
                 </li>
                 <li class="mb-1 group flex">
                     <i class='bx bx-building  text-lg'></i>
                     <a href="{{ route('listar.compra') }}"
                         class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] 
                      before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">

                         <span class="text-sm">Listar compra</span>
                     </a>
                 </li>

             </ul>
         </li>

         <li class="mb-1 group">
             <a href=""
                 class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 sidebar-dropdown-toggle">
                 <i class='bx bx-user mr-3 text-lg'></i>
                 <span class="text-sm">Clientes</span>
                 <i class="ri-arrow-right-s-line ml-auto group-[.selected]:rotate-90"></i>
             </a>
             <ul class="pl-7 mt-2 hidden group-[.selected]:block">
                 <li class="mb-4 flex">
                     <i class="bx bxs-user-check"></i>
                     <a href="{{ route('clientes.index') }}"
                         class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] 
                         before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">
                         Listar clientes</a>
                 </li>

             </ul>
         </li>
         <li class="mb-1 group">
             <a href=""
                 class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 sidebar-dropdown-toggle">
                 <i class='bx bx-user-voice mr-3 text-lg'></i>
                 <span class="text-sm">Proveedores</span>
                 <i class="ri-arrow-right-s-line ml-auto group-[.selected]:rotate-90"></i>
             </a>
             <ul class="pl-7 mt-2 hidden group-[.selected]:block">
                 <li class="mb-4 flex">
                     <i class="bx bx-user-pin"></i>
                     <a href="{{ route('proveedor.index') }}"
                         class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] 
                        before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">
                         Listar Proveedores</a>
                 </li>

             </ul>
         </li>

         <li class="mb-1 group">
             <a href=""
                 class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 sidebar-dropdown-toggle">
                 <i class='bx bx-bar-chart mr-3 text-lg'></i>
                 <span class="text-sm">Finanzas</span>
                 <i class="ri-arrow-right-s-line ml-auto group-[.selected]:rotate-90"></i>
             </a>
             <ul class="pl-7 mt-2 hidden group-[.selected]:block">
                 <li class="mb-1 group flex">
                     <i class='bx bx-chart text-lg'></i>
                     <a href="{{ route('verCaja') }}"
                         class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] 
                       before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">
                         <span class="text-sm">Arqueo de caja</span>

                     </a>
                 </li>
                 <li class="mb-1 group flex">
                     <i class='bx bx-trending-up  text-lg'></i>
                     <a href="{{ route('listar.caja') }}"
                         class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] 
                       before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">
                         <span class="text-sm">Listar caja</span>

                     </a>
                 </li>

                 <li class="mb-4 flex">
                     <i class="bx bx-detail"></i>
                     <a href="{{ route('listar.prodrentable3', ['month' => date('Y-m')]) }}"
                         class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">
                         Rentabilidad</a>
                 </li>
         </li>
     </ul>
     </li>


     <span class="text-gray-400 font-bold">Mi empresa</span>
     <li class="mb-1 group">
         <a href=""
             class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 sidebar-dropdown-toggle">
             <i class='bx bx-building-house mr-3 text-lg'></i>
             <span class="text-sm">Empresa</span>
             <i class="ri-arrow-right-s-line ml-auto group-[.selected]:rotate-90"></i>
         </a>
         <ul class="pl-7 mt-2 hidden group-[.selected]:block">
             <li class="mb-4 flex">
                 <i class="bx bx-brightness"></i>

                 <a href="{{ route('empresa.view') }}"
                     class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] 
                        before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-3">
                     Configuración</a>
             </li>

         </ul>
     </li>

     </ul>
 </div>
 <div class="fixed top-0 left-0 w-full h-full bg-black/50 z-40 md:hidden sidebar-overlay"></div>
 <!-- end sidenav -->
