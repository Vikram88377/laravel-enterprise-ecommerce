<?php

namespace App\Http\Controllers\Api\V1;

use Exception;
use App\Services\ReportService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class ReportController extends Controller
{
    public function __construct(
        private ReportService $reportService
    ) {
    }

    public function salesReport(Request $request)
{
    try {
        $report = $this->reportService->salesReport(
            $request->query('from'),
            $request->query('to')
        );

        return response()->json([
            'success' => true,
            'message' => 'Sales report fetched successfully',
            'data' => $report,
        ]);

    } catch (Exception $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage(),
        ], 500);
    }
}

    public function ordersReport()
    {
        try {

            $report = $this->reportService
                ->ordersReport();

            return response()->json([
                'success' => true,
                'message' => 'Orders report fetched successfully',
                'data' => $report,
            ]);

        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function topProducts()
    {
        try {

            $report = $this->reportService
                ->topProducts();

            return response()->json([
                'success' => true,
                'message' => 'Top products report fetched successfully',
                'data' => $report,
            ]);

        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function customersReport()
    {
        try {

            $report = $this->reportService
                ->customersReport();

            return response()->json([
                'success' => true,
                'message' => 'Customers report fetched successfully',
                'data' => $report,
            ]);

        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    public function monthlySales()
{
    try {

        $report = $this->reportService
            ->monthlySales();

        return response()->json([
            'success' => true,
            'message' => 'Monthly sales report fetched successfully',
            'data' => $report,
        ]);

    } catch (Exception $e) {

        return response()->json([
            'success' => false,
            'message' => $e->getMessage(),
        ], 500);
    }
}

public function dashboardSummary()
{
    try {
        $report = $this->reportService
            ->dashboardSummary();

        return response()->json([
            'success' => true,
            'message' => 'Dashboard summary fetched successfully',
            'data' => $report,
        ]);

    } catch (Exception $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage(),
        ], 500);
    }
}

}