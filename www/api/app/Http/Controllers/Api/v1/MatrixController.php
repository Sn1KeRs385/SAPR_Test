<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Matrix\CalcSumRequest;
use Illuminate\Http\Response;

class MatrixController extends Controller
{
    public function calcSum(CalcSumRequest $request)
    {
        $matrix = $request->input('matrix');
        $size = count($matrix);
        $answer = [];
        $fullSum = 0;
        for($i = 0; $i < $size; $i++){
            $diagonalSum = 0;
            $diagonalName = "";
            for($j = 0; $j < $size; $j++){
                $cell = ($j + $i) % $size;
                $diagonalSum += $matrix[$j][$cell];
                $diagonalName .= $matrix[$j][$cell];
                if($j < $size - 1){
                    $diagonalName .= " + ";
                }
            }
            $answer[] = [
                'name' => $diagonalName,
                'sum' => $diagonalSum
            ];
            $fullSum += $diagonalSum;
        }
        $answer[] = [
            'name' => 'Сумма сумм диагоналей',
            'sum' => $fullSum
        ];

        return response()->json($answer, Response::HTTP_OK);
    }
}
