<?php

namespace App\Http\Controllers\Auth\Profile\Dashboard\User\Billing;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Billing\BillingRequest;
use App\Http\Services\User\Billing\UserBillingService;
use Inertia\Inertia;

class BillingController extends Controller
{
    public function index()
    {
        return Inertia::render('Profile/Dashboard/User/Billing/Index', [
            'data' => [
                'billing' => UserBillingService::getUserBilling(auth()->user()->id),
            ],
        ]);
    }

    public function edit()
    {
        return Inertia::render('Profile/Dashboard/User/Billing/Edit');
    }

    public function update(BillingRequest $request)
    {
        UserBillingService::updateUserBilling($request->validated());

        return redirect()->route('billing.index');
    }

    public function destroy(string $id)
    {
        UserBillingService::deleteUserBilling($id);

        return redirect()->route('billing.index');
    }
}
