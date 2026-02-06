<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Http\Resources\AccountResource;
class AccountController extends Controller
{
    //
    public function account(Request $request)
    {
        $accounts = Account::with('shop')->latest()->get();

         return response()->json([
            'status' => true,
            'data' => AccountResource::collection($accounts)
        ]);
    }

    public function store_account(Request $request)
    {
        try {
           $account = Account::create([
                'shop_id'      => $request->shop_id,
                'date'         => $request->date,
                'sell'         => $request->sell,
                'market'       => $request->market,
                'visacard'     => $request->visacard,
                'snacks'       => $request->snacks,
                'drivar_bill'  => $request->drivar_bill,
                'others'       => $request->others,
                'created_by'   => auth()->id(),
            ]);
            
            return response()->json([
                'status'  => true,
                'message' => 'Account created successfully',
                'data'    => $account
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to created account',
            ], 500);
        }
    }
}
