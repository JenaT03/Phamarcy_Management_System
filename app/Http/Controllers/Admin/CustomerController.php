<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customers\CreateCustomerRequest;
use App\Http\Requests\Customers\UpdateCustomerRequest;
use App\Http\Requests\Statistics\StatisticRequest;
use App\Models\Customer;
use App\Models\Release;
use App\Models\ReleaseDetail;
use App\Models\Role;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    protected $customer;
    protected $role;

    public function __construct(Customer $customer, Role $role)
    {
        $this->customer = $customer;
        $this->role = $role;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $this->customer->latest('id');

        if ($request->has('search') && !empty($request->search)) {
            $query->where('phone', 'like', '%' . $request->search . '%');
        }

        $customers = $query->paginate(10);
        $staff = Staff::find(Auth::user()->userable_id);
        return view('admin.customers.index', compact('customers', 'staff'))->with('search', $request->search);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check()) {
            $staff = Staff::find(Auth::user()->userable_id);
            return view('admin.customers.create', compact('staff'));
        } else return view('admin.customers.create');;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCustomerRequest $request)
    {
        if (Auth::check() && Auth::user()->userable_type === Staff::class) {
            $dataCreate = $request->all();
            $customer = $this->customer->create($dataCreate);
            return to_route('users.create', ['phone' => $customer->phone, 'user_type' => 'customer']);
        } else {
            $dataCreate = $request->all();
            $customer = $this->customer->create($dataCreate);
            return to_route('users.create', ['phone' => $customer->phone, 'user_type' => 'customer', 'role' => 'customer']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::check()) {
            $customer = $this->customer->findOrFail($id);
            $releases = $customer->releases()->with('staff')->get();
            if (Auth::user()->userable_type === Customer::class) {
                return view('client.profile.show-own-release', compact('customer', 'releases'));
            }
            if (Auth::user()->userable_type === Staff::class) {
                $staff = Staff::find(Auth::user()->userable_id);
                return view('admin.customers.show', compact('customer', 'releases', 'staff'));
            }
        }
    }

    public function showDetailRelease(Request $request, $customerId, $reId)
    {
        if (Auth::check()) {
            $customer = $this->customer->find($customerId);
            $release = Release::find($reId);
            $query = ReleaseDetail::with('product')->where('release_id', $reId)->latest('id');
            $search = $request->search ?? '';
            if (!empty($search)) {
                $query->whereHas('product', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                });
            }

            $releaseDetails = $query->paginate(10);
            if (Auth::user()->userable_type === Customer::class) {
                return view('client.profile.show-own-release-detail', compact('releaseDetails', 'release', 'search', 'customer'));
            }
            if (Auth::user()->userable_type === Staff::class) {
                $staff = Staff::find(Auth::user()->userable_id);
                return view('admin.customers.show-detail', compact('staff', 'releaseDetails', 'release', 'search', 'customerId'));
            }
        } else return to_route('home');
    }

    public function releaseList(StatisticRequest $request)
    {
        $data = $request->all();
        $staff = Staff::find(Auth::user()->userable_id);
        $customer = $this->customer->findOrFail($data['customerId']);
        $releases = $customer->releases()
            ->whereBetween('datetime', [$data['date-start'], $data['date-end']])
            ->with('staff')
            ->get();
        $dateStart =  $data['date-start'];
        $dateEnd =  $data['date-end'];

        return view('admin.customers.show', compact('customer', 'releases', 'dateStart', 'dateEnd', 'staff'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::check()) {
            $staff = Staff::find(Auth::user()->userable_id);
            $customer = $this->customer->findOrFail($id);
            return view('admin.customers.edit', compact('customer', 'staff'));
        } else {
            $customer = $this->customer->findOrFail($id);
            return view('admin.customers.edit', compact('customer'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, $id)
    {
        $dataUpdate = $request->all();
        $customer = $this->customer->findOrFail($id);

        if (Auth::check()) {
            if (Auth::user()->userable_type === Customer::class) {

                if (!$customer->update($dataUpdate)) {
                    return back()->withErrors(['error' => 'Cập nhật thông tin cá nhân thất bại.']);
                }

                $user = Auth::user();
                if ($user) {
                    return to_route('users.edit', ['user' => $user->id, 'phone' => $customer->phone, 'user_type' => 'customer', 'role' => 'customer']);
                }
                return back()->withErrors(['error' => 'Không tìm thấy tài khoản của bạn.']);
            } else if (Auth::user()->userable_type === Staff::class) {
                if (!$customer->update($dataUpdate)) {
                    return back()->withErrors(['error' => 'Cập nhật thông tin khách hàng thất bại.']);
                }

                $user = $customer->users;
                if ($user) {
                    return to_route('users.edit', ['user' => $user->id, 'phone' => $customer->phone, 'user_type' => 'customer']);
                }
                return back()->withErrors(['error' => 'Không tìm thấy tài khoản liên quan tới khách hàng này.']);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = $this->customer->findOrFail($id);
        $user = $customer->users;
        $customer->delete();
        if ($user) {
            $user->delete();
            return to_route('customers.index')->with(['message' => 'Xóa khách hàng thành công']);
        }
        return back()->withErrors(['error' => 'Không tìm thấy người dùng liên quan tới khách hàng này.']);
    }

    public function detail()
    {
        //
    }
}
