@extends('admin.general')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-content">
                <table datatable="" class="table table-striped table-bordered table-hover data-table">
                    <thead>
                    <tr>
                        <th>Nuotrauka</th>
                        <th>Automobilis</th>
                        <th>Automobilio klasė</th>
                        <th class="no-sort menu">Veiksmai</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($vehicles as $key => $item)
                        <tr>
                            <td>
                                @if($item->resize_images)
                                    @foreach($item->resize_images as $image)
                                        @if($loop->first)
                                            <img alt="image" class=" m-t-xs img-responsive" src="{{asset($image)}}">
                                        @endif
                                    @endforeach
                                @endif
                            </td>
                            <td>{{$item->name}}</td>
                            <td>{{($item->class !== 0)?$item->getClasses()[$item->class]['name']:"-"}}</td>
                            <td class="para">
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <i class="fa fa-bars fa-lg"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                                        <li><a href="{{route('admin.vehicles.edit', ['id' => $item->id, 'lang' => 'lt'])}}"><i class="fa fa-pencil fa-lg"></i> Redaguoti</a></li>
                                        <li><a href="#" data-href="{{route('admin.delete', ['table' => 'vehicles', 'id' => $item->id])}}" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o fa-lg"></i> Ištrinti</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
    @include('components.modals.all')
@endsection