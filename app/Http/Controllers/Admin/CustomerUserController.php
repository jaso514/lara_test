<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreCustomerUserRequest;
use App\Http\Requests\UpdateCustomerUserRequest;
use App\Http\Controllers\Admin\BaseController;
use App\Models\CustomerUser;

class CustomerUserController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->setEntity('customer_user');
        parent::__construct();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customerUsers = CustomerUser::get();
        $head = $this->getHead();
        $this->response['head'] = array_merge(['firstname', 'lastname', 'Email'], $head);
        $this->response['customerUsers'] = $customerUsers;
        return view('admin.role-permission.customerUsers.view', $this->response);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CustomerUser $customerUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CustomerUser $customerUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerUserRequest $request, CustomerUser $customerUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CustomerUser $customerUser)
    {
        //
    }
}
