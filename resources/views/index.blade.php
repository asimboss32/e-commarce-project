@extends('master')

@section('content')


	<!-- /Home Slider -->
	<section class="home-slider-section">
		<div class="container">
			<div class="home__slider-sec-wrap">
				<div class="home__category-outer">
					<ul class="header__category-list">
						@foreach ($categoriesGlobal as $category)
						<li class="header__category-list-item item-has-submenu">
							<a href="{{url('/category-products/'.$category->id)}}" class="header__category-list-item-link">
								<img src="{{asset('backend/images/category/'.$category->image)}}" alt="category">
								{{$category->name}}
							</a>
							<ul class="header__nav-item-category-submenu">
								@foreach ($category->subcategory as $subCategory)
									<li class="header__category-submenu-item">
									<a href="{{url('/sub-category-products/'.$subCategory->id)}}" class="header__category-submenu-item-link">
										{{$subCategory->name}}
									</a>
								</li>
								@endforeach
							</ul>
						</li>	
						@endforeach
					</ul>
				</div>
				<div class="home__slider-items-wrapper">
					<div class="home__slider-item-outer">
						<img src="{{asset('backend/images/setting/'.$siteSettings->banner)}}" alt="image" class="home__slider-item-image">
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- /Home Slider -->

	<!-- Categoris Slider -->
	<section class="categoris-slider-section">
		<div class="container">
			<div class="section-title-outer">
				<h1 class="title">
					Categories
				</h1>
			</div>
			<div class="categoris-items-wrapper owl-carousel">
				@foreach ($categories as $category)
				<a href="{{url('/category-products/'.$category->id)}}" class="categoris-item">
					<img src="{{asset('Backend/images/category/'.$category->image)}}" alt="category" />
					<h6 class="categoris-name">
						{{$category->name}}
					</h6>
					<span class="items-number">{{App\Models\Products::where('cate_id',$category->id)->count()}} items</span>
				</a>	
				@endforeach
				
			</div>
			
			
		</div>
	</section>
	<!-- /Categoris Slider -->
	<!-- Banner -->
	<section class="banner-section">
		<div class="container">
			<div class="row">
				@foreach ($topBanners as $banner)
					<div class="col-lg-4 col-md-6 col-sm-6">
					<div class="banner-item-outer">
						<img src="{{asset('backend/images/setting/'.$banner->banner_image)}}" alt="banner image" />
					</div>
				</div>
				@endforeach
				
			</div>
		</div>
	</section>
	<!-- /Banner -->
	<!-- Popular Product -->
	<section class="product-section">
		<div class="container">
			<div class="section-title-outer">
				<h1 class="title">
					Hot Products
				</h1>
				<a href="{{url('/View-All/hot')}}" class="product-view-all-btn">
					View All
				</a>
			</div>
			<div class="product-items-wrapper">
	         @foreach ($hotProducts as $product)
							<div class="product__item-outer">
					<div class="product__item-image-outer">
						<a href="{{url('product-dettails/'.$product->slug)}}" class="product__item-image-inner">
							<img src="{{asset('backend/images/products/'.$product->image)}}" alt="Product Image" />
						</a>
						<div class="product__item-add-cart-btn-outer">
							<a href="{{url('/add-to-cart/'.$product->id)}}" class="product__item-add-cart-btn-inner">
								Add to Cart
							</a>
						</div>
						<div class="product__type-badge-outer">
							<span class="product__type-badge-inner">
							{{ucfirst($product->product_type)}}
							</span>
						</div>
					</div>
					<div class="product__item-info-outer">
						<a href="{{url('product-dettails/'.$product->slug)}}" class="product__item-name">
							{{$product->name}}
						</a>
						<div class="product__item-price-outer">
						@if ($product->discount_price != null)
								<div class="product__item-discount-price">
								<del>{{$product->reguler_price}}Tk.</del>
							</div>
							<div class="product__item-regular-price">
								<span>{{$product->discount_price}}Tk.</span>
							</div>
							@elseif ($product->discount_price == null)
								<div class="product__item-discount-price">
								<span>{{$product->reguler_price}}Tk.</span>
							</div>
						@endif
						</div>
					</div>
				</div>
			 @endforeach

			</div>
		</div>
	</section>
	<!-- /Popular Product -->
	<!-- Popular Product -->
	<section class="product-section">
		<div class="container">
			<div class="section-title-outer">
				<h1 class="title">
					New Arrival
				</h1>
				<a href="{{url('/View-All/new')}}" class="product-view-all-btn">
					View All
				</a>
			</div>
			<div class="product-items-wrapper">
		@foreach ( $newProducts as $product)
					<div class="product__item-outer">
					<div class="product__item-image-outer">
						<a href="{{url('product-dettails/'.$product->slug)}}" class="product__item-image-inner">
							<img src="{{asset('backend/images/products/'.$product->image)}}" alt="Product Image" />
						</a>
						<div class="product__item-add-cart-btn-outer">
							<a href="{{url('/add-to-cart/'.$product->id)}}" class="product__item-add-cart-btn-inner">
								Add to Cart
							</a>
						</div>
						<div class="product__type-badge-outer">
							<span class="product__type-badge-inner">
							{{ucfirst($product->product_type)}}
							</span>
						</div>
					</div>
					<div class="product__item-info-outer">
						<a href="{{url('product-dettails/'.$product->slug)}}" class="product__item-name">
							{{$product->name}}
						</a>
						<div class="product__item-price-outer">
							@if ($product->discount_price != null)
								<div class="product__item-discount-price">
								<del>{{$product->reguler_price}}Tk.</del>
							</div>
							<div class="product__item-regular-price">
								<span>{{$product->discount_price}}Tk.</span>
							</div>
							@elseif ($product->discount_price == null)
								<div class="product__item-discount-price">
								<span>{{$product->reguler_price}}Tk.</span>
							</div>
						@endif
						</div>
					</div>
				</div>
		@endforeach
			</div>
		</div>
	</section>
	<!-- /Popular Product -->
	<!-- Popular Product -->
	<section class="product-section">
		<div class="container">
			<div class="section-title-outer">
				<h1 class="title">
					Regular Products
				</h1>
				<a href="{{url('/View-All/reguler')}}" class="product-view-all-btn">
					View All
				</a>
			</div>
			<div class="product-items-wrapper">
				@foreach ($ragularProducts as $product)
					<div class="product__item-outer">
					<div class="product__item-image-outer">
						<a href="{{url('product-dettails/'.$product->id)}}" class="product__item-image-inner">
							<img src="{{asset('backend/images/products/'.$product->image)}}" alt="Product Image" />
						</a>
						<div class="product__item-add-cart-btn-outer">
							<a href="{{url('/add-to-cart/'.$product->id)}}" class="product__item-add-cart-btn-inner">
								Add to Cart
							</a>
						</div>
						<div class="product__type-badge-outer">
							<span class="product__type-badge-inner">
								{{ucfirst($product->product_type)}}
							</span>
						</div>
					</div>
					<div class="product__item-info-outer">
						<a href="{{url('product-dettails/'.$product->slug)}}" class="product__item-name">
							{{$product->name}}
						</a>
						<div class="product__item-price-outer">
							@if ($product->discount_price != null)
								<div class="product__item-discount-price">
								<del>{{$product->reguler_price}}Tk.</del>
							</div>
							<div class="product__item-regular-price">
								<span>{{$product->discount_price}}Tk.</span>
							</div>
							@elseif ($product->discount_price == null)
								<div class="product__item-discount-price">
								<span>{{$product->reguler_price}}Tk.</span>
							</div>
						@endif
						</div>
					</div>
				</div>
				@endforeach
			
			</div>
		</div>
	</section>
	<!-- /Popular Product -->
	<!-- Popular Product -->
	<section class="product-section">
		<div class="container">
			<div class="section-title-outer">
				<h1 class="title">
					Discount Products
				</h1>
				<a href="{{url('/View-All/discount')}}" class="product-view-all-btn">
					View All
				</a>
			</div>
			<div class="product-items-wrapper">
				@foreach ($discountProducts as $product)
					<div class="product__item-outer">
					<div class="product__item-image-outer">
						<a href="{{url('product-dettails/'.$product->slug)}}" class="product__item-image-inner">
							<img src="{{asset('backend/images/products/'.$product->image)}}" alt="Product Image" />
						</a>
						<div class="product__item-add-cart-btn-outer">
							<a href="{{url('/add-to-cart/'.$product->id)}}" class="product__item-add-cart-btn-inner">
								Add to Cart
							</a>
						</div>
						<div class="product__type-badge-outer">
							<span class="product__type-badge-inner">
								{{ucfirst($product->product_type)}}
							</span>
						</div>
					</div>
					<div class="product__item-info-outer">
						<a href="{{url('product-dettails/'.$product->slug)}}" class="product__item-name">
							{{$product->name}}
						</a>
						<div class="product__item-price-outer">
							@if ($product->discount_price != null)
								<div class="product__item-discount-price">
								<del>{{$product->reguler_price}}Tk.</del>
							</div>
							<div class="product__item-regular-price">
								<span>{{$product->discount_price}}Tk.</span>
							</div>
							@elseif ($product->discount_price == null)
								<div class="product__item-discount-price">
								<span>{{$product->reguler_price}}Tk.</span>
							</div>
						@endif
						</div>
					</div>
				</div>
			
				@endforeach
			</div>
		</div>
	</section>
	<!-- /Popular Product -->


@endsection