<?php

namespace App;

class Basket
{
    private $items = [];
    private $total = 0;
    
    
    
    /**
     * __construct
     * Allows creating a new cart from another
     * 
     * @param mixed Basket
     * @return void
     */
    public function __construct($basket) 
    {
        if ($basket) {
            $this->items = $basket->items;
            $this->total = $basket->total;    
        }
    }

    public function add($item)
    {        
        $id = $item['id'];
        $newItem = [
            'name' => $item['name'],
            'quantity' => $item['quantity'],
            'price' => $item['price'],
        ];

        if ($this->items && array_key_exists($id, $this->items) ) {
            $newItem = $this->items[$id];
            $newItem['quantity'] += $item['quantity'];
        }

        
        $this->items[$id] = $newItem;
        $this->total += $newItem['price'] * $newItem['quantity'];        
    }

    public function update($item)
    {
        $this->add($item);
    }

    public function delete($id)
    {
        $this->total -= $this->items[$id]['price'] * $this->items[$id]['quantity'];
        unset($this->items[$id]);        
    }

    public function empty()
    {
        unset($this->items);
        $this->total = 0;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function getTotal()
    {
        return $this->total;
    }
}
