<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportExport;
use App\Models\Order;
use App\Models\ImportProduct;
use App\Models\Product;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request) {

        // Lọc theo khoảng thời gian nếu có
        $from = $request->input('from', Carbon::now()->startOfMonth()->toDateString());
        $to = $request->input('to', Carbon::now()->endOfMonth()->toDateString());

        // Báo cáo doanh thu bán hàng
        $totalRevenue = Order::whereBetween('created_at', [$from, $to])->sum('total_price');
        $orderCount = Order::whereBetween('created_at', [$from, $to])->count();

        // Báo cáo nhập hàng
        $totalImportCost = ImportProduct::whereBetween('created_at', [$from, $to])->sum('total_price');
        $importCount = ImportProduct::whereBetween('created_at', [$from, $to])->count();

        // Tồn kho
        $lowStockProducts = Product::where('quantity', '<', 10)->get();
        $inventoryValue = Product::sum(DB::raw('quantity * price'));

        return view('reports.index', compact(
            'from', 'to',
            'totalRevenue', 'orderCount',
            'totalImportCost', 'importCount',
            'lowStockProducts', 'inventoryValue'
        ));
    }

    public function exportPdf(Request $request)
    {
        $data = $this->getReportData($request); // xử lý thống kê
        $pdf = Pdf::loadView('reports.export_pdf', $data);
        return $pdf->download('bao_cao_thong_ke.pdf');
    }

    public function exportExcel(Request $request)
    {
        $data = $this->getReportData($request);
        return Excel::download(new ReportExport($data), 'bao_cao_thong_ke.xlsx');
    }

    private function getReportData(Request $request)
    {
        $from = $request->input('from', now()->startOfMonth()->toDateString());
        $to = $request->input('to', now()->endOfMonth()->toDateString());

        return [
            'from' => $from,
            'to' => $to,
            'totalRevenue' => Order::whereBetween('created_at', [$from, $to])->sum('total_price'),
            'orderCount' => Order::whereBetween('created_at', [$from, $to])->count(),
            'totalImportCost' => ImportProduct::whereBetween('created_at', [$from, $to])->sum('total_price'),
            'importCount' => ImportProduct::whereBetween('created_at', [$from, $to])->count(),
            'lowStockProducts' => Product::where('quantity', '<', 10)->get(),
            'inventoryValue' => Product::sum(DB::raw('quantity * price')),
        ];
    }
}
