<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\Resource;

class ProductCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        $totalPrice = (1 - $this->discount / 100) * $this->price;

        return [
            'name' => $this->name,
            'discount' => $this->discount,
            'totalPrice' => $totalPrice,
            'href' => [
              'link' => route('products.show', $this->id),
          ],
        ];}
}
