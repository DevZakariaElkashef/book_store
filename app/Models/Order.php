<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

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

    public function status()
    {
        return $this->belongsTo(OrderStatus::class, 'order_status_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function timelines()
    {
        return $this->hasMany(OrderTimeLine::class, 'order_id');
    }

    public function scopeSuccess($query)
    {
        return $query->where('payment_status', '!=', '2');
    }

    public function getPaymentMethodAttribute(): string
    {
        switch ($this->attributes['payment_method']) {
            case '0':
                return "online payment method";

            case '1':
                return "bank transfer method";


            default:
                return __("Unknown"); // Handle unexpected values gracefully
        }
    }


    public function getPaymentStatusAttribute(): string
    {
        switch ($this->attributes['payment_status']) {
            case '0':
                return __("pending");

            case '1':
                return __("paid");

            case '2':
                return __("failed");

            case '3':
                return __("Refunded");

            default:
                return __("Unknown"); // Handle unexpected values gracefully
        }
    }
}
