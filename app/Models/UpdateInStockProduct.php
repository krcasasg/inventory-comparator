<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpdateInStockProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'key',
        'quantity_on_hand_before',
        'quantity_on_hand'
    ];
    protected $table = 'update_in_stock_products';
    protected $primaryKey = 'key';

}
