@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Your Cart</h1>

    @if(empty($groups))
        <p>Your cart is empty.</p>
    @else
        @foreach($groups as $group)
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h3>{{ $group['dokan']->name }}</h3>
                    <p class="mb-0">Contact: {{ $group['dokan']->contact_no }} | Category: {{ $group['dokan']->category }}</p>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($group['items'] as $item)
                                <tr>
                                    <td>{{ $item->product->name }}</td>
                                    <td>₱{{ number_format($item->amount / $item->qty, 2) }}</td> <!-- approximate unit price -->
                                    <td>{{ $item->qty }}</td>
                                    <td>₱{{ number_format($item->amount, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="table-secondary">
                                <td colspan="3" class="text-end"><strong>Total for this vendor:</strong></td>
                                <td><strong>₱{{ number_format($group['subtotal'], 2) }}</strong></td>
                            </tr>
                        </tfoot>
                    </table>

                    {{-- Checkout button for this group --}}
                    <form action="{{ route('checkout.dokan', $group['dokan']->id) }}" method="POST" class="text-end">
                        @csrf
                        <button type="submit" class="btn btn-success">Checkout ({{ $group['dokan']->name }})</button>
                    </form>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
