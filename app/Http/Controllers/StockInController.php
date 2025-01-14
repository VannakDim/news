<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductModel;
use App\Models\StockIn;
use App\Models\StockInDetail;

class StockInController extends Controller
{

    public function create()
    {
        $models = ProductModel::all();
        return view('admin.product.stockin.create', compact('models'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['supplier' => 'nullable', 'items' => 'required|json']);
        $stock_in = new StockIn();
        $stock_in->user_id = Auth::user()->id;
        $stock_in->invoice_no = $request->invoice_no;
        $stock_in->supplier = $request->supplier;
        $stock_in->note = $request->note;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('image/product/stock_in/'), $name_gen);
            $stock_in->image = 'image/product/stock_in/' . $name_gen;
            // Simulate a long process (e.g., 5 seconds)
            sleep(1);
        }
        $stock_in->save();

        // Decode the items JSON
        $items = json_decode($request->input('items'), true);

        // Loop through the items and save them to the database
        foreach ($items as $item) {
            StockInDetail::create([
                'stock_in_id' => $stock_in->id,
                'product_model_id' => $item['model_id'],
                'quantity' => $item['quantity'],
            ]);
        }
        return response()->json(['message'=> 'Successful!']);
    }
}
