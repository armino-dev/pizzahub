<?php

namespace App;

use App\OrderItem;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = ['id'];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id')->latest('updated_at');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function addItem($item)
    {
        return $this->orderItems()->create($item);
    }

    public function addItems($items)
    {
        return $this->orderItems()->createMany($items);
    }
}
