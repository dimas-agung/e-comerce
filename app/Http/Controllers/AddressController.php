<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $request->input('users_id') ? Address::where('users_id',$request->input('users_id'))->get() : Address::get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // return response()->view('admin.Address.create');
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
        // return 123;
        $validated = $request->validate([
            'fullname' => ['required'],
            'users_id' => ['required'],
            'phone_number' => ['required'],
            'provinces_id' => ['required'],
            'cities_id' => ['required'],
            'districts_id' => ['required'],
            'villages_id' => ['required'],
            'address' => ['required'],
            'postal_code' => ['required'],
            'label' => ['sometimes', 'nullable'],
        ]);
        
        $address = Address::create($validated);
        return Redirect::back()->with('success', 'Data Address has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        //
        return $address;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        //
        // return response()->view('admin.Address.edit', [
        //     'Address' => $address
        // ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {
        //
        $validated = $request->validate([
            'fullname' => ['required'],
            'users_id' => ['required'],
            'phone_number' => ['required'],
            'provinces_id' => ['required'],
            'districts_id' => ['required'],
            'villages_id' => ['required'],
            'address' => ['required'],
            'postal_code' => ['required'],
            'label' => ['sometimes', 'nullable'],
        ]);
        $address->update($validated);
        return redirect('address')->with('success', 'Data Address has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        //
        $address->delete();
        return Redirect::back()->with('success', 'Data Address has been deleted!');
    }
    public function activated(Address $address)
    {
        //
        $address->activated();
        return redirect('address')->with('success', 'Data Address has been Activated!');
    }
    public function nonactive(Address $address)
    {
        //
        $address->nonactive();
        // return $address;
        return redirect('address')->with('success', 'Data Address has been nonactive!');
    }
}