<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\ActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes, ActiveScope;

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

    protected $with = ['notifications'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function cart()
    {
        return $this->hasOne(Cart::class)->where('type', 0);
    }

    public function favourite()
    {
        return $this->hasOne(Cart::class)->where('type', 1);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }


    public function getOrCreateCart()
    {
        $cart = $this->cart()->first();

        if (!$cart) {
            $cart = $this->cart()->create([
                'user_id' => $this->id,
                'type' => 0,
            ]);
        }

        return $cart;
    }

    public function getOrCreateFavourite()
    {
        $favourite = $this->favourite()->first();

        if (!$favourite) {
            $favourite = $this->favourite()->create([
                'user_id' => $this->id,
                'type' => 1,
            ]);
        }

        return $favourite;
    }


    public function addItemToFavourite(Book $book)
    {
        $favourite = $this->getOrCreateFavourite();
        $item = $favourite->items()->where('book_id', $book->id)->first();

        if (!$item) {
            $favourite->items()->create([
                "book_id" => $book->id,
            ]);
            return __("Book added to favourite successfully");
        } else {
            $item->delete();
            return __("Book removed from favourite successfully");
        }
    }


    public function addItemToCart(Book $book)
    {
        $cart = $this->getOrCreateCart();
        $item = $cart->items()->where('book_id', $book->id)->first();

        if (!$item) {
            $cart->items()->create([
                "book_id" => $book->id,
                "qty" => 1
            ]);
            return __("Book added to cart successfully");
        } else {
            $item->increment('qty');
            return __("Book's quantity increased successfully");
        }
    }
}
