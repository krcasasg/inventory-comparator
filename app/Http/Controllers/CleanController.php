<?php

namespace App\Http\Controllers;

use App\Models\NewInStockProduct;
use App\Models\NewProduct;
use App\Models\OldProduct;
use App\Models\Option;
use App\Models\UpdateInStockProduct;
use App\Models\WithoutStockProduct;
use Illuminate\Http\Request;

/**
 * Class CleanController
 * @package App\Http\Controllers
 */
class CleanController extends Controller
{
    public function __invoke()
    {
        NewProduct::query()->truncate();
        OldProduct::query()->truncate();
        NewInStockProduct::query()->truncate();
        UpdateInStockProduct::query()->truncate();
        WithoutStockProduct::query()->truncate();
        Option::where('name', 'primary_key_old')->delete();
        Option::where('name', 'primary_key_new')->delete();
        return redirect()->back()->with('success', 'Old products table cleared, New product table cleared');
    }
}
