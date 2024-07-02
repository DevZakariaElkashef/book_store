<div class="card-datatable table-responsive" id="order-list">

    <table class="table">
        <thead class="table-light">
            <tr>
                <th>
                    <input class="form-check-input select-all" type="checkbox">
                </th>
                <th>ID</th>
                <th>{{ __('User') }}</th>
                <th>{{ __('City') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Payment Method') }}</th>
                <th>{{ __('Payment Status') }}</th>
                <th>{{ __('Total') }}</th>
                <th>{{ __('Date') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>
                        <input class="form-check-input item" value="{{ $order->id }}" type="checkbox">
                    </td>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        {{ $order->user->name }}
                    </td>
                    <td>
                        {{ $order->city->name }}
                    </td>
                    <td>
                        {{ $order->status->name }}
                    </td>
                    <td>
                        {{ $order->paymentMethod }}
                    </td>
                    <td>
                        {{ $order->paymentStatus }}
                    </td>
                    <td>
                        {{ $order->total }}
                    </td>
                    <td>
                        {{ $order->created_at->format('Y-m-d') }}
                    </td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </button>
                            <div class="dropdown-menu" style="">
                                <a class="dropdown-item waves-effect"
                                    href="{{ route('orders.show', $order->id) }}"><i
                                        class="mdi mdi-eye me-1"></i> {{ __('Show') }}</a>
                                <a class="dropdown-item waves-effect"
                                    href="{{ route('orders.edit', $order->id) }}"><i
                                        class="mdi mdi-pencil-outline me-1"></i> {{ __('Edit') }}</a>
                                <a class="dropdown-item waves-effect delete-btn" href="javascript:void(0);"
                                    data-url="{{ route('orders.destroy', $order->id) }}" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal"><i class="mdi mdi-trash-can-outline me-1"></i>
                                    {{ __('Delete') }}</a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-3 px-3">
        {{ $orders->links() }}
    </div>
</div>
