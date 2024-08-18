@extends('Dashboard.Layouts.master')

@section('title')
    {{__('main.orders')}}
@endsection

@section('content')

    <div class="card">
        <div class="card-header bg-transparent header-elements-inline">
            <h6 class="card-title">Static invoice</h6>
            <div class="header-elements">
{{--                <button type="button" class="btn btn-light btn-sm"><i class="icon-file-check mr-2"></i> Save</button>--}}
                <a href="{{route('order.print',$order->id)}}" class="btn btn-light btn-sm ml-3"><i class="icon-printer mr-2"></i> Print</a>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-4">
{{--                        <img src="{{asset('Dashboard/global_assets/images/logo_demo.png')}}" class="mb-3 mt-2" alt="" style="width: 120px;">--}}
                        <ul class="list list-unstyled mb-0">
{{--                            <li>2269 Elba Lane</li>--}}
{{--                            <li>Paris, France</li>--}}
{{--                            <li>888-555-2311</li>--}}
                        </ul>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="mb-4">
                        <div class="text-sm-right">
                            <h4 class="text-primary mb-2 mt-md-2">{{$order->restaurant->name}} </h4>
                            <ul class="list list-unstyled mb-0">
                                <li>Date: <span class="font-weight-semibold">{{$order->created_at}}</span></li>
                                <li>Last update date: <span class="font-weight-semibold">{{$order->updated_at}}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-md-flex flex-md-wrap">
                <div class="mb-4 mb-md-2">
                    <span class="text-muted">Order To :</span>
                    <ul class="list list-unstyled mb-0">
                        <li><h5 class="my-2">{{$order->client->name}}</h5></li>
                        <li><span class="font-weight-semibold">{{$order->client->region->name}}</span></li>
                        <li>{{$order->client->region->city->name}}</li>
                        <li>{{$order->client->phone}}</li>
                    </ul>
                </div>

                <div class="mb-2 ml-auto">
                    <span class="text-muted">Order From</span>
{{--                    <div class="d-flex flex-wrap wmin-md-400">--}}
                        <ul class="list list-unstyled mb-0">
                            <li><h5 class="my-2">{{$order->restaurant->name}}</h5></li>
                            <li> {{$order->restaurant->region->name}}</li>
                            <li>{{$order->restaurant->region->city->name}}</li>
                            <li>{{$order->restaurant->phone}}</li>
                            <li></li>

                        </ul>

                        <ul class="list list-unstyled text-right mb-0 ml-auto">

                        </ul>
{{--                    </div>--}}
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-lg">
                <thead>
                <tr>
                    <th>{{__('main.products')}}</th>
                    <th>{{__('main.notes')}}</th>
                    <th>{{__('main.price')}}</th>
                    <th>{{__('main.quantity')}}</th>
                    <th>{{__('main.total')}}</th>

                </tr>
                </thead>
                <tbody>
                @foreach($order->products as $product)
                <tr>
                    <td>
                        <h6 class="mb-0">{{$product->name}}</h6>
                        <span class="text-muted"></span>
                    </td>
                    <td>{{$product->pivot->special}}</td>
                    <td>{{$product->pivot->price}}</td>
                    <td>{{$product->pivot->quantity}}</td>
                    <td><span class="font-weight-semibold">{{$product->pivot->price * $product->pivot->quantity}}</span></td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-body">
            <div class="d-md-flex flex-md-wrap">
                <div class="pt-2 mb-3">
                    <h6 class="mb-3">Authorized person</h6>
                    <div class="mb-3">
                        <img src="../../../../global_assets/images/signature.png" width="150" alt="">
                    </div>

                    <ul class="list-unstyled text-muted">
                        <li>Eugene Kopyov</li>
                        <li>2269 Elba Lane</li>
                        <li>Paris, France</li>
                        <li>888-555-2311</li>
                    </ul>
                </div>

                <div class="pt-2 mb-3 wmin-md-400 ml-auto">
                    <h6 class="mb-3">Total due</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                            <tr>
                                <th>Subtotal:</th>
                                <td class="text-right">{{ $order->total_invoice }}</td>
                            </tr>
                            <tr>
                                <th>delivery: <span class="font-weight-normal"></span></th>
                                <td class="text-right">{{$order->delivery_charge}}</td>
                            </tr>
                            <tr>delivery
                                <th>Total:</th>
                                <td class="text-right text-primary"><h5 class="font-weight-semibold">{{$order->total_price}}</h5></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
