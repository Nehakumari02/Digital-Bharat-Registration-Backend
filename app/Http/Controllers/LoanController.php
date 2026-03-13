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
                    'farmer_loans.created_at',
                    'farmer_loans.status'
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

    public function updateStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:farmer_loans,id',
            'status' => 'required',
            'bank_user_id' => 'required' // Pass the ID of the person claiming it
        ]);

        DB::table('farmer_loans')
            ->where('id', $request->id)
            ->update([
                'status' => $request->status,
                'claimed_by' => $request->bank_user_id, // New column to track the user
                'updated_at' => now(),
            ]);

        return response()->json(['success' => true]);
    }

    public function getMyAcceptedLeads(Request $request)
    {
        $bankUserId = $request->query('bank_user_id');

        return DB::table('farmer_loans')
            ->join('registrations', 'farmer_loans.user_id', '=', 'registrations.id')
            ->select('farmer_loans.*', 'registrations.name', 'registrations.mobile', DB::raw("'Farmer Loan' as loan_type"))
            ->where('farmer_loans.claimed_by', $bankUserId)
            ->where('farmer_loans.status', 'Approved') // Must be Capital 'A' to match your screenshot
            ->get();
    }
}