<?php

namespace App\Http\Controllers;

use App\Http\Resources\WilayaResource;
use App\Models\Wilaya;
use Illuminate\Http\Request;

class WilayaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return WilayaResource::collection(
            Wilaya::with(['communes' => function ($query) {
                $query->orderBy('name')->with(['cities' => function ($query) {
                    $query->orderBy('name');
                }]);
            }])->orderBy('name')->get()
        );

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Wilaya $wilaya)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wilaya $wilaya)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Wilaya $wilaya)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wilaya $wilaya)
    {
        //
    }
}
