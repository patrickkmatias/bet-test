<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommissionRequest;
use App\Models\Commission;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CommissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        
        $commissions = Commission::where('affiliate_id', $user->affiliate->id)->get();

        return Inertia::render('Commissions/Index', [
            'commissions' => $commissions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommissionRequest $request)
    {
        Commission::create($request->all());
        return to_route('commissions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commission $commission)
    {
        $commission->delete();

        return null;
    }
}
