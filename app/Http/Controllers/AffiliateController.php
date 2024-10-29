<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAffiliateRequest;
use App\Http\Requests\UpdateAffiliateRequest;
use App\Models\Affiliate;
use Inertia\Inertia;

class AffiliateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $affiliates = Affiliate::all();
        return Inertia::render('Affiliates/Index', [
            'affiliates' => $affiliates
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAffiliateRequest $request)
    {
        $input = $request->all();

        Affiliate::create($input['affiliate']);

        return to_route('affiliate.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Affiliate $affiliate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAffiliateRequest $request, Affiliate $affiliate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Affiliate $affiliate)
    {
        //
    }
}
