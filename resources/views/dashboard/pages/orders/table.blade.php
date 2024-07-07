<div class="card-datatable table-responsive" id="order-list">
    <table class="table">
        <thead class="table-light">
            <tr>
                <th>
                    <input class="form-check-input select-all" type="checkbox">
                </th>
                <th>{{ __('Order') }}</th>
                <th>{{ __('Date') }}</th>
                <th>{{ __('Customer') }}</th>
                <th>{{ __('Payment') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Method') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                @php
                    switch ($order->paymentStatus) {
                        case 'pending':
                            $paymentStatusColor = 'text-warning';
                            break;
                        case 'paid':
                            $paymentStatusColor = 'text-success';
                            break;
                        case 'failed':
                            $paymentStatusColor = 'text-danger';
                            break;
                        case 'Refunded':
                            $paymentStatusColor = 'text-secondary';
                            break;
                        default:
                            $paymentStatusColor = 'text-muted';
                            break;
                    }
                @endphp

                <tr class="odd">
                    <td>
                        <input class="form-check-input item" value="{{ $order->id }}" type="checkbox">
                    </td>


                    <td><a href="{{ route('orders.show', $order->id) }}"><span>#{{ $order->id }}</span></a></td>
                    <td class="sorting_1"><span class="text-nowrap">{{ $order->created_at->format('Y-m-d H:i') }}</span>
                    </td>
                    <td>
                        <div class="d-flex justify-content-start align-items-center user-name">
                            @if ($order->user->avatar)
                                <div class="avatar-wrapper me-3">
                                    <div class="avatar avatar-sm"><img src="{{ asset($order->user->avatar) }}"
                                            alt="Avatar" class="rounded-circle"></div>
                                </div>
                            @endif
                            <div class="d-flex flex-column"><a href="pages-profile-user.html"
                                    class="text-truncate text-heading"><span
                                        class="fw-medium">{{ $order->user->name }}</span></a><small
                                    class="text-truncate">{{ $order->user->email }}</small></div>
                        </div>
                    </td>
                    <td>
                        <h6 class="mb-0 w-px-100 d-flex align-items-center {{ $paymentStatusColor }}"><i
                                class="ri-circle-fill ri-10px me-1"></i>{{ $order->paymentStatus }}</h6>
                    </td>
                    <td><span class="badge px-2 rounded-pill" style="background: {{ $order->status->color }}"
                            text-capitalized="">{{ $order->status->name }}</span></td>

                    <td class="dtr-hidden">
                        {{ $order->paymentMethod }}
                    </td>


                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </button>
                            <div class="dropdown-menu" style="">
                                <a class="dropdown-item waves-effect" href="{{ route('orders.show', $order->id) }}"><i
                                        class="mdi mdi-eye me-1"></i> {{ __('Show') }}</a>
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
