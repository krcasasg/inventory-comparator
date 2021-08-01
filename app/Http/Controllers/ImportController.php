<?php

namespace App\Http\Controllers;

use App\Imports\OldProductsImport;
use App\Imports\NewProductsImport;
use App\Models\Option;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class ImportController
 * @package App\Http\Controllers
 */
class ImportController extends Controller
{
    /**
     * @param Request $request
     * @return string
     */
    public function old(Request $request)
    {
        $option = Option::firstOrCreate(
            ['name' => 'primary_key_old'],
            ['value' => $request->input('primary_key_old')]
        );


        try{
            Excel::queueImport(new OldProductsImport(), $request->file('products_old_file'));
            //$import = new OldProductsImport();
            //$import->queueImport($request->file('products_old_file'));

            return redirect()->back()->with('success', 'Old inventory was imported');

        }catch (\Exception $e) {
            return redirect()->back()->with('errors', 'Error. Can`t load information in the database. '. $e->getMessage());
        }catch (\Error $e){
            return redirect()->back()->with('errors', 'Error. Can`t load information in the database. '. $e->getMessage());
        }


    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function new(Request $request)
    {
        $option = Option::firstOrCreate(
            ['name' => 'primary_key_new'],
            ['value' => $request->input('primary_key_new')]
        );

        try{
            Excel::queueImport(new NewProductsImport(), $request->file('products_new_file'));
            //$import = new NewProductsImport();
            //$import->import($request->file('products_new_file'));
            return redirect()->back()->with('success', 'New inventory was imported');

        }catch (\Exception $e) {
            return redirect()->back()->with('errors', 'Exception. Can`t load information in the database. '. $e->getMessage());
        }catch (\Error $e){
            return redirect()->back()->with('errors', 'Error. Can`t load information in the database. '. $e->getMessage());
        }

    }
}
