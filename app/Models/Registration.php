<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        // Basic Info
        'name',
        'mobile',
        'email',
        'password',
        'category',
        'custom_id',

        // Address Fields
        'pincode',
        'district',
        'city',
        'state',

        // Student Fields
        'college_name',
        'standard_year',
        'stream',
        'roll_number',
        'gpa',
        'graduation_year',
        'skills',

        // Business Fields
        'company_name',
        'gst_number',
        'turnover',
        'employee_count',
        'business_website',
        'establishment_year',

        // Bank Fields
        'bank_name',
        'interest_rate',
        'branch_name',
        'ifsc_code',

        // Farmer Fields
        'crop_name',
        'crop_price',
        'land_size',
    ];
}