@if (count($productos))
    @foreach ($productos as $producto)
        <div class="shadow-md hover:shadow-lg transform transition-all duration-300 p-1 flex flex-col justify-between cursor-pointer border border-gray-100 hover:bg-slate-100">
            <div class=" add-to-cart" data-id="{{ $producto->id }}">

                <img src="{{ $producto->imagen }}" alt="img" class="w-full">
                <h3 class="text-base font-semibold uppercase">{{ $producto->nombre }}</h3>
                <div class="flex justify-between items-center mt-1">
                    <p class="text-gray-500 text-base "> {{ $producto->stok }} {{ $producto->unimedida->simbolo_sunat }}
                    <div class=" text-base font-bold text-blue-600 ">s/ {{ $producto->precio_venta }}</div>
                    </p>
                </div>
            </div>
            <input type="text"
                class="oter-price w-16 h-8 text-center border-2 mt-1 rounded-lg focus:outline-none focus:border-blue-600"
                id="oter-price{{ $producto->id }}" value="{{ $producto->precio_venta }}"
                name="oter-price{{ $producto->id }}">
            <div class="mt-2 add-to-cart" data-id="{{ $producto->id }}">
                <button class="action-button bg-blue-400 text-white w-full py-2 rounded hover:bg-blue-500">
                    Añadir
                </button>

            </div>
        </div>
    @endforeach
@else
    No hay coincidencia en la búsqueda
@endif
