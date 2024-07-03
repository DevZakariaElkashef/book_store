@extends('dashboard.layouts.app')


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

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">


        <div
            class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 mt-2 gap-6">

            <div class="d-flex flex-column justify-content-center">
                <div class="d-flex align-items-center mb-1">
                    <h5 class="mb-0">Order #{{ $order->id }}</h5>
                    <span class="badge bg-label-success me-2 ms-2 rounded-pill">{{ $order->paymentStatus }}</span>
                    <span style="color: {{ $order->status->color }};" class="rounded-pill">{{ $order->status->name }}</span>
                </div>
                <p class="mb-0">{{ $order->created_at->format('Y-m-d') }}, <span
                        id="orderYear"></span>{{ $order->created_at->format('H:i') }}</p>
            </div>
            <div class="d-flex align-content-center flex-wrap gap-2">
                <button class="btn btn-outline-danger delete-order">Delete Order</button>
            </div>
        </div>

        <!-- Order Details Table -->

        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="card mb-6 mt-2">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title m-0">Order details</h5>
                        <h6 class="m-0"><a href=" javascript:void(0)">Edit</a></h6>
                    </div>
                    <div class="card-datatable table-responsive pb-5">
                        <table class="datatables-order-details table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="w-50">Books</th>
                                    <th>price</th>
                                    <th>qty</th>
                                    <th>total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->items as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if ($item->book->image)
                                                <a download href="{{ asset($item->book->image) }}">
                                                    <img width="30" height="30" class="rounded-circle"
                                                        src="{{ asset($item->book->image) }}" alt="">
                                                </a>
                                            @endif
                                            {{ $item->book->name }}
                                        </td>
                                        <td>{{ $item->book->price }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>{{ $item->qty * $item->book->price }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end align-items-center m-4 p-1 mb-0 pb-0">
                            <div class="order-calculations">
                                <div class="d-flex justify-content-start gap-4">
                                    <span class="w-px-100 text-heading">Subtotal:</span>
                                    <h6 class="mb-0">{{ $order->sub_total }}</h6>
                                </div>
                                <div class="d-flex justify-content-start gap-4">
                                    <span class="w-px-100 text-heading">Tax:</span>
                                    <h6 class="mb-0">{{ $order->tax }}</h6>
                                </div>
                                <div class="d-flex justify-content-start gap-4">
                                    <span class="w-px-100 text-heading">Shippings:</span>
                                    <h6 class="mb-0">{{ $order->shipping }}</h6>
                                </div>
                                <div class="d-flex justify-content-start gap-4">
                                    <span class="w-px-100 text-heading">Discount:</span>
                                    <h6 class="mb-0">{{ $order->discount }}</h6>
                                </div>

                                <div class="d-flex justify-content-start gap-4">
                                    <h6 class="w-px-100 mb-0">Total:</h6>
                                    <h6 class="mb-0">{{ $order->total }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-6 mt-2">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="card-title m-0">Shipping activity</h5>
                        <a class="btn btn-outline-primary" href=" javascript:;" data-bs-toggle="modal"
                            data-bs-target="#editStatus">Change Status</a>
                    </div>
                    <div class="card-body mt-3">
                        <ul class="timeline pb-0 mb-0">
                            @foreach ($order->timelines as $timeline)
                                <li class="timeline-item timeline-item-transparent border-primary">
                                    <span class="timeline-point timeline-point-primary"></span>
                                    <div class="timeline-event">
                                        <div class="timeline-header mb-2">
                                            <h6 class="mb-0">{{ $timeline->status->name }}</h6>
                                            <small class="text-muted">{{ $timeline->created_at }}</small>
                                        </div>
                                        <p class="mt-1 mb-2">{{ $timeline->note }}</p>
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card mb-6 mt-2">
                    <div class="card-body">
                        <h5 class="card-title mb-6">Customer details</h5>
                        <div class="d-flex justify-content-start align-items-center mb-6">
                            <div class="avatar me-3">
                                <img src="{{ $order->user->avatar ? asset($order->user->avatar) : asset('dashboard/assets/img/avatars/1.png') }}"
                                    alt="Avatar" class="rounded-circle">
                            </div>
                            <div class="d-flex flex-column">
                                <a href="{{ route('users.edit', $order->user_id) }}">
                                    <h6 class="mb-0">{{ $order->user->name }}</h6>
                                </a>
                                <span>Customer ID: #{{ $order->user_id }}</span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-start align-items-center mb-6 mt-3">
                            <span
                                class="avatar rounded-circle bg-label-success me-3 d-flex align-items-center justify-content-center"><i
                                    class='mdi mdi-cart ri-24px'></i></span>
                            <h6 class="text-nowrap mb-0">{{ $order->user->orders->count() }} Orders</h6>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <h6 class="mb-1">Contact info</h6>
                            <h6 class="mb-1"><a href=" javascript:;" data-bs-toggle="modal"
                                    data-bs-target="#editUser">Edit</a></h6>
                        </div>
                        <p class="mb-1">Email: {{ $order->user->email }}</p>
                        <p class="mb-0">Mobile: {{ $order->user->phone }}</p>
                    </div>
                </div>

                <div class="card mb-6 mt-2">

                    <div class="card-header d-flex justify-content-between">
                        <h5 class="card-title mb-1">Shipping address</h5>
                        <h6 class="m-0"><a href=" javascript:void(0)" data-bs-toggle="modal"
                                data-bs-target="#addNewAddress">Edit</a></h6>
                    </div>
                    <div class="card-body">
                        <p class="mb-0">
                            {{ $order->address }}
                        </p>
                    </div>

                </div>

                <div class="card mb-6 mt-2">
                    <div class="card-header d-flex justify-content-between pb-0">
                        <h5 class="card-title mb-1">Payment Details</h5>
                        <h6 class="m-0"><a href=" javascript:void(0)" data-bs-toggle="modal"
                                data-bs-target="#modifyPaymentMethod">Edit</a></h6>
                    </div>
                    <div class="card-body">
                        <h5 class="mb-1">Payment method:</h5>
                        <p class="mb-0">{{ $order->paymentMethod }}</p>
                        <h5 class="mb-1 mt-3">Payment Status:</h5>
                        <p class="mb-0">{{ $order->paymentStatus }}</p>
                    </div>

                </div>
            </div>
        </div>

        <!-- Edit User Modal -->
        <div class="modal fade" id="editStatus" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body p-0">
                        <div class="text-center mb-6">
                            <h4 class="mb-2">Edit Order Status</h4>
                            <p class="mb-6">Updating order status will receive a privacy audit.</p>
                        </div>
                        <form id="editStatusForm" class="row g-5" method="post"
                            action="{{ route('orders.update', $order->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="col-12">
                                <div class="form-floating form-floating-outline">
                                    <select id="selectStatusSelect" name="order_status_id" class="form-select"
                                        aria-label="Default select example">
                                        @foreach ($orderStatuses as $status)
                                            <option value="{{ $status->id }}"
                                                @if ($order->order_status_id == $status->id) selected @endif>{{ $status->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="selectStatusSelect">Status</label>
                                </div>
                            </div>

                            <div class="col-12 text-center d-flex flex-wrap justify-content-center gap-4 row-gap-4">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                    aria-label="Close">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Edit User Modal -->

        <!-- Edit User Modal -->
        <div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body p-0">
                        <div class="text-center mb-6">
                            <h4 class="mb-2">Edit User Information</h4>
                            <p class="mb-6">Updating user details will receive a privacy audit.</p>
                        </div>
                        <form id="editUserForm" class="row g-5" method="POST"
                            action="{{ route('orders.update', $order->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="col-12">
                                <div class="form-floating form-floating-outline">
                                    <select id="userSelect" name="user_id" class="form-select"
                                        aria-label="Default select example">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                @if ($order->user_id == $user->id) selected @endif> {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="userSelect">Users</label>
                                </div>
                            </div>
                            <div class="col-12 text-center d-flex flex-wrap justify-content-center gap-4 row-gap-4">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                    aria-label="Close">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Edit User Modal -->

        <!-- Add New Address Modal -->
        <div class="modal fade" id="addNewAddress" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-simple modal-add-new-address">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body p-0">
                        <div class="text-center mb-6">
                            <h4 class="address-title mb-2">Add New Address</h4>
                            <p class="address-subtitle">Add new address for express delivery</p>
                        </div>
                        <form id="addNewAddressForm" class="row g-5" action="{{ route('orders.update', $order->id) }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <div class="col-12 mt-6">
                                <div class="form-group form-switch">
                                    <label for="billingAddress">shipping address</label>
                                    <textarea class="form-control" name="address" id="billingAddress">{{ $order->address }}</textarea>
                                </div>
                            </div>
                            <div class="col-12 mt-6 d-flex flex-wrap justify-content-center gap-4 row-gap-4">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                    aria-label="Close">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Add New Address Modal -->

        <!-- Add New Address Modal -->
        <div class="modal fade" id="modifyPaymentMethod" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-simple modal-add-new-address">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body p-0">
                        <div class="text-center mb-6">
                            <h4 class="address-title mb-2">Payment Details</h4>
                            <p class="address-subtitle">change payment details</p>
                        </div>
                        <form id="modifyPaymentMethodForm" class="row g-5"
                            action="{{ route('orders.update', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="col-12">
                                <div class="form-floating form-floating-outline">
                                    <select id="userSelect" name="payment_method" class="form-select"
                                        aria-label="Default select example">
                                        <option value="0" @if ($order->payment_method == 'online payment method') selected @endif>
                                            {{ __('online payment method') }}</option>
                                        <option value="1" @if ($order->payment_method == 'bank transfer method') selected @endif>
                                            {{ __(' bank transfer method	') }}</option>
                                    </select>
                                    <label for="userSelect">Payment Method</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" name="transaction_id" id="transaction_id" class="form-control"
                                        value="{{ $order->transaction_id }}">
                                    <label for="transaction_id">Transaction ID</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating form-floating-outline">
                                    <input type="file" name="transaction_image" id="transaction_image"
                                        class="form-control">
                                    <label for="transaction_image">Bank Transfer Image</label>
                                </div>
                                <img width="100" height="100" src="{{ asset($order->transaction_image) }}" alt="">
                            </div>





                            <div class="col-12">
                                <div class="form-floating form-floating-outline">
                                    <select id="userSelect" name="payment_status" class="form-select"
                                        aria-label="Default select example">
                                        <option value="0" @if ($order->payment_status == 'pending') selected @endif>
                                            {{ __('pending') }}</option>
                                        <option value="1" @if ($order->payment_status == 'paid') selected @endif>
                                            {{ __('paid') }}</option>
                                        <option value="2" @if ($order->payment_status == 'failed') selected @endif>
                                            {{ __('failed') }}</option>
                                        <option value="3" @if ($order->payment_status == 'Refunded') selected @endif>
                                            {{ __('Refunded') }}</option>

                                    </select>
                                    <label for="userSelect">Payment Status</label>
                                </div>
                            </div>


                            <div class="col-12 mt-6 d-flex flex-wrap justify-content-center gap-4 row-gap-4">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                    aria-label="Close">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Add New Address Modal -->
    </div>
@endsection
