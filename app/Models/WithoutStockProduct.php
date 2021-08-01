<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithoutStockProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'key',
        'quantity_on_hand'
    ];
    protected $table = 'whitout_stock_products';
    protected $primaryKey = 'key';
}
