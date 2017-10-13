<?php

namespace App\Http\Controllers\Admin;

use App\Believer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBelieversRequest;
use App\Http\Requests\Admin\UpdateBelieversRequest;

class BelieversController extends Controller
{
    /**
     * Display a listing of Believer.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('believer_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('believer_delete')) {
                return abort(401);
            }
            $believers = Believer::onlyTrashed()->get();
        } else {
            $believers = Believer::all();
        }

        return view('admin.believers.index', compact('believers'));
    }

    /**
     * Show the form for creating new Believer.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('believer_create')) {
            return abort(401);
        }
        return view('admin.believers.create');
    }

    /**
     * Store a newly created Believer in storage.
     *
     * @param  \App\Http\Requests\StoreBelieversRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBelieversRequest $request)
    {
        if (! Gate::allows('believer_create')) {
            return abort(401);
        }
        $believer = Believer::create($request->all());



        return redirect()->route('admin.believers.index');
    }


    /**
     * Show the form for editing Believer.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('believer_edit')) {
            return abort(401);
        }
        $believer = Believer::findOrFail($id);

        return view('admin.believers.edit', compact('believer'));
    }

    /**
     * Update Believer in storage.
     *
     * @param  \App\Http\Requests\UpdateBelieversRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBelieversRequest $request, $id)
    {
        if (! Gate::allows('believer_edit')) {
            return abort(401);
        }
        $believer = Believer::findOrFail($id);
        $believer->update($request->all());



        return redirect()->route('admin.believers.index');
    }


    /**
     * Display Believer.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('believer_view')) {
            return abort(401);
        }
        $product_deliveries = \App\ProductDelivery::where('beleiver_id', $id)->get();

        $believer = Believer::findOrFail($id);

        return view('admin.believers.show', compact('believer', 'product_deliveries'));
    }


    /**
     * Remove Believer from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('believer_delete')) {
            return abort(401);
        }
        $believer = Believer::findOrFail($id);
        $believer->delete();

        return redirect()->route('admin.believers.index');
    }

    /**
     * Delete all selected Believer at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('believer_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Believer::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Believer from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('believer_delete')) {
            return abort(401);
        }
        $believer = Believer::onlyTrashed()->findOrFail($id);
        $believer->restore();

        return redirect()->route('admin.believers.index');
    }

    /**
     * Permanently delete Believer from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('believer_delete')) {
            return abort(401);
        }
        $believer = Believer::onlyTrashed()->findOrFail($id);
        $believer->forceDelete();

        return redirect()->route('admin.believers.index');
    }
}
