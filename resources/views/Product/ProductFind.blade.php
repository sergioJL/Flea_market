@extends('Product.base')
@section('main')
<div class="i_bg">
    <!--Begin 筛选条件 Begin-->
    <div class="content mar_10">
    </div>
    <!--End 筛选条件 End-->

    <div class="content mar_20">
        <div class="l_list">
            <div class="list_t">
                <span class="fr">共发现 <font color="#a52a2a">{{ count($products) }}</font> 件</span>
            </div>
            <div class="list_c">
                <ul class="cate_list">
                    @if(count($products)==0)
                        <?php echo "没有您想要的商品" ?>
                    @else
                        @foreach($products as $product)
                            <li>
                                <div class="img"><a href="/product/detail/{{ $product['id'] }}"><img src="/storage/{{ $product['image'][0] }}" width="210"
                                                                  height="185"/></a></div>
                                <div class="price">
                                    <font>￥<span>{{ $product['price'] }}</span></font>
                                </div>
                                <div class="name"><a href="/product/detail/{{ $product['id'] }}">{{ $product['title'] }}</a></div>
                            </li>
                        @endforeach
                    @endif
                </ul>

                <div class="pages">
                    <div id="pull_right">
                        <div class="pull-right">
                            {!! $products->render() !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
