 <!--sidenav -->
 <div class="fixed left-0 top-0 w-64 h-full bg-[#f8f4f3] p-4 z-50 sidebar-menu transition-transform overflow-y-auto">
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
         <li class="mb-1 group" id="menu_dashboard">
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

                 <li class="mb-4 flex" id="ventas_vender">
                     <i class="bx bx-cart-alt"></i>
                     <a href="{{ route('vender') }}"
                         class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 }">Vender</a>
                 </li>

                 <li class="mb-4 flex" id="ventas_ver">
                     <i class=" bx bx-loader-circle"></i>
                     <a href="{{ route('verComprobante', ['date' => date('Y-m-d')]) }}"
                         class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 ">Ver
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
                 <li class="mb-4 flex" id="productos_productos">
                     <i class="bx bx-detail"></i>
                     <a href="{{ route('verProducto') }}"
                         class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 ">
                         Productos</a>
                 </li>

             </ul>

             <ul class="pl-7 mt-2 hidden group-[.selected]:block">
                 <li class="mb-4 flex" id="productos_categorias">
                     <i class="bx bx-diamond"></i>
                     <a href="{{ route('categoria.show') }}"
                         class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 ">
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
                 <li class="mb-1 group flex" id="compras_nuevacompra">
                     <i class='bx bx-purchase-tag-alt  text-lg'></i>
                     <a href="{{ route('comprar.producto') }}"
                         class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] 
                       before:w-1 ">

                         <span class="text-sm">Nueva compra</span>
                     </a>
                 </li>
                 <li class="mb-1 group flex" id="compras_listarcompra">
                     <i class='bx bx-building  text-lg'></i>
                     <a href="{{ route('listar.compra') }}"
                         class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] 
                      before:w-1 ">

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
                 <li class="mb-4 flex" id="listar_clientes">
                     <i class="bx bxs-user-check"></i>
                     <a href="{{ route('clientes.index') }}"
                         class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] 
                         before:w-1 ">
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
                 <li class="mb-4 flex" id="proveedores_listar">
                     <i class="bx bx-user-pin"></i>
                     <a href="{{ route('proveedor.index') }}"
                         class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] 
                        before:w-1 ">
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
                 <li class="mb-1 group flex" id="finanzas_arqueo">
                     <i class='bx bx-chart text-lg'></i>
                     <a href="{{ route('verCaja') }}"
                         class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] 
                       before:w-1 ">
                         <span class="text-sm">Arqueo de caja</span>

                     </a>
                 </li>
                 <li class="mb-1 group flex" id="finanzas_listar">
                     <i class='bx bx-trending-up  text-lg'></i>
                     <a href="{{ route('listar.caja') }}"
                         class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] 
                       before:w-1 ">
                         <span class="text-sm">Listar caja</span>

                     </a>
                 </li>

                 <li class="mb-4 flex" id="finanzas_rentabilidad">
                     <i class="bx bx-detail"></i>
                     <a href="{{ route('listar.prodrentable3', ['month' => date('Y-m')]) }}"
                         class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] before:w-1 ">
                         Rentabilidad</a>
                 </li>
         </li>
     </ul>
     </li>


     <span class="text-gray-400 font-bold">Mi empresa</span>
     <li class="mb-1 group" id="mi_empresa">
         <a href=""
             class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 sidebar-dropdown-toggle">
             <i class='bx bx-building-house mr-3 text-lg'></i>
             <span class="text-sm">Empresa</span>
             <i class="ri-arrow-right-s-line ml-auto group-[.selected]:rotate-90"></i>
         </a>
         <ul class="pl-7 mt-2 hidden group-[.selected]:block">
             <li class="mb-4 flex" id="mi_configuracion">
                 <i class="bx bx-brightness"></i>

                 <a href="{{ route('empresa.view') }}"
                     class="text-gray-900 text-sm flex items-center hover:text-[#f84525] before:contents-[''] 
                        before:w-1 ">
                     Configuración</a>
             </li>

         </ul>
     </li>
     <span class="text-gray-400 font-bold md:hidden">Acceso rápido</span>
     <li class="mb-1 group md:hidden mt-2" id="menu_dashboard">
     <a href="{{ route('verComprobante', ['date' => date('Y-m-d')]) }}">
             <button
                 class="p-2 bg-indigo-300 text-white rounded-lg hover:bg-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-opacity-50  w-full text-left px-4 text-sm">
                 <span class="font-semibold">Consultar Nulidad</span>
             </button>
         </a>
     </li>
     <li class="mb-1 group md:hidden" id="menu_dashboard">
     <a href="{{ route('vender') }}" rel="noopener noreferrer">
             <button
                 class="p-2 bg-green-500 text-white rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50  w-full text-left px-4 text-sm">
                 <span class="font-semibold">Venta Contado</span>
             </button>
         </a>
     </li>
     <li class="mb-1 group md:hidden" id="menu_dashboard">
     <a href="{{ route('verProducto') }}">
             <button
                 class="p-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50  w-full text-left px-4 text-sm">
                 <span class="font-semibold">Artículos</span>
             </button>
         </a>
     </li>

     </ul>
 </div>
 <div class="fixed top-0 left-0 w-full h-full bg-black/50 z-40 md:hidden sidebar-overlay"></div>
 <!-- end sidenav -->
 <script>
     function addBgToMenuItem(elementId) {
         // Selecciona el elemento con el ID proporcionado
         let element = document.getElementById(elementId);

         // Verifica si el elemento abuelo contiene la clase 'group'
         if (element.parentNode.parentNode.classList.contains('group')) {
             // Alterna la clase 'active' en el abuelo del elemento
             element.parentNode.parentNode.classList.toggle('selected');

             // Alterna la clase 'active' en el propio elemento
             element.classList.toggle('active');
             // Añadir los estilos directamente al elemento
             element.style.backgroundColor = '#1B1C26';
             element.style.padding = '4px';
             element.style.display = 'flex';
             element.style.alignItems = 'center';
             element.style.borderRadius = '3px';
             element.style.color = 'white';
             let link = element.querySelector('a');
             if (link) {
                 link.style.color = 'white';
             }
         } else {
             element.classList.toggle('active');
         }
     }
 </script>