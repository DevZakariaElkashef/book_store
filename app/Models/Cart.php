<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }


    public function items()
    {
        return $this->hasMany(CartItem::class);
    }
    public static function totalCart($userId)
    {
        $sum = 0;

        // Fetch the cart for the specified user
        $cart = self::where('user_id', $userId)->first();
        if ($cart) {
            // Loop through the items in the cart and calculate the sum
            foreach ($cart->items as $item) {

                $price = hasOffer($item->book_id) ? $item->book->offer : $item->book->price;

                $sum += $price * $item->qty;
            }
        }

        // Return the total sum
        return $sum;
    }
}
