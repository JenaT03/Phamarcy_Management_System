<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Statistics\StatisticRequest;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Receipt;
use App\Models\Release;
use App\Models\Staff;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    public function productList()
    {

        $staff = Staff::find(Auth::user()->userable_id);

        $products = Product::whereHas('productdetails', function ($query) {
            $query->where('expiry', '<', Carbon::now()->addMonths(6));
        })->with(['productdetails' => function ($query) {
            $query->where('expiry', '<', Carbon::now()->addMonths(6));
        }, 'productdetails.receiptdetail.receipt'])->get();

        return view('admin.statistics.products', compact('products', 'staff'));
    }

    public function showStatisticReceipt()
    {
        return view('admin.statistics.receipts', ['receipts' => 'start', 'totalReceipts' => 0, 'staff' => Staff::find(Auth::user()->userable_id)]);
    }

    public function statisticReceipt(StatisticRequest $request)
    {
        $data = $request->all();
        $staff = Staff::find(Auth::user()->userable_id);
        $receipts = Receipt::whereDate('datetime', '>=', $data['date-start'])
            ->whereDate('datetime', '<=', $data['date-end'])
            ->with('staff', 'supplier')->get();

        $totalReceipts = 0;
        foreach ($receipts as $receipt) {
            $totalReceipts += $receipt->total;
        }

        $dateStart =  $data['date-start'];
        $dateEnd =  $data['date-end'];

        return view('admin.statistics.receipts', compact('receipts', 'totalReceipts', 'dateStart', 'dateEnd', 'staff'));
    }


    public function showStatisticRelease()
    {
        return view('admin.statistics.releases', ['releases' => 'start', 'totalReleases' => 0, 'staff' => Staff::find(Auth::user()->userable_id)]);
    }

    public function statisticRelease(StatisticRequest $request)
    {
        $data = $request->all();
        $staff = Staff::find(Auth::user()->userable_id);
        $releases = Release::whereDate('datetime', '>=', $data['date-start'])
            ->whereDate('datetime', '<=', $data['date-end'])
            ->with('staff', 'customer')->get();

        $totalReleases = 0;
        foreach ($releases as $release) {
            $totalReleases += $release->total;
        }

        $dateStart =  $data['date-start'];
        $dateEnd =  $data['date-end'];

        return view('admin.statistics.releases', compact('releases', 'totalReleases', 'dateStart', 'dateEnd', 'staff'));
    }

    public function printReceiptsList(Request $request)
    {
        $data = $request->all();
        $receipts = Receipt::whereDate('datetime', '>=', $data['date-start'])
            ->whereDate('datetime', '<=', $data['date-end'])
            ->with('staff', 'supplier')->get();
        $dataPrint = ['receipts' => $receipts, 'totalReceipts' => $data['total'], 'dateStart' =>  $data['date-start'], 'dateEnd' => $data['date-end']];
        $pdf = Pdf::loadView('admin.statistics.receipts-print-list', $dataPrint);
        $todayDate = Carbon::now()->format('d-m-Y');
        return $pdf->download('ban-in-danh-sach-phieu-nhap' . '-' . $todayDate . '.pdf');
    }

    public function printReleasesList(Request $request)
    {
        $data = $request->all();
        $releases = Release::whereDate('datetime', '>=', $data['date-start'])
            ->whereDate('datetime', '<=', $data['date-end'])
            ->with('staff', 'customer')->get();
        $dataPrint = ['releases' => $releases, 'totalReleases' => $data['total'], 'dateStart' =>  $data['date-start'], 'dateEnd' => $data['date-end']];
        $pdf = Pdf::loadView('admin.statistics.releases-print-list', $dataPrint);
        $todayDate = Carbon::now()->format('d-m-Y');
        return $pdf->download('ban-in-danh-sach-phieu-xuat' . '-' . $todayDate . '.pdf');
    }

    public function showBestSelling()
    {
        $staff = Staff::find(Auth::user()->userable_id);
        return view('admin.statistics.best-selling', ['bestSellingProducts' => [], 'staff' => $staff, 'category' => 0]);
    }

    public function computeBestSelling(StatisticRequest $request)
    {
        $data = $request->all();
        if ($data['category'] == 'all') {
            $releases = Release::whereDate('datetime', '>=', $data['date-start'])
                ->whereDate('datetime', '<=', $data['date-end'])
                ->get();

            // Step 3: Aggregate quantities per product and count total sales
            $bestSellingProducts = DB::table('release_details')
                ->join('products', 'release_details.product_id', '=', 'products.id')
                ->select('release_details.product_id', 'products.name', 'products.img', 'products.code', 'products.unit', DB::raw('SUM(release_details.quantity) as total_quantity'))
                ->whereIn('release_id', $releases->pluck('id')) // Lọc theo release_id
                ->groupBy('release_details.product_id', 'products.name', 'products.img', 'products.code', 'products.unit')
                ->orderByDesc('total_quantity')
                ->get();
        } else {

            $releases = Release::whereDate('datetime', '>=', $data['date-start'])
                ->whereDate('datetime', '<=', $data['date-end'])
                ->get();


            $bestSellingProducts = DB::table('release_details')
                ->join('products', 'release_details.product_id', '=', 'products.id')
                ->join('category_product', 'products.id', '=', 'category_product.product_id')
                ->select('release_details.product_id', 'products.name', 'products.img', 'products.code', 'products.unit', DB::raw('SUM(release_details.quantity) as total_quantity'))
                ->whereIn('release_id', $releases->pluck('id')) // Lọc theo release_id
                ->where('category_product.category_id', $data['category'])
                ->groupBy('release_details.product_id', 'products.name', 'products.img', 'products.code', 'products.unit')
                ->orderByDesc('total_quantity')
                ->get();
        }
        $staff = Staff::find(Auth::user()->userable_id);
        return view('admin.statistics.best-selling', ['bestSellingProducts' => $bestSellingProducts, 'staff' => $staff, 'dateEnd' => $data['date-end'], 'dateStart' => $data['date-start'], 'category' => $data['category']]);
    }
}
