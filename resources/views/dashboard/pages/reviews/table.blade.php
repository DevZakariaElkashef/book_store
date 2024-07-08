<div class="card-datatable table-responsive" id="review-list">

    <table class="table">
        <thead class="table-light">
            <tr>
                <th>
                    <input class="form-check-input select-all" type="checkbox">
                </th>
                <th>{{ __('Book') }}</th>
                <th>{{ __('Customer') }}</th>
                <th>{{ __('Review') }}</th>
                <th>{{ __('Date') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reviews as $review)
                <tr class="odd">
                    <td>
                        <input class="form-check-input item" value="{{ $review->id }}" type="checkbox">
                    </td>




                    <td class="sorting_1">
                        <div class="d-flex justify-content-start align-items-center customer-name">
                            <div class="avatar-wrapper">
                                <div class="avatar me-3 rounded bg-lighter">
                                    <a href="{{ asset($review->orderItem->book->image) }}" download>
                                        <img src="{{ asset($review->orderItem->book->image) }}" alt="Product-15"
                                            class="rounded-2">
                                    </a>
                                </div>
                            </div>
                            <div class="d-flex flex-column"><span
                                    class="text-nowrap text-heading fw-medium">{{ $review->orderItem->book->name }}</span><small>{{ Str::limit($review->orderItem->book->description, 10) }}</small>
                            </div>
                        </div>
                    </td>


                    <td>
                        <div class="d-flex justify-content-start align-items-center customer-name">
                            <div class="avatar-wrapper me-3">
                                <div class="avatar avatar-sm">
                                    <a href="{{ asset($review->orderitem->order->user->avatar) }}" download>
                                        <img src="{{ asset($review->orderitem->order->user->avatar) }}" alt="Avatar"
                                            class="rounded-circle">
                                    </a>
                                </div>
                            </div>
                            <div class="d-flex flex-column"><a
                                    href="{{ route('users.edit', $review->orderitem->order->user_id) }}"><span
                                        class="fw-medium">{{ $review->orderitem->order->user->name }}</span></a><small
                                    class="text-nowrap">{{ $review->orderitem->order->user->email }}</small></div>
                        </div>
                    </td>
                    <td>
                        <div>
                            <div class="read-only-ratings ps-0 mb-2 jq-ry-container" readonly="readonly"
                                style="width: 120px;">
                                <div class="jq-ry-group-wrapper">
                                    <div class="jq-ry-rated-group jq-ry-group d-flex">
                                        @for ($i = 0; $i < $review->star; $i++)
                                            <svg width="24px" height="24px" viewBox="0 0 24 24" fill="#f39c12"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M12 17L6.12199 20.59L7.71999 13.89L2.48999 9.41L9.35499 8.86L12 2.5L14.645 8.86L21.511 9.41L16.28 13.89L17.878 20.59L12 17Z">
                                                </path>
                                            </svg>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <small class="text-break pe-3">
                                {{ $review->comment }}
                            </small>
                        </div>
                    </td>
                    <td><span class="text-nowrap">{{ $review->created_at }}</span></td>
                    <td>
                        @if ($review->is_active)
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
                                @can('reviews.update')
                                    <a class="dropdown-item waves-effect edit-btn" href="#" data-bs-toggle="modal"
                                        data-url="{{ route('reviews.update', $review->id) }}"
                                        data-star="{{ $review->star }}" data-comment="{{ $review->comment }}"
                                        data-bs-target="#editModal"><i class="mdi mdi-pencil-outline me-1"></i>
                                        {{ __('Edit') }}</a>
                                @endcan

                                @can('reviews.delete')
                                    <a class="dropdown-item waves-effect delete-btn" href="javascript:void(0);"
                                        data-url="{{ route('reviews.destroy', $review->id) }}" data-bs-toggle="modal"
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
        {{ $reviews->links() }}
    </div>
</div>
