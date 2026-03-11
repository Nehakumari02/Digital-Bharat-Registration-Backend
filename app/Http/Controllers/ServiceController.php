<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
// 1. MUST IMPORT MODELS HERE
use App\Models\FarmerLoan;
use App\Models\CropRegistration;
use App\Models\StudentLoan;
use App\Models\JobPosting;

class ServiceController extends Controller
{
    public function saveData(Request $request)
    {
        // 2. Wrap in Try-Catch to handle database errors gracefully
        try {
            $type = $request->type;
            $data = $request->data;
            $userId = $request->user_id;

            switch ($type) {
                case 'kisan_loan':
                    $record = FarmerLoan::create([
                        'user_id' => $userId,
                        'land_size' => $data['land_size'],
                        'khasra_number' => $data['khasra_number'],
                        'amount' => $data['amount'],
                    ]);
                    break;

                case 'crop_reg':
                    $record = CropRegistration::create([
                        'user_id' => $userId,
                        'crop_name' => $data['crop_name'],
                        'price' => $data['price'],
                        'image_base64' => $data['image'] ?? null,
                    ]);
                    break;

                case 'edu_loan':
                    $record = StudentLoan::create([
                        'user_id' => $userId,
                        'college_name' => $data['college_name'],
                        'course_name' => $data['course_name'],
                        'amount' => $data['amount'],
                    ]);
                    break;

                case 'job_post':
                    $record = JobPosting::create([
                        'user_id' => $userId,
                        'job_title' => $data['job_title'],
                        'description' => $data['description'] ?? '',
                        'salary_range' => $data['salary_range'],
                    ]);
                    break;

                default:
                    return response()->json(['error' => 'Invalid service type'], 400);
            }

            // 3. Always return a 201 Created status for successful saves
            return response()->json([
                'status' => 'success',
                'message' => 'Data saved successfully',
                'data' => $record
            ], 201);

        } catch (\Exception $e) {
            // 4. Log the error for debugging
            Log::error("Service Save Error: " . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}