<div class="form-row">
    <div class="form-group col-md-6">
        <label for="client">{{ __('Client') }}</label>
        <select
            class="form-control @error('client') is-invalid @enderror"
            id="client"
            name="client"
            required
        >
            <option value="">{{ __('Select...') }}</option>
            @foreach($clients as $client)
                <option
                    value="{{ $client->id }}"
                    {{ old('client', $order->client_id ?? null) == $client->id? 'selected': null }}
                >{{ $client->name }}</option>
            @endforeach
        </select>
        @error('client')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
</div>

<div class="row">
    <div class="col-md-12 text-right">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-products">
            Adicionar Produto
        </button>
    </div>
</div>

@error('products')
<div class="alert alert-danger mt-3">
    {{ $message }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@enderror

<div class="row mt-3">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th style="width: 60px"></th>
                        <th style="width: 100px">{{ __('Quantity') }}</th>
                        <th>{{ __('Produto') }}</th>
                        <th class="text-right" style="width: 150px">{{ __('Unit Value') }}</th>
                        <th class="text-right" style="width: 150px">{{ __('Sub Total') }}</th>
                    </tr>
                </thead>
                <tbody id="list-products">
                    @if($items = old('products', $items ?? null))
                        @foreach($items as $productId => $value)
                            @include('components.orders.order-item', [
                                'productId' => $productId,
                                'productQuantity' => $value['quantity'],
                                'productName' => $value['name'],
                                'productPrice' => $value['price']
                            ])
                        @endforeach
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4"></td>
                        <th class="text-right" style="width:150px;">Total R$ <span class="total" id="total">
                                @if($items = old('products', $items ?? null))
                                    @php $total = 0 @endphp
                                    @foreach($items as $productId => $value)
                                        @php $total = $total + ($value['quantity'] * $value['price']) @endphp
                                    @endforeach
                                    {{ number_format($total, 2, ',', '.') }}
                                @else
                                    0,00
                                @endif
                            </span>
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $('#modal-products-btn').bind('click', function () {
            const product = $('#product').val();
            if (product) {

                const total = parseFloat($('#total').html());

                const parts = product.split('|')
                const productId = parts[0];

                if (find(productId) !== null) {
                    alert('Produto já adicionado, altere a quantidade.')
                    return
                }

                const productPrice = parseFloat(parts[1]).toFixed(2);
                const productName = parts[2];

                const newTotal = total + productPrice
                $('#total').html(newTotal)

                $('#list-products').append(`
                    <tr id="${productId}">
                        <td>
                            <a href="javascript:void(0)" onclick="remove('${productId}')" data-toggle="tooltip" data-placement="top" title="{{ __('Delete') }}" class="btn btn-sm btn-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                </svg>
                            </a>
                        </td>
                        <td>
                            <input type="number" onchange="calculateSubTotal(this, ${productPrice}, '${productId}')" class="form-control form-control-sm" min="1" value="1" name="items[${productId}][quantity]">
                            <input type="hidden" value="${productName}" name="items[${productId}][name]">
                            <input type="hidden" value="${productPrice}" name="items[${productId}][price]">
                        </td>
                        <td style="vertical-align: bottom">${productName}</td>
                        <td class="text-right" style="vertical-align: bottom">R$ ${floatToString(productPrice)}</td>
                        <td class="text-right" style="vertical-align: bottom">R$ <span class="unit-value" id="quantity-total-${productId}">${floatToString(productPrice)}</span></td>
                    </tr>
                `);

                $('#modal-products').modal('hide');

                calculateTotal()
            }
        })

        function calculateSubTotal(obj, price, id) {
            const subTotal = document.getElementById(`quantity-total-${id}`)
            subTotal.innerText = floatToString((obj.value * price).toFixed(2))
            calculateTotal()
        }

        function calculateTotal() {
            let total = 0
            const totalsRows = document.getElementsByClassName('unit-value')
            if (totalsRows.length) {
                for (let i = 0; i < totalsRows.length; i++) {
                    total += parseFloat(totalsRows[i].innerHTML.replace('.', '').replace(',', '.'))
                }
            }

            document.getElementById('total').innerText = floatToString(total.toFixed(2))
        }

        function floatToString(value) {
            return (value).toLocaleString(undefined, {minimumFractionDigits: 2}).replace('.', ',');
        }

        function remove(id) {
            $(`#${id}`).remove();
            calculateTotal()
        }

        function find(id) {
            return document.getElementById(id)
        }
    </script>
@endpush


