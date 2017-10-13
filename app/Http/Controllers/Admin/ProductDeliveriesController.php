<?php

namespace App\Http\Controllers\Admin;

use App\ProductDelivery;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductDeliveriesRequest;
use App\Http\Requests\Admin\UpdateProductDeliveriesRequest;

class ProductDeliveriesController extends Controller
{
    /**
     * Display a listing of ProductDelivery.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('product_delivery_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('product_delivery_delete')) {
                return abort(401);
            }
            $product_deliveries = ProductDelivery::onlyTrashed()->get();
        } else {
            $product_deliveries = ProductDelivery::all();
        }

        return view('admin.product_deliveries.index', compact('product_deliveries'));
    }

    /**
     * Show the form for creating new ProductDelivery.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('product_delivery_create')) {
            return abort(401);
        }
        
        $beleivers = \App\Believer::get()->pluck('first_name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $products = \App\Product::get()->pluck('product_name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.product_deliveries.create', compact('beleivers', 'products'));
    }

    /**
     * Store a newly created ProductDelivery in storage.
     *
     * @param  \App\Http\Requests\StoreProductDeliveriesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductDeliveriesRequest $request)
    {
        if (! Gate::allows('product_delivery_create')) {
            return abort(401);
        }

        $product = Product::find( $request->input('product_id') );
        
        if( $product->in_stock >= $request->input('quantity') )
        {
            $product->in_stock -=  $request->input('quantity');

            $product->save();

            $product_delivery = ProductDelivery::create($request->all());

            return redirect()->route('admin.product_deliveries.index');
        }
        else
        {
            return redirect()->route('admin.product_deliveries.index')->with('status', 'Sorry! You dont have Stock');
        }

        
    }


    /**
     * Show the form for editing ProductDelivery.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('product_delivery_edit')) {
            return abort(401);
        }
        
        $beleivers = \App\Believer::get()->pluck('first_name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $products = \App\Product::get()->pluck('product_name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $product_delivery = ProductDelivery::findOrFail($id);

        return view('admin.product_deliveries.edit', compact('product_delivery', 'beleivers', 'products'));
    }

    /**
     * Update ProductDelivery in storage.
     *
     * @param  \App\Http\Requests\UpdateProductDeliveriesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductDeliveriesRequest $request, $id)
    {
        if (! Gate::allows('product_delivery_edit')) {
            return abort(401);
        }
        $product_delivery = ProductDelivery::findOrFail($id);
        $product_delivery->update($request->all());



        return redirect()->route('admin.product_deliveries.index');
    }


    /**
     * Display ProductDelivery.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('product_delivery_view')) {
            return abort(401);
        }
        $product_delivery = ProductDelivery::findOrFail($id);

        return view('admin.product_deliveries.show', compact('product_delivery'));
    }


    /**
     * Remove ProductDelivery from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('product_delivery_delete')) {
            return abort(401);
        }
        $product_delivery = ProductDelivery::findOrFail($id);
        $product_delivery->delete();

        return redirect()->route('admin.product_deliveries.index');
    }

    /**
     * Delete all selected ProductDelivery at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('product_delivery_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = ProductDelivery::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore ProductDelivery from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('product_delivery_delete')) {
            return abort(401);
        }
        $product_delivery = ProductDelivery::onlyTrashed()->findOrFail($id);
        $product_delivery->restore();

        return redirect()->route('admin.product_deliveries.index');
    }

    /**
     * Permanently delete ProductDelivery from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('product_delivery_delete')) {
            return abort(401);
        }
        $product_delivery = ProductDelivery::onlyTrashed()->findOrFail($id);
        $product_delivery->forceDelete();

        return redirect()->route('admin.product_deliveries.index');
    }
}
