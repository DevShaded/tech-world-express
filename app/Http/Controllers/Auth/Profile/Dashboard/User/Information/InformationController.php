<?php

namespace App\Http\Controllers\Auth\Profile\Dashboard\User\Information;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Information\InformationRequest;
use App\Http\Services\Product\Cart\CartService;
use App\Http\Services\User\UserService;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class InformationController extends Controller
{
    public function index()
    {
        return Inertia::render('Profile/Dashboard/User/Information/Index', [
            'data' => [
                'information' => UserService::getUserInformation(auth()->user()->id),
                'countries' => CartService::getCountries(),
            ],
        ]);
    }

    public function update(InformationRequest $request)
    {
        UserService::storeUserInformation($request->validated());

        return Redirect::route('information.index');
    }
}
