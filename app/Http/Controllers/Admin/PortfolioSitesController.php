<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StorePortfolioSitesRequest;
use App\Http\Requests\UpdatePortfolioSitesRequest;
use App\Http\Controllers\Admin\BaseController;
use App\Models\PortfolioSites;

class PortfolioSitesController extends BaseController
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
    public function store(StorePortfolioSitesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PortfolioSites $portfolioSites)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PortfolioSites $portfolioSites)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePortfolioSitesRequest $request, PortfolioSites $portfolioSites)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PortfolioSites $portfolioSites)
    {
        //
    }
}
