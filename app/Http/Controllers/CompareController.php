<?php

namespace App\Http\Controllers;

use App\Exports\InventoryExport;
use App\Models\NewProduct;
use App\Models\OldProduct;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;


/**
 * Class CompareController
 * @package App\Http\Controllers
 */
class CompareController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * show results
     */
    public function index()
    {
        $items = $this->getResults();

        return view('compare.results', compact(
           'items'
        ));

    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     * Download array to excel
     */
    public function download(){
        $items = $this->getResults();
        return Excel::download(new InventoryExport($items), 'inventory.xlsx');
    }


    /**
     * @return array
     * Get the results from inventory
     */
    private function getResults() : array
    {
        $oldProducts = OldProduct::all()->toArray();

        $newProducts = NewProduct::all()->toArray();

        $items = [];

        foreach ($newProducts as $newProduct){

            $encontrado = false;

            foreach ($oldProducts as $oldProduct){
                $product = [];

                if($newProduct['key'] == $oldProduct['key']){

                    $encontrado = true;
                    $newProduct['old_quantity_on_hand'] = $oldProduct['quantity_on_hand'];

                    if($newProduct['quantity_on_hand'] == $oldProduct['quantity_on_hand']){
                        $product['key'] = $newProduct['key'];
                        $product['quantity old'] = $oldProduct['quantity_on_hand'] ?? '0';
                        $product['quantity'] = $newProduct['quantity_on_hand'] ?? '0';
                        $product['status'] = 'without changes';
                        $items[] = $product;

                    }elseif ($newProduct['quantity_on_hand'] > $oldProduct['quantity_on_hand']){

                        $product['key'] = $newProduct['key'];
                        $product['quantity old'] = $oldProduct['quantity_on_hand'] ?? '0';
                        $product['quantity'] = $newProduct['quantity_on_hand'] ?? '0';
                        $product['status'] = 'update increments';
                        $items[] = $product;

                    }else{

                        $product['key'] = $newProduct['key'];
                        $product['quantity old'] = $oldProduct['quantity_on_hand'] ?? '0';
                        $product['quantity'] = $newProduct['quantity_on_hand'] ?? '0';
                        $product['status'] = 'update decrements';
                        $items[] = $product;


                    }

                }
            }

            if(!$encontrado){
                $product['key'] = $newProduct['key'];
                $product['quantity old'] = '0';
                $product['quantity'] = $newProduct['quantity_on_hand']  ?? '0';
                $product['status'] = 'new stock';
                $items[] = $product;
            }
        }



        foreach($oldProducts as $oldProduct) {

            $encontrado = false;

            foreach ($newProducts as $newProduct) {
                if ($oldProduct['key'] == $newProduct['key']) {
                    $encontrado = true;
                    break;
                }
            }

            if(!$encontrado){
                $product['key'] = $oldProduct['key'];
                $product['quantity old'] = $oldProduct['quantity_on_hand'] ?? '0';
                $product['quantity'] = '0';
                $product['status'] = 'without stock';
                $items[] = $product;

            }
        }

        return $items;
    }
}
