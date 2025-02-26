<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagtStoreRequest;
use App\Http\Requests\TagtUpdateRequest;
use App\Http\Resources\TagResource;
use App\Models\tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagtStoreRequest $request)
    {
        return new TagResource(Tag::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(tag $tag)
    {
       return new TagResource($tag);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TagtUpdateRequest $request, tag $tag)
    {

        $tag->update($request->all());
        $tag->refresh();
        return new TagResource($tag);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tag $tag)
    {
        //
    }
}
