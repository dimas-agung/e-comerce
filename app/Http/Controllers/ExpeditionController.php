<?php

namespace App\Http\Controllers;

use App\Models\Expedition;
use Illuminate\Http\Request;

class ExpeditionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $expedition = Expedition::latest()->paginate(10);

        // return response()->view('admin.Expedition.index', [
        //     'Expedition' => $expedition
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // return response()->view('admin.Expedition.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'name' => ['required'],

        ]);
        $expedition = Expedition::create($validated);
        return redirect('expedition')->with('success', 'Data Expedition has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Expedition $expedition)
    {
        //
        return $expedition;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Expedition $expedition)
    {
        //
        // return response()->view('admin.Expedition.edit', [
        //     'Expedition' => $expedition
        // ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expedition $expedition)
    {
        //
        $validated = $request->validate([
            'name' => ['required'],
        ]);
        $expedition->update($validated);
        return redirect('expedition')->with('success', 'Data Expedition has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expedition $expedition)
    {
        //
        $expedition->delete();
        return redirect('expedition')->with('success', 'Data Expedition has been deleted!');
    }
}