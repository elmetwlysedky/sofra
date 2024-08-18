<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $order->id }}</title>
    @include('Dashboard.Layouts.print_invoice')
</head>
<body onload="window.print();">
<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="2">
                <table>
                    <tr>
                        <td class="title">
                            <h2>Invoice #{{ $order->id }}</h2>
                        </td>
                        <td>
                            Date: {{ $order->created_at->format('d/m/Y') }}<br>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr class="information">
            <td colspan="2">
                <table>
                    <tr>
                        <td>
                            {{ $order->restaurant->name }}<br>
                            {{ $order->restaurant->address }}
                        </td>
                        <td>
                            {{ $order->client->name }}<br>
                            {{ $order->client->email }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr class="heading">
            <td>Product</td>
            <td>Price</td>
        </tr>
        @foreach($order->products as $product)
            <tr class="item">
                <td>{{ $product->name }} (x{{ $product->pivot->quantity }})</td>
                <td>${{ $product->pivot->price * $product->pivot->quantity }}</td>

            </tr>
        @endforeach
        <tr>
            <td></td>
            <td>subTotal:{{ $order->total_invoice }}</td>
        </tr>
        <tr>
            <td></td>
            <td>delivery:{{$order->delivery_charge}}</td>
        </tr>
        <tr class="total">
            <td></td>
            <td>Total: ${{$order->total_price}}</td>
        </tr>
    </table>
</div>
</body>
</html>
