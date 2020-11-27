@extends('admin.general')
@section('content')
    @include('components.notifications.all')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content">
                    <table datatable="" class="table table-striped table-bordered table-hover data-table">
                        <thead>
                        <tr>
                            <th>Užsakymo numeris</th>
                            <th>El.paštas</th>
                            <th>Mašina</th>
                            <th>Nuo</th>
                            <th>Iki</th>
                            <th>Statusas</th>
                            <th>Mokėjimo statusas</th>
                            <th class="no-sort menu">Veiksmai</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($reservations->isNotEmpty())
                            @foreach($reservations as $key => $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>@if(isset($item->user)){{$item->user->name}}@endif</td>
                                    <td>{{$item->vehicles->name ?? 'Automobilis neegzistuoja'}}</td>
                                    <td>{{$item->from}}</td>
                                    <td>{{$item->until}}</td>
                                    <td>
                                        @if($item->isWaiting())
                                            <span class="label label-warning text-uppercase">Laukiama patvirtinimo</span>
                                        @elseif($item->isDisapproved())
                                            <span class="label label-danger text-uppercase">Atšauktas</span>
                                        @elseif($item->isConfirm())
                                            <span class="label label-primary text-uppercase">Patvirtintas</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->order)
                                            @if($item->order->isPaid())
                                                <span class="label label-success text-uppercase">Apmokėta</span>
                                            @elseif($item->order->isPending())
                                                <span class="label label-warning text-uppercase">Laukiama apmokėjimo</span>
                                            @elseif($item->order->isCanceled())
                                                <span class="label label-danger text-uppercase">Apmokėjimas atšauktas</span>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="para">
                                        <div class="dropdown">
                                            <a href="#" class="dropdown-toggle" id="dropdownMenu1"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                <i class="fa fa-bars fa-lg"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-right"
                                                aria-labelledby="dropdownMenu1">
                                                <li><a href="{{route('admin.lease.edit', ['id' => $item->id])}}"><i
                                                                class="fa fa-pencil fa-lg"></i> Redaguoti</a></li>
                                                <li><a target="_blank" href="{{route('order', $item->order['token'])}}"><i
                                                                class="fa fa-pencil fa-lg"></i> Peržiūrėti</a></li>
                                                <li><a href="#"
                                                       data-href="{{route('admin.lease.remove', ['id' => $item->id])}}"
                                                       data-toggle="modal" data-target="#confirm-delete"><i
                                                                class="fa fa-trash-o fa-lg"></i> Itrinti</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            Nieko nerasta...
                        @endif
                        </tbody>
                    </table>

                    @include('components.modals.all')
                </div>
            </div>
        </div>
    </div>
@endsection