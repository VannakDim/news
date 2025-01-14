<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use App\Models\StockOut;
use App\Models\StockOutDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class StockOutController extends Controller
{
    public function create()
    {
        $models = ProductModel::all();
        return view('admin.product.stockout.create',compact('models'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['supplier' => 'nullable', 'items' => 'required|json']);
        $stock_out = new StockOut();
        $stock_out->user_id = Auth::user()->id;
        $stock_out->receiver = $request->receiver;
        $stock_out->type = $request->type;
        $stock_out->note = $request->note;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('image/product/stock_out/'), $name_gen);
            $stock_out->image = 'image/product/stock_out/' . $name_gen;
            // Simulate a long process (e.g., 5 seconds)
            sleep(1);
        }
        $stock_out->save();

        // Decode the items JSON
        $items = json_decode($request->input('items'), true);

        // Loop through the items and save them to the database
        foreach ($items as $item) {
            StockOutDetail::create([
                'stock_out_id' => $stock_out->id,
                'product_model_id' => $item['model_id'],
                'quantity' => $item['quantity'],
            ]);
        }
        return response()->json(['message' => 'Successful!']);
    }
}
