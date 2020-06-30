<?php

namespace App;

use App\OrderItem;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = ['id'];
    
    public function orderItem()
    {
        return $this->hasMany(OrderItem::class, 'order_id')->latest('updated_at');
    }
}
