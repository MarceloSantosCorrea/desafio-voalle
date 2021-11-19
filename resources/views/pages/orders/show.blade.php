<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ __('Order') . ' |' }} {{ config('app.name', 'Laravel') }}</title>
        <style>
            .styled-table {
                border-collapse: collapse;
                margin: 25px 0;
                font-size: 0.9em;
                font-family: sans-serif;
                width: 100%;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
            }

            .styled-table thead tr {
                background-color: #009879;
                color: #ffffff;
                text-align: left;
            }

            .styled-table th,
            .styled-table td {
                padding: 12px 10px;
            }

            .styled-table tbody tr {
                border-bottom: 1px solid #dddddd;
            }

            .styled-table tbody tr:nth-of-type(even) {
                background-color: #f3f3f3;
            }

            .styled-table tbody tr:last-of-type {
                border-bottom: 2px solid #009879;
            }

            .styled-table tbody tr.active-row {
                font-weight: bold;
                color: #009879;
            }

            .text-align-left {
                text-align: left
            }

            .text-align-right {
                text-align: right;
            }

            .width-100 {
                width: 100px
            }

            .width-150 {
                width: 150px
            }

            ul,li{
                margin: 0;
                padding: 0;
            }

            li{
                list-style: none;
            }
        </style>
    </head>
    <body>
        {{ __('Client') }}
        <hr/>
        <ul>
            <li>Nome: <span style="font-weight: bold">{{ $order->client->name }}</span></li>
            <li>Email: <span style="font-weight: bold">{{ $order->client->email }}</span></li>
            <li>CPF: <span style="font-weight: bold">{{ $order->client->cpf }}</span></li>
            <li>Telefone: <span style="font-weight: bold">{{ $order->client->phone }}</span></li>
        </ul>
        {{ __('Products') }}
        <hr/>
        <table class="table table-hover table-striped styled-table">
            <thead>
                <tr>
                    <th class="text-align-left width-100">{{ __('Quantity') }}</th>
                    <th class="text-align-left">{{ __('Produto') }}</th>
                    <th class="text-align-right width-150">{{ __('Unit Value') }}</th>
                    <th class="text-align-right width-150">{{ __('Sub Total') }}</th>
                </tr>
            </thead>
            <tbody id="list-products">
                @if(count($items))
                    @foreach($items as $productId => $value)
                        <tr>
                            <td>{{ $value['quantity'] }}</td>
                            <td>{{ $value['name'] }}</td>
                            <td class="text-align-right">
                                R$ {{ number_format($value['price'], 2, ',', '.') }}
                            </td>
                            <td class="text-align-right">
                                R$ {{ number_format($value['quantity'] * $value['price'], 2, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"></td>
                    <th class="text-align-right width-150">
                        Total R$
                        @if(count($items))
                            @php $total = 0 @endphp
                            @foreach($items as $productId => $value)
                                @php $total = $total + ($value['quantity'] * $value['price']) @endphp
                            @endforeach
                            {{ number_format($total, 2, ',', '.') }}
                        @else
                            0,00
                        @endif
                    </th>
                </tr>
            </tfoot>
        </table>
    </body>
</html>

