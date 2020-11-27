@if(isset($cats) && $cats->isNotEmpty())
<div class="widget shadow car-categories">
    <h4 class="widget-title text-uppercase">@lang('page.categories')</h4>
    <div class="widget-content">
        <ul>
            @foreach($cats as $cat)
            <li>
                <a class="{{(route('blog.cat', ['id'=>$cat->id, 'slug' => $cat->trans->slug]) == Request::url())?'active':null}}" href="{{route('blog.cat', ['id'=>$cat->id, 'slug' => $cat->trans->slug])}}"> {{$cat->trans->name}}</a>
                @if($cat->childs->isNotEmpty())
                <ul class="child">
                    @foreach($cat->childs as $item)
                    <li>
                        <a class="{{(route('blog.cat', ['id'=>$item->id, 'slug' => $item->trans->slug]) == Request::url())?'active':null}}" href="{{route('blog.cat', ['id'=>$item->id, 'slug' => $item->trans->slug])}}">{{$item->trans->name}}</a>
                    </li>
                    @endforeach
                </ul>
                @endif
            </li>
            @endforeach
        </ul>
    </div>
</div>
@endif