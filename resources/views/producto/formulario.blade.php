<!-- Header -->


<!-- Item List -->
<div class="space-y-2 mb-4">
    @php
        $total = 0;
        $total_partia = 0;
    @endphp
    @if (count($cartcompra) > 0)
        <table class="w-full">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-xs font-semibold tracking-wide text-left">Cantidad</th>
                    <th class="px-6 py-3 text-xs font-semibold tracking-wide text-left">U. Med.</th>
                    <th class="px-6 py-3 text-xs font-semibold tracking-wide text-left">Producto</th>
                    <th class="px-6 py-3 text-xs font-semibold tracking-wide text-left">P. Compra</th>
                    <th class="px-6 py-3 text-xs font-semibold tracking-wide text-left">Sub total</th>
                    <th class="px-6 py-3 text-xs font-semibold tracking-wide text-left">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartcompra as $id => $details)
                    @php
                        $total += $details['price'] * $details['quantity'];
                        $total_partial = $details['price'] * $details['quantity'];
                    @endphp
                    <tr class="cart-item" data-id="{{ $details['id'] }}">
                        <td class="px-6 py-4">
                            <input type="number" min="1"
                                class="quantity-input w-12 pt-3 border rounded text-center focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                value="{{ $details['quantity'] }}" data-id="{{ $details['id'] }}">
                        </td>
                        <td class="px-6 py-4 text-gray-600 uppercase text-xs">{{ $details['uni_medida'] }}</td>
                        <td class="px-6 py-4">
                            <span id="name" class="text-sm uppercase">{{ $details['name'] }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <input type="number" min="1"
                                class="price-compra w-12 pt-3 border rounded text-center focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                data-id="{{ $details['id'] }}" value="{{ $details['price'] }}">
                        </td>
                        <td class="px-6 py-4">
                            <span id="subtotal" class="subtotal">s/ {{ $total_partial }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <button class="text-gray-600 remove-from-cart">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Tu carrito está vacío.</p>
    @endif
</div>
<!-- Footer -->
<div class="border-t pt-4">

    <div @if ($total > 0) onclick="showmodalConfirm()" @endif
        class=" @if ($total > 0) bg-blue-500  @else  bg-gray-500 @endif   text-white rounded-lg p-4 flex justify-between items-center ">
        <button class="font-bold">Grabar</button>
        <span class="font-bold">S/ {{ $total }} </span>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="currentColor" viewBox="0 0 24 24">
            <path
                d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
        </svg>
    </div>
</div>
