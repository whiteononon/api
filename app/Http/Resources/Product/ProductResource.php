<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\Resource;

class ProductResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        if ($this->reviews->count() > 0) {
            $rating = round($this->reviews->sum('star') / $this->reviews->count(), 1);
        } else {
            $rating = 'No rating yet';
        }

        if ($this->stock != 0) {
            $stock = $this->stock;
        } else {
            $stock = 'Out of Stock';
        }

        $totalPrice = (1 - $this->discount / 100) * $this->price;

        return [
            'name' => $this->name,
            'description' => $this->detail,
            'price' => $this->price,
            'stock' => $stock,
            'discount' => $this->discount,
            'totalPrice' => $totalPrice,
            'rating' => $rating,
            'href' => [
                'reviews' => route('reviews.index', $this->id),
            ],
        ];
    }
}
