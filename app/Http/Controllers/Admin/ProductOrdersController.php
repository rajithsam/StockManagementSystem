<?php

namespace App\Http\Controllers\Admin;

use App\ProductOrder;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductOrdersRequest;
use App\Http\Requests\Admin\UpdateProductOrdersRequest;

class ProductOrdersController extends Controller
{
    /**
     * Display a listing of ProductOrder.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('product_order_access')) 
        {
            return abort(401);
        }


        if (request('show_deleted') == 1) 
        {
            if (! Gate::allows('product_order_delete')) 
            {
                return abort(401);
            }
            $product_orders = ProductOrder::onlyTrashed()->get();
        } else {
            $product_orders = ProductOrder::all();
        }

        return view('admin.product_orders.index', compact('product_orders'));
    }

    /**
     * Show the form for creating new ProductOrder.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('product_order_create')) {
            return abort(401);
        }
        
        $products = \App\Product::get()->pluck('product_name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.product_orders.create', compact('products'));
    }

    /**
     * Store a newly created ProductOrder in storage.
     *
     * @param  \App\Http\Requests\StoreProductOrdersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductOrdersRequest $request)
    {
        if (! Gate::allows('product_order_create')) 
        {
            return abort(401);
        }

        $product_order = ProductOrder::create($request->all());

        $product = Product::find( $product_order->product_id );
        
        $product->in_stock +=  $product_order->quantity;
        
        $product->save();

        return redirect()->route('admin.product_orders.index');
    }


    /**
     * Show the form for editing ProductOrder.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('product_order_edit')) 
        {
            return abort(401);
        }
        
        $products = \App\Product::get()->pluck('product_name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $product_order = ProductOrder::findOrFail($id);

        return view('admin.product_orders.edit', compact('product_order', 'products'));
    }

    /**
     * Update ProductOrder in storage.
     *
     * @param  \App\Http\Requests\UpdateProductOrdersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductOrdersRequest $request, $id)
    {
        if (! Gate::allows('product_order_edit')) {
            return abort(401);
        }
        $product_order = ProductOrder::findOrFail($id);
        $product_order->update($request->all());



        return redirect()->route('admin.product_orders.index');
    }


    /**
     * Display ProductOrder.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('product_order_view')) {
            return abort(401);
        }
        $product_order = ProductOrder::findOrFail($id);

        return view('admin.product_orders.show', compact('product_order'));
    }


    /**
     * Remove ProductOrder from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('product_order_delete')) {
            return abort(401);
        }
        $product_order = ProductOrder::findOrFail($id);
        $product_order->delete();

        return redirect()->route('admin.product_orders.index');
    }

    /**
     * Delete all selected ProductOrder at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('product_order_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = ProductOrder::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore ProductOrder from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('product_order_delete')) {
            return abort(401);
        }
        $product_order = ProductOrder::onlyTrashed()->findOrFail($id);
        $product_order->restore();

        return redirect()->route('admin.product_orders.index');
    }

    /**
     * Permanently delete ProductOrder from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('product_order_delete')) {
            return abort(401);
        }
        $product_order = ProductOrder::onlyTrashed()->findOrFail($id);
        $product_order->forceDelete();

        return redirect()->route('admin.product_orders.index');
    }
}
