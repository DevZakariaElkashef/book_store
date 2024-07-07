<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use App\Models\BookReview;
use Illuminate\Http\Request;
use App\Exports\BookReviewExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\Dashboard\UpdateReviewRequest;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('book_reviews.read');

        $reviewsQuery = BookReview::query();
        $reviewsQuery->latest();

        // Clone the query to calculate counts without date range filtering
        $countQuery = clone $reviewsQuery;

        if ($request->filled('from')) {
            $reviewsQuery->whereDate('created_at', '>', $request->from);
        }

        if ($request->filled('to')) {
            $reviewsQuery->whereDate('created_at', '<', $request->to);
        }

        $reviews = $reviewsQuery->paginate(10);

        $totalCount = $countQuery->count();

        $totalThisWeek = $countQuery->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();

        $total5Starts = BookReview::where("star", 5)->count();
        $total4Starts = BookReview::where("star", 4)->count();
        $total3Starts = BookReview::where("star", 3)->count();
        $total2Starts = BookReview::where("star", 2)->count();
        $total1Starts = BookReview::where("star", 1)->count();


        return view('dashboard.pages.reviews.index', compact('reviews', 'totalCount', 'totalThisWeek', 'total5Starts', 'total4Starts', 'total3Starts', 'total2Starts', 'total1Starts'));
    }

    public function search(Request $request)
    {
        $this->authorize('book_reviews.read');

        $query = BookReview::query();

        if ($request->has('val')) {
            $query->where(function ($q) use ($request) {
                $q->where('comment', 'like', '%' . $request->val . '%')
                    ->orWhereHas('orderItem', function ($item) use ($request) {
                        $item->whereHas('book', function ($book) use ($request) {
                            $book->where('name_ar', 'like', '%' . $request->val . '%')
                                ->orWhere('name_en', 'like', '%' . $request->val . '%')
                                ->orWhere('description_ar', 'like', '%' . $request->val . '%')
                                ->orWhere('description_en', 'like', '%' . $request->val . '%');
                        });
                    })
                    ->orWhereHas('orderItem.order', function ($order) use ($request) {
                        $order->whereHas('user', function ($user) use ($request) {
                            $user->where('name', 'like', '%' . $request->val . '%')
                                ->orWhere('email', 'like', '%' . $request->val . '%');
                        });
                    });
            });
        }

        $reviews = $query->paginate(10);

        return view('dashboard.pages.reviews.table', compact('reviews'))->render();
    }




    public function export()
    {
        $this->authorize('book_reviews.read');

        return Excel::download(new BookReviewExport, 'reviews.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort(404);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return to_route('reviews.edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('book_reviews.update');

        $review = BookReview::findOrFail($id);
        return view('dashboard.pages.reviews.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReviewRequest $request, string $id)
    {
        $this->authorize('book_reviews.update');

        $review = BookReview::findOrFail($id);

        $review->update($request->all());

        // retun with toaster message
        $message = [
            'status' => true,
            'content' => __('updated successfully')
        ];

        return to_route('reviews.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('book_reviews.delete');

        BookReview::where('id', $id)->delete();

        // retun with toaster message
        $message = [
            'status' => true,
            'content' => __('deleted successfully')
        ];

        return to_route('reviews.index')->with('message', $message);
    }

    public function delete(Request $request)
    {
        $this->authorize('book_reviews.delete');

        if (!$request->filled('ids')) {
            $message = [
                'status' => false,
                'content' => __('select some items')
            ];

            return back()->with('message', $message);
        }


        $ids = explode(',', $request->ids);
        BookReview::whereIn('id', $ids)->delete();
        $message = [
            'status' => true,
            'content' => __('deleted successfully')
        ];
        return back()->with('message', $message);
    }
}
