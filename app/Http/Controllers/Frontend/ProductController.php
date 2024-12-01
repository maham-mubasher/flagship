<?php

namespace App\Http\Controllers\Frontend;

use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\MeasurementUnit;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $productDataTable)
    {
        return $productDataTable->render('pages.products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = new Product();
        $measurementUnits = MeasurementUnit::all();
        $units = Unit::all();
        $countries = Country::all();

        return view('pages.products.create', compact('product', 'units', 'measurementUnits', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'hs_code' => 'required|string',
            'weight' => 'required|string',
            'reference' => 'required|string',
            'unit_price' => 'required|string',
            'country_id' => 'required|exists:countries,id',
            'measurement_unit_id' => 'required|exists:measurement_units,id',
            'unit_id' => 'required|exists:units,id',
        ]);

        auth()->user()->products()->create($data);
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $measurementUnits = MeasurementUnit::all();
        $units = Unit::all();
        $countries = Country::all();

        return view('pages.products.edit', compact('product', 'units', 'measurementUnits', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'hs_code' => 'required|string',
            'weight' => 'required|string',
            'reference' => 'required|string',
            'unit_price' => 'required|string',
            'country_id' => 'required|exists:countries,id',
            'measurement_unit_id' => 'required|exists:measurement_units,id',
            'unit_id' => 'required|exists:units,id',
        ]);

        $product->update($data);
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
    }

    public function import()
    {
        return view('pages.products.import');
    }

    public function storeImport(Request $request)
    {
        $request->validate([
            'products_csv' => 'required|mimes:csv,txt'
        ]);

        try {
            //Set maximum php execution time
            ini_set('max_execution_time', 0);
            ini_set('memory_limit', -1);

            if ($request->hasFile('products_csv')) {

                $file = $request->file('products_csv');
                $parsedArray = Excel::toArray([], $file);

                //Remove header row
                $importedData = array_splice($parsedArray[0], 1);

                $totalRows = count($importedData);
                if ($totalRows > 500) {

                    return back()->withErrors([
                        'products_csv' => 'You can only upload max 500 rows per csv file'
                    ]);
                } elseif(!$totalRows) {

                    return back()->withErrors([
                        'products_csv' => 'Csv file is empty, please add some rows'
                    ]);
                }

                \DB::beginTransaction();
                $errorMessage = '';
                $indexes = ["name", "description", "hs_code", "country_id", "weight", "measurement_unit_id", "reference", "unit_price", "unit_id"];
                foreach ($importedData as $key => $row) {

                    if (count($row) < 9) {

                        return back()->withErrors(['Some of the columns are missing. Please, use latest CSV file template(check row no:'.($key+1).').']);
                    }

                    $data = array();
                    foreach ($indexes as $k => $v) {
                        $data[$v] = $row[$k];
                    }

                    $validator = \Validator::make($data, [
                        'name' => 'required',
                        'description' => 'required',
                        'hs_code' => 'required',
                        'weight' => 'required',
                        'reference' => 'required',
                        'unit_price' => 'required',
                        'country_id' => 'required|exists:countries,id',
                        'measurement_unit_id' => 'required|exists:measurement_units,id',
                        'unit_id' => 'required|exists:units,id',
                    ]);

                    if ($validator->fails()) {

                        session()->flash('errorIndex', $key+1);
                        return back()
                            ->withErrors($validator->errors());
                    }

                    auth()->user()->products()->create($data);
                }

                \DB::commit();

                return redirect()->route('products.index');
            }

        } catch(\Exception $exception) {

            \DB::rollBack();
            return back()->withErrors([
                'products_csv' => $exception->getMessage()
            ]);
        }
    }
}
