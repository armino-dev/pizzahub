<?php

namespace App;

use App\OrderItem;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = ['id'];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id')->latest('updated_at');
    }

    public function addItem($item) {
        return $this->orderItems()->create($item);
    }

    public function addItems($items)
    {
        return $this->orderItems()->createMany($items);
    }

}
