<div class="card-datatable table-responsive" id="coupon-list">

    <table class="table">
        <thead class="table-light">
            <tr>
                <th>
                    <input class="form-check-input select-all" type="checkbox">
                </th>
                <th>ID</th>
                <th>{{ __('Code') }}</th>
                <th>{{ __('Discount') }}</th>
                <th>{{ __('Start At') }}</th>
                <th>{{ __('End At') }}</th>
                <th>{{ __('Max Times') }}</th>
                <th>{{ __('Used Times') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($coupons as $coupon)
                <tr>
                    <td>
                        <input class="form-check-input item" value="{{ $coupon->id }}" type="checkbox">
                    </td>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        {{ $coupon->code }}
                    </td>
                    <td>
                        {{ $coupon->discount . '%' }}
                    </td>
                    <td>
                        {{ $coupon->start_at }}
                    </td>
                    <td>
                        {{ $coupon->end_at }}
                    </td>
                    <td>
                        {{ $coupon->max_times }}
                    </td>
                    <td>
                        {{ $coupon->couponUsages->count() }}
                    </td>
                    <td>
                        @if ($coupon->is_active)
                            <span class="badge bg-label-primary">{{ __('Active') }}</span>
                        @else
                            <span class="badge bg-label-dark">{{ __('Not Active') }}</span>
                        @endif
                    </td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </button>
                            <div class="dropdown-menu" style="">
                                @can('coupons.update')
                                    <a class="dropdown-item waves-effect"
                                        href="{{ route('coupons.edit', $coupon->id) }}"><i
                                            class="mdi mdi-pencil-outline me-1"></i> {{ __('Edit') }}</a>
                                @endcan

                                @can('coupons.delete')
                                    <a class="dropdown-item waves-effect delete-btn" href="javascript:void(0);"
                                        data-url="{{ route('coupons.destroy', $coupon->id) }}" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal"><i class="mdi mdi-trash-can-outline me-1"></i>
                                        {{ __('Delete') }}</a>
                                @endcan
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-3 px-3">
        {{ $coupons->links() }}
    </div>
</div>
