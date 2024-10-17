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
        $receipts = Receipt::whereBetween('datetime', [$data['date-start'], $data['date-end']])
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
        $releases = Release::whereBetween('datetime', [$data['date-start'], $data['date-end']])
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
        $receipts = Receipt::whereBetween('datetime', [$data['date-start'], $data['date-end']])
            ->with('staff', 'supplier')->get();
        $dataPrint = ['receipts' => $receipts, 'totalReceipts' => $data['total'], 'dateStart' =>  $data['date-start'], 'dateEnd' => $data['date-end']];
        $pdf = Pdf::loadView('admin.statistics.receipts-print-list', $dataPrint);
        $todayDate = Carbon::now()->format('d-m-Y');
        return $pdf->download('ban-in-danh-sach-phieu-nhap' . '-' . $todayDate . '.pdf');
    }

    public function printReleasesList(Request $request)
    {
        $data = $request->all();
        $releases = Release::whereBetween('datetime', [$data['date-start'], $data['date-end']])
            ->with('staff', 'customer')->get();
        $dataPrint = ['releases' => $releases, 'totalReleases' => $data['total'], 'dateStart' =>  $data['date-start'], 'dateEnd' => $data['date-end']];
        $pdf = Pdf::loadView('admin.statistics.releases-print-list', $dataPrint);
        $todayDate = Carbon::now()->format('d-m-Y');
        return $pdf->download('ban-in-danh-sach-phieu-xuat' . '-' . $todayDate . '.pdf');
    }
}
