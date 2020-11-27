@extends('admin.general')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content">
                    @include('components.notifications.all')
                    <table datatable="" class="table table-striped table-bordered table-hover data-table">
                        <thead>
                        <tr>
                            <th>Užsakymo numeris</th>
                            <th>El.paštas</th>
                            <th>Suma</th>
                            <th>Statusas</th>
                            <th>Apmokėjimo metodas</th>
                            <th>Apmokėta</th>
                            <th class="no-sort menu">Veiksmai</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                        @if(!empty($order->client->name))
                        <tr>
                            <td>{{$order->booking_id}}</td>
                            <td>{{$order->client->name}}|{{$order->client->email}}</td>
                            <td>{{$order->price}} &euro;</td>
                            <td>
                                @if($order->isWebToPay())
                                    Paysera
                                @elseif($order->isCash())
                                    Grynais
                                @elseif($order->isPaypal())
                                    PayPal
                                @else
                                    Nepasirinkta
                                @endif
                            </td>
                            <td>
                                @if($order->isPaid())
                                    <span class="label label-success text-uppercase">Apmokėta</span>
                                @elseif($order->isPending())
                                    <span class="label label-warning text-uppercase">Laukiama apmokėjimo</span>
                                @elseif($order->isCanceled())
                                    <span class="label label-danger text-uppercase">Apmokėjimas atšauktas</span>
                                @endif
                            </td>
                            <td>
                                {{(isset($order->paid_at))?$order->paid_at:"-"}}
                            </td>
                            <td class="para">
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <i class="fa fa-bars fa-lg"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                                        <li><a href="#" data-href="{{route('admin.orders.remove', $order->id)}}" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o fa-lg"></i> Ištrinta</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                        </tbody>
                    </table>

                    @include('components.modals.all')
                </div>
            </div>
        </div>
    </div>
@endsection