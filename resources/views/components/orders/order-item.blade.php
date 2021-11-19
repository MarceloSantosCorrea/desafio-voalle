<tr id="{{ $productId }}">
    <td>
        <a href="javascript:void(0)" onclick="remove('{{ $productId }}')" data-toggle="tooltip" data-placement="top" title="{{ __('Delete') }}" class="btn btn-sm btn-danger">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
            </svg>
        </a>
    </td>
    <td>
        <input type="number" onchange="calculateSubTotal(this, {{ $productPrice }}, '{{ $productId }}')" class="form-control form-control-sm" min="1" value="{{ $productQuantity ?? 1 }}" name="items[{{ $productId }}][quantity]">
        <input type="hidden" value="{{ $productName }}" name="items[{{ $productId }}][name]">
        <input type="hidden" value="{{ $productPrice }}" name="items[{{ $productId }}][price]">
    </td>
    <td style="vertical-align: bottom">{{ $productName }}</td>
    <td class="text-right" style="vertical-align: bottom">R$ {{ number_format($productPrice, 2, ',', '.') }}</td>
    <td class="text-right quantity-total" style="vertical-align: bottom">R$ <span class="unit-value" id="quantity-total-{{ $productId }}">{{ number_format($productQuantity * $productPrice, 2, ',', '.') }}</span></td>
</tr>
