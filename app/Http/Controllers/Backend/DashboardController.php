<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\OrderDetail;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        // count all data
        $customerCount = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', '=', 'admin');
        })->count();
        $productCount = Product::count();
        $orderCount = OrderDetail::whereHas('order', function ($query) {
                                        $query->whereNotIn('status', ['Belum Checkout', 'Sudah Checkout']);
                                    })
                                    ->count();
        $income = Transaction::sum('gross_amount');
        $incomeByYear = Transaction::whereYear('updated_at', date('Y'))->sum('gross_amount');
        $incomeByMonth = Transaction::whereYear('updated_at', date('Y'))
                                    ->whereMonth('updated_at', date('m'))->sum('gross_amount');
        $incomeByWeek = Transaction::whereBetween('updated_at', [now()->startOfWeek(), now()->endOfWeek()])
                                    ->sum('gross_amount');
        $incomeByDay = Transaction::whereDate('updated_at', date('Y-m-d'))->sum('gross_amount');
        $lastTransaction = Transaction::orderBy('updated_at', 'asc')->first();

        // get top products
        $topProducts = OrderDetail::selectRaw('product_id, SUM(quantity) as total_quantity')
                            ->whereHas('order', function ($query) {
                                $query->whereNotIn('status', ['Belum Checkout', 'Sudah Checkout']);
                            })
                            ->groupBy('product_id')
                            ->orderBy('total_quantity', 'desc')
                            ->take(5)
                            ->get();

        // create chart data for top products
        $topProductsData = $topProducts->pluck('total_quantity')->toJson();
        $topProductsLabels = $topProducts->pluck('product.name')->toJson();

        // get lowest products
        $lowestProducts = OrderDetail::selectRaw('product_id, SUM(quantity) as total_quantity')
                            ->whereHas('order', function ($query) {
                                $query->whereNotIn('status', ['Belum Checkout', 'Sudah Checkout']);
                            })
                            ->groupBy('product_id')
                            ->orderBy('total_quantity', 'asc')
                            ->take(5)
                            ->get();

        // create chart data for lowest products
        $lowestProductsData = $lowestProducts->pluck('total_quantity')->toJson();
        $lowestProductsLabels = $lowestProducts->pluck('product.name')->toJson();

        // checking last transaction
        if ($lastTransaction) {
            $lastYear = $lastTransaction->updated_at->year;
        } else {
            $lastYear = date('Y');
        }

        return view('backend.dashboard.index', compact('customerCount', 'productCount', 'orderCount', 'income',
                                                    'incomeByYear', 'incomeByMonth', 'incomeByWeek',
                                                    'incomeByDay', 'lastYear', 'topProductsData',
                                                    'topProductsLabels', 'lowestProductsData', 'lowestProductsLabels'));
    }

    public function getRevenueByMonth($year = null)
    {
        // If no year is given, retrieve the last year from the transaction table
        if (!$year) {
            $lastTransaction = Transaction::orderBy('updated_at', 'desc')->first();
            if (!$lastTransaction) {
                $chartData = [
                    'labels' => [],
                    'revenue' => [],
                ];
                return $chartData;
            }
            $lastYear = $lastTransaction->created_at->year;
            $year = $lastYear;
        }

        // Retrieve earnings data by month of the given year
        $revenueData = Transaction::selectRaw('MONTHNAME(updated_at) as month, SUM(gross_amount) as revenue')
                                    ->whereYear('updated_at', $year)
                                    ->groupBy('month')
                                    ->orderBy('month', 'desc')
                                    ->get();

        // Data format for apexcharts charts
        $labels = $revenueData->pluck('month')->toArray();
        $revenue = $revenueData->pluck('revenue')->toArray();

        $chartData = [
            'labels' => $labels,
            'revenue' => $revenue,
        ];

        return $chartData;
    }
}
