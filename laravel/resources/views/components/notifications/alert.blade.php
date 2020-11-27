@if (\Session::has('err'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('err') !!}</li>
        </ul>
    </div>
@endif