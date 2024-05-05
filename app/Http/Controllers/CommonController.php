<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\CommonInterface;
use Illuminate\Http\JsonResponse;

class CommonController extends Controller
{
    protected CommonInterface $service;
    public function __construct(CommonInterface $service)
    {
        $this->service = $service;
    }

    public function getYearIntervals(): JsonResponse
    {
        $data = $this->service->getYearIntervals();
        return response()->json($data);
    }
}
