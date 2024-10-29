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

        $affiliate = Affiliate::create($input['affiliate']);
        $affiliate->address()->create($input['address']);

        return to_route('affiliate.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAffiliateRequest $request, Affiliate $affiliate)
    {
        $input = $request->all();

        $affiliate->update($input['affiliate']);
        $affiliate->address()->update($input['address']);

        return to_route('affiliate.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Affiliate $affiliate)
    {
        //
    }
}
