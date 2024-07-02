<?php



namespace App\Services;

use App\Models\BookReview;
use Illuminate\Http\Request;

class BookReviewService
{
    public function createOrUpdateReview(Request $request)
    {
        $check = BookReview::where('order_item_id', $request->order_item_id)
            ->where('order_item_id', $request->order_item_id)
            ->first();

        if ($check) {
            $check->update([
                'star' => $request->star,
                'comment' => $request->comment,
            ]);
            return __("review updated success");
        } else {
            BookReview::create($request->all());
            return __("add review success");
        }
    }
}
