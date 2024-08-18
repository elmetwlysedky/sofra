<?php

namespace App\Http\Controllers\Dashboard\Restaurant;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Restaurant\PaymentReceiveRepository;
use App\Http\Requests\PaymentReceiveRequest;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
    protected $payment;

    public function __construct(PaymentReceiveRepository $param)
    {
        $this->payment =$param;
    }

    public function index()
    {
        return view('Dashboard.Commission.index',[
            'payments' => $this->payment->all()
        ]);
    }

    public function  create()
    {
        return view('Dashboard.Commission.create',[
            'restaurants' => Restaurant::all()
        ]);
    }

    public function store(PaymentReceiveRequest $request)
    {
        $validate = $request->validated();
        $this->payment->store($validate);
        session()->flash('success',__('main.added_success'));
        return redirect()->route('payment.index');
    }
    public function show($id)
    {

    }

    public function edit($id)
    {
        return view('Dashboard.Commission.edit',[
            'payment' => $this->payment->show($id),
            'restaurants' => Restaurant::all()
        ]);
    }

    public function update(PaymentReceiveRequest $request ,$id)
    {
        $validate = $request->validated();
        $this->payment->update($validate,$id);
        session()->flash('success',__('main.edited_success'));
        return redirect()->route('payment.index');
    }

    public function delete($id)
    {
        $this->payment->delete($id);
        session()->flash('success',__('main.deleted_success'));

        return redirect()->back();
    }

    public function getMonthlyCommissions()
    {
        $restaurants = Restaurant::with(['orders' => function ($query) {
            $query->select('id', 'restaurant_id', 'commission', 'created_at');
        }, 'payments' => function ($query) {
            $query->select('id', 'restaurant_id', 'amount', 'created_at');
        }])->get();

        $commissions = [];

        foreach ($restaurants as $restaurant) {

            $monthly_commissions = [];

            $monthly_commissions = $this->calculateMonthlyCommissions($restaurant->orders,$restaurant->payments);

            $aggregated_data = $this->aggregateMonthlyData($restaurant , $monthly_commissions);

            $commissions = array_merge($commissions, $aggregated_data);
        }

        return view('dashboard.commission.monthly', ['commissions' => $commissions]);
    }


    protected function calculateMonthlyCommissions($orders, $payments)
    {
        $monthly_commissions = [];

        foreach ($orders as $order) {
            if ($order->created_at) {
                $year = $order->created_at->year;
                $month = $order->created_at->month;
                $key = "{$year}_{$month}";

                if (!isset($monthly_commissions[$key])) {
                    $monthly_commissions[$key] = [
                        'total_commission' => 0,
                        'total_paid' => 0,
                    ];
                }

                $monthly_commissions[$key]['total_commission'] += $order->commission;
            }
        }

        foreach ($payments as $payment) {
            if ($payment->created_at) {
                $year = $payment->created_at->year;
                $month = $payment->created_at->month;
                $key = "{$year}_{$month}";

                if (!isset($monthly_commissions[$key])) {
                    $monthly_commissions[$key] = [
                        'total_commission' => 0,
                        'total_paid' => 0,
                    ];
                }

                $monthly_commissions[$key]['total_paid'] += $payment->amount;
            }
        }
        return $monthly_commissions;
    }

    protected function aggregateMonthlyData(Restaurant $restaurant, $monthly_commissions)
    {
        $commissions = [];

        foreach ($monthly_commissions as $key => $data) {
            list($year, $month) = explode('_', $key);
            $total_commission = $data['total_commission'];
            $total_paid = $data['total_paid'];
            $remaining = $total_commission - $total_paid;

            $commissions[] = [
                'restaurant_name' => $restaurant->name,
                'year' => $year,
                'month' => $month,
                'total_commission' => $total_commission,
                'total_paid' => $total_paid,
                'remaining' => $remaining,
            ];
        }

        return $commissions;
    }



}



