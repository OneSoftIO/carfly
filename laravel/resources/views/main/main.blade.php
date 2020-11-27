@extends('general')
@section('content')
    @include('main.slider')
{{--    @include('main.features')--}}
    @include('main.about-us')
    @include('main.best-offers')
    @include('main.testimonials')
    @include('main.cars')
    @include('main.duk')
{{--    @include('main.find-car')--}}
    @include('main.articles')
    @include('main.subscribe')
{{--    @include('main.team')--}}
    @include('contact')
@endsection
@section('footer')
    <div class="modal fade" id="myModal2" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Reservation anytime</h4>
                </div>
                <div class="modal-body">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Uždaryti</button>
                </div>
            </div>

        </div>
    </div>
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">7/24 car suppport</h4>
                </div>
                <div class="modal-body">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Uždaryti</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModal3" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Lots of location</h4>
                </div>
                <div class="modal-body">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Uždaryti</button>
                </div>
            </div>

        </div>
    </div>
@endsection

@if(!empty($set_meta->getMeta('titulinis')->description))
    @section('meta-description', $set_meta->getMeta('titulinis')->description)
@endif
@if(!empty($set_meta->getMeta('titulinis')->keywords))
    @section('meta-keywords', $set_meta->getMeta('titulinis')->keywords)
@endif
@if(!empty($set_meta->getMeta('titulinis')->name))
    @section('title', $set_meta->getMeta('titulinis')->name)
@endif
