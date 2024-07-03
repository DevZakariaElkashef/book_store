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
            class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 gap-6">

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
                <div class="card mb-6">
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
                                                    <img width="50" class="rounded-circle" src="{{ asset($item->book->image) }}" alt="">
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
                                    <h6 class="mb-0">{{ $order->subTotalWithTax() }}</h6>
                                </div>
                                <div class="d-flex justify-content-start gap-4">
                                    <span class="w-px-100 text-heading">Discount:</span>
                                    <h6 class="mb-0"></h6>
                                </div>

                                <div class="d-flex justify-content-start gap-4">
                                    <h6 class="w-px-100 mb-0">Total:</h6>
                                    <h6 class="mb-0">$5100.25</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-6">
                    <div class="card-header">
                        <h5 class="card-title m-0">Shipping activity</h5>
                    </div>
                    <div class="card-body mt-3">
                        <ul class="timeline pb-0 mb-0">
                            <li class="timeline-item timeline-item-transparent border-primary">
                                <span class="timeline-point timeline-point-primary"></span>
                                <div class="timeline-event">
                                    <div class="timeline-header mb-2">
                                        <h6 class="mb-0">Order was placed (Order ID: #32543)</h6>
                                        <small class="text-muted">Tuesday 11:29 AM</small>
                                    </div>
                                    <p class="mt-1 mb-2">Your order has been placed successfully</p>
                                </div>
                            </li>
                            <li class="timeline-item timeline-item-transparent border-primary">
                                <span class="timeline-point timeline-point-primary"></span>
                                <div class="timeline-event">
                                    <div class="timeline-header mb-2">
                                        <h6 class="mb-0">Pick-up</h6>
                                        <small class="text-muted">Wednesday 11:29 AM</small>
                                    </div>
                                    <p class="mt-1 mb-2">Pick-up scheduled with courier</p>
                                </div>
                            </li>
                            <li class="timeline-item timeline-item-transparent border-primary">
                                <span class="timeline-point timeline-point-primary"></span>
                                <div class="timeline-event">
                                    <div class="timeline-header mb-2">
                                        <h6 class="mb-0">Dispatched</h6>
                                        <small class="text-muted">Thursday 11:29 AM</small>
                                    </div>
                                    <p class="mt-1 mb-2">Item has been picked up by courier</p>
                                </div>
                            </li>
                            <li class="timeline-item timeline-item-transparent border-primary">
                                <span class="timeline-point timeline-point-primary"></span>
                                <div class="timeline-event">
                                    <div class="timeline-header mb-2">
                                        <h6 class="mb-0">Package arrived</h6>
                                        <small class="text-muted">Saturday 15:20 AM</small>
                                    </div>
                                    <p class="mt-1 mb-2">Package arrived at an Amazon facility, NY</p>
                                </div>
                            </li>
                            <li class="timeline-item timeline-item-transparent border-left-dashed">
                                <span class="timeline-point timeline-point-primary"></span>
                                <div class="timeline-event">
                                    <div class="timeline-header mb-2">
                                        <h6 class="mb-0">Dispatched for delivery</h6>
                                        <small class="text-muted">Today 14:12 PM</small>
                                    </div>
                                    <p class="mt-1 mb-2">Package has left an Amazon facility, NY</p>
                                </div>
                            </li>
                            <li class="timeline-item timeline-item-transparent border-transparent pb-0">
                                <span class="timeline-point timeline-point-primary"></span>
                                <div class="timeline-event pb-0">
                                    <div class="timeline-header mb-2">
                                        <h6 class="mb-0">Delivery</h6>
                                    </div>
                                    <p class="mt-1 mb-2">Package will be delivered by tomorrow</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card mb-6">
                    <div class="card-body">
                        <h5 class="card-title mb-6">Customer details</h5>
                        <div class="d-flex justify-content-start align-items-center mb-6">
                            <div class="avatar me-3">
                                <img src="../../assets/img/avatars/1.png" alt="Avatar" class="rounded-circle">
                            </div>
                            <div class="d-flex flex-column">
                                <a href="app-user-view-account.html">
                                    <h6 class="mb-0">Shamus Tuttle</h6>
                                </a>
                                <span>Customer ID: #58909</span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-start align-items-center mb-6">
                            <span
                                class="avatar rounded-circle bg-label-success me-3 d-flex align-items-center justify-content-center"><i
                                    class='ri-shopping-cart-line ri-24px'></i></span>
                            <h6 class="text-nowrap mb-0">12 Orders</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-1">Contact info</h6>
                            <h6 class="mb-1"><a href=" javascript:;" data-bs-toggle="modal"
                                    data-bs-target="#editUser">Edit</a></h6>
                        </div>
                        <p class="mb-1">Email: Shamus889@yahoo.com</p>
                        <p class="mb-0">Mobile: +1 (609) 972-22-22</p>
                    </div>
                </div>

                <div class="card mb-6">

                    <div class="card-header d-flex justify-content-between">
                        <h5 class="card-title mb-1">Shipping address</h5>
                        <h6 class="m-0"><a href=" javascript:void(0)" data-bs-toggle="modal"
                                data-bs-target="#addNewAddress">Edit</a></h6>
                    </div>
                    <div class="card-body">
                        <p class="mb-0">45 Roker Terrace <br>Latheronwheel <br>KW5 8NW,London <br>UK</p>
                    </div>

                </div>
                <div class="card mb-6">
                    <div class="card-header d-flex justify-content-between pb-0">
                        <h5 class="card-title mb-1">Billing address</h5>
                        <h6 class="m-0"><a href=" javascript:void(0)" data-bs-toggle="modal"
                                data-bs-target="#addNewAddress">Edit</a></h6>
                    </div>
                    <div class="card-body">
                        <p class="mb-6">45 Roker Terrace <br>Latheronwheel <br>KW5 8NW,London <br>UK</p>
                        <h5 class="mb-1">Mastercard</h5>
                        <p class="mb-0">Card Number: ******4291</p>
                    </div>

                </div>
            </div>
        </div>

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
                        <form id="editUserForm" class="row g-5" onsubmit="return false">
                            <div class="col-12 col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="modalEditUserFirstName" name="modalEditUserFirstName"
                                        class="form-control" value="Oliver" placeholder="Oliver" />
                                    <label for="modalEditUserFirstName">First Name</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="modalEditUserLastName" name="modalEditUserLastName"
                                        class="form-control" value="Queen" placeholder="Queen" />
                                    <label for="modalEditUserLastName">Last Name</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="modalEditUserName" name="modalEditUserName"
                                        class="form-control" value="oliver.queen" placeholder="oliver.queen" />
                                    <label for="modalEditUserName">Username</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="modalEditUserEmail" name="modalEditUserEmail"
                                        class="form-control" value="oliverqueen@gmail.com"
                                        placeholder="oliverqueen@gmail.com" />
                                    <label for="modalEditUserEmail">Email</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <select id="modalEditUserStatus" name="modalEditUserStatus" class="form-select"
                                        aria-label="Default select example">
                                        <option value="1" selected>Active</option>
                                        <option value="2">Inactive</option>
                                        <option value="3">Suspended</option>
                                    </select>
                                    <label for="modalEditUserStatus">Status</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="modalEditTaxID" name="modalEditTaxID"
                                        class="form-control modal-edit-tax-id" placeholder="123 456 7890" />
                                    <label for="modalEditTaxID">Tax ID</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">US (+1)</span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" id="modalEditUserPhone" name="modalEditUserPhone"
                                            class="form-control phone-number-mask" value="+1 609 933 4422"
                                            placeholder="+1 609 933 4422" />
                                        <label for="modalEditUserPhone">Phone Number</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input id="TagifyLanguageSuggestion" name="TagifyLanguageSuggestion"
                                        class="form-control h-auto" placeholder="select language" value="English">
                                    <label for="TagifyLanguageSuggestion">Language</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <select id="modalEditUserCountry" name="modalEditUserCountry"
                                        class="select2 form-select" data-allow-clear="true">
                                        <option value="">Select</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Belarus">Belarus</option>
                                        <option value="Brazil">Brazil</option>
                                        <option value="Canada">Canada</option>
                                        <option value="China">China</option>
                                        <option value="France">France</option>
                                        <option value="Germany">Germany</option>
                                        <option value="India" selected>India</option>
                                        <option value="Indonesia">Indonesia</option>
                                        <option value="Israel">Israel</option>
                                        <option value="Italy">Italy</option>
                                        <option value="Japan">Japan</option>
                                        <option value="Korea">Korea, Republic of</option>
                                        <option value="Mexico">Mexico</option>
                                        <option value="Philippines">Philippines</option>
                                        <option value="Russia">Russian Federation</option>
                                        <option value="South Africa">South Africa</option>
                                        <option value="Thailand">Thailand</option>
                                        <option value="Turkey">Turkey</option>
                                        <option value="Ukraine">Ukraine</option>
                                        <option value="United Arab Emirates">United Arab Emirates</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                        <option value="United States">United States</option>
                                    </select>
                                    <label for="modalEditUserCountry">Country</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" id="editBillingAddress" />
                                    <label for="editBillingAddress" class="text-heading">Use as a billing address?</label>
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
                        <form id="addNewAddressForm" class="row g-5" onsubmit="return false">

                            <div class="col-12">
                                <div class="row g-5">
                                    <div class="col-md mb-md-0">
                                        <div class="form-check custom-option custom-option-basic">
                                            <label class="form-check-label custom-option-content" for="customRadioHome">
                                                <input name="customRadioTemp" class="form-check-input" type="radio"
                                                    value="" id="customRadioHome" checked />
                                                <span class="custom-option-header">
                                                    <span class="h6 mb-0 d-flex align-items-center"><i
                                                            class="ri-home-smile-2-line ri-20px me-1"></i>Home</span>
                                                </span>
                                                <span class="custom-option-body">
                                                    <small>Delivery time (9am – 9pm)</small>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md mb-md-0">
                                        <div class="form-check custom-option custom-option-basic">
                                            <label class="form-check-label custom-option-content" for="customRadioOffice">
                                                <input name="customRadioTemp" class="form-check-input" type="radio"
                                                    value="" id="customRadioOffice" />
                                                <span class="custom-option-header">
                                                    <span class="h6 mb-0 d-flex align-items-center"><i
                                                            class="ri-building-line ri-20px me-1"></i>Office</span>
                                                </span>
                                                <span class="custom-option-body">
                                                    <small>Delivery time (9am – 5pm) </small>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="modalAddressFirstName" name="modalAddressFirstName"
                                        class="form-control" placeholder="John" />
                                    <label for="modalAddressFirstName">First Name</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="modalAddressLastName" name="modalAddressLastName"
                                        class="form-control" placeholder="Doe" />
                                    <label for="modalAddressLastName">Last Name</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating form-floating-outline">
                                    <select id="modalAddressCountry" name="modalAddressCountry"
                                        class="select2 form-select" data-allow-clear="true">
                                        <option value="">Select</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Belarus">Belarus</option>
                                        <option value="Brazil">Brazil</option>
                                        <option value="Canada">Canada</option>
                                        <option value="China">China</option>
                                        <option value="France">France</option>
                                        <option value="Germany">Germany</option>
                                        <option value="India">India</option>
                                        <option value="Indonesia">Indonesia</option>
                                        <option value="Israel">Israel</option>
                                        <option value="Italy">Italy</option>
                                        <option value="Japan">Japan</option>
                                        <option value="Korea">Korea, Republic of</option>
                                        <option value="Mexico">Mexico</option>
                                        <option value="Philippines">Philippines</option>
                                        <option value="Russia">Russian Federation</option>
                                        <option value="South Africa">South Africa</option>
                                        <option value="Thailand">Thailand</option>
                                        <option value="Turkey">Turkey</option>
                                        <option value="Ukraine">Ukraine</option>
                                        <option value="United Arab Emirates">United Arab Emirates</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                        <option value="United States">United States</option>
                                    </select>
                                    <label for="modalAddressCountry">Country</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="modalAddressAddress1" name="modalAddressAddress1"
                                        class="form-control" placeholder="12, Business Park" />
                                    <label for="modalAddressAddress1">Address Line 1</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="modalAddressAddress2" name="modalAddressAddress2"
                                        class="form-control" placeholder="Mall Road" />
                                    <label for="modalAddressAddress2">Address Line 2</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="modalAddressLandmark" name="modalAddressLandmark"
                                        class="form-control" placeholder="Nr. Hard Rock Cafe" />
                                    <label for="modalAddressLandmark">Landmark</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="modalAddressCity" name="modalAddressCity"
                                        class="form-control" placeholder="Los Angeles" />
                                    <label for="modalAddressCity">City</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="modalAddressState" name="modalAddressState"
                                        class="form-control" placeholder="California" />
                                    <label for="modalAddressLandmark">State</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="modalAddressZipCode" name="modalAddressZipCode"
                                        class="form-control" placeholder="99950" />
                                    <label for="modalAddressZipCode">Zip Code</label>
                                </div>
                            </div>
                            <div class="col-12 mt-6">
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" id="billingAddress" />
                                    <label for="billingAddress">Use as a billing address?</label>
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
