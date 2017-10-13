<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductsRequest;
use App\Http\Requests\Admin\UpdateProductsRequest;

class ProductsController extends Controller
{
    /**
     * Display a listing of Product.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('product_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('product_delete')) {
                return abort(401);
            }
            $products = Product::onlyTrashed()->get();
        } else {
            $products = Product::all();
        }

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating new Product.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('product_create')) {
            return abort(401);
        }
        
        $product_categories = \App\ProductCategory::get()->pluck('category', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.products.create', compact('product_categories'));
    }

    /**
     * Store a newly created Product in storage.
     *
     * @param  \App\Http\Requests\StoreProductsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductsRequest $request)
    {
        if (! Gate::allows('product_create')) {
            return abort(401);
        }
        $product = Product::create($request->all());



        return redirect()->route('admin.products.index');
    }


    /**
     * Show the form for editing Product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('product_edit')) {
            return abort(401);
        }
        
        $product_categories = \App\ProductCategory::get()->pluck('category', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $product = Product::findOrFail($id);

        return view('admin.products.edit', compact('product', 'product_categories'));
    }

    /**
     * Update Product in storage.
     *
     * @param  \App\Http\Requests\UpdateProductsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductsRequest $request, $id)
    {
        if (! Gate::allows('product_edit')) {
            return abort(401);
        }
        $product = Product::findOrFail($id);
        $product->update($request->all());



        return redirect()->route('admin.products.index');
    }


    /**
     * Display Product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('product_view')) {
            return abort(401);
        }
        
        $product_categories = \App\ProductCategory::get()->pluck('category', 'id')->prepend(trans('quickadmin.qa_please_select'), '');$product_orders = \App\ProductOrder::where('product_id', $id)->get();$product_deliveries = \App\ProductDelivery::where('product_id', $id)->get();

        $product = Product::findOrFail($id);

        return view('admin.products.show', compact('product', 'product_orders', 'product_deliveries'));
    }


    /**
     * Remove Product from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('product_delete')) {
            return abort(401);
        }
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products.index');
    }

    /**
     * Delete all selected Product at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('product_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Product::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Product from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('product_delete')) {
            return abort(401);
        }
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();

        return redirect()->route('admin.products.index');
    }

    /**
     * Permanently delete Product from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('product_delete')) {
            return abort(401);
        }
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->forceDelete();

        return redirect()->route('admin.products.index');
    }
}
