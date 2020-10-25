<?php

namespace App\Http\Controllers\Frontend\Basket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Basket\StepTwo\StoreRequest as StepTwoStoreRequest;

class StepTwoController extends Controller
{
    public function store(StepTwoStoreRequest $request)
    {
        $validation = $request->validated();

        session()->put('order-detail', $validation);

        $message = 'Delivery details set.';

        if ($request->wantsJson()) {
            return ['path' => route('home'), 'message' => $message, 'status' => 'success'];
        }

        return redirect(route('basket.review'))->with(['message' => $message]);
    }
}
