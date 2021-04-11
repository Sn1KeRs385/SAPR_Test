<?php

namespace App\Http\Requests\Api\v1\Matrix;

use Illuminate\Foundation\Http\FormRequest;

class CalcSumRequest extends FormRequest
{
    public function rules()
    {
        return [
            'matrix' => 'required|array',
        ];
    }
}
