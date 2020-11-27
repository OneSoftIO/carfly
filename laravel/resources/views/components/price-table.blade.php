@if($prices->isNotEmpty())
<div class="price-list">
    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <td><strong>Dienų skaičius</strong></td>
            <td><strong>Dienos kaina</strong></td>
        </tr>
        </thead>
        <tbody>
        @foreach($prices as $price)
            <tr>
                <td>{{$price->from}} - {{$price->to}}</td>
                <td>@if($price->hasDiscount())<span class="old-price">{{$price->price}}&euro;</span> <span class="price-discount">{{$price->discount}} &euro;</span> @else {{$price->price}} &euro;@endif </td>
            </tr>
        @endforeach
        <tr>
            <td>>30</td>
            <td><a target="_blank" href="{{route('contact.page')}}">Susisiekite</a></td>
        </tr>
        </tbody>
    </table>
</div>
@endif