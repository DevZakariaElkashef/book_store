<?php

namespace App\Http\Controllers\Site;

use App\Models\BookReview;
use Illuminate\Http\Request;
use App\Services\BookReviewService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Site\ReviewBookRequest;

class ReviewController extends Controller
{
    protected $bookReviewService;

    public function __construct(BookReviewService $bookReviewService)
    {
        $this->bookReviewService = $bookReviewService;
    }
    public function store(ReviewBookRequest $request)
    {
        $message = $this->bookReviewService->createOrUpdateReview($request);

        session()->flash('message', [
            'status' => true,
            'content' => $message,
        ]);

        return redirect()->back();
    }
}
