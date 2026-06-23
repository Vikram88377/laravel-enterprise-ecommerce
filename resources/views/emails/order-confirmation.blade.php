<h2>Order Confirmation</h2>

<p>Hello {{ $order->user->name }},</p>

<p>Your order has been placed successfully.</p>

<p><strong>Order Number:</strong> {{ $order->order_number }}</p>
<p><strong>Total Amount:</strong> ₹{{ $order->grand_total }}</p>

<h3>Items</h3>

<ul>
    @foreach ($order->items as $item)
        <li>
            {{ $item->product_name }}
            - Qty: {{ $item->quantity }}
            - ₹{{ $item->total }}
        </li>
    @endforeach
</ul>

<p>Thank you for shopping with us.</p>