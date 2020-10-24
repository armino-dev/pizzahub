<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            // lets share some data for all views
            $currencies = config('settings.currencies');
            $currency = session()->has('currency') ? session()->get('currency') : 'eur';
            $currencySymbol = $currencies[$currency]['symbol'];
            $conversionRate = $currencies[$currency]['value'];

            View::share('currencies', $currencies);
            View::share('currency', $currency);
            View::share('currencySymbol', $currencySymbol);
            View::share('conversionRate', $conversionRate);

            return $next($request);
        });
    }

    protected function makeResponse($request, $template, $data = [])
    {
        if ($request->ajax()) {
            return response()->json($data);
        }

        return view($template, $data);
    }
}
