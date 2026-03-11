<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LoanController extends Controller
{
    /**
     * Fetch all farmer loan applications for the Admin/Bank view.
     */
    public function getAllLeads()
    {
        try {
            // 1. Fetch data by joining farmer_loans with registrations
            $leads = DB::table('farmer_loans')
                ->join('registrations', 'farmer_loans.user_id', '=', 'registrations.id')
                ->select(
                    'farmer_loans.id',
                    'registrations.name',
                    DB::raw("'Farmer Loan' as loan_type"), // Static label for Flutter
                    'farmer_loans.amount',
                    'farmer_loans.created_at'
                )
                ->orderBy('farmer_loans.created_at', 'desc')
                ->get();

            // 2. Return JSON response
            return response()->json($leads, 200);

        } catch (\Exception $e) {
            // 3. Log the error for the developer
            Log::error("Fetch Leads Error: " . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Internal Server Error'
            ], 500);
        }
    }
}