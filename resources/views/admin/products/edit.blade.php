@extends('admin/layout')
@section('title', 'Create Products')
@section('products_class', 'active')
@section('container')
<h1 class="heading-title-custom">Update Product</h1>
<a href="{{ route('product.index') }}" class="mt-3 mb-2">
<button class="au-btn au-btn-icon au-btn--green au-btn--small">
 <i class="zmdi zmdi-minus"></i> product listing
</button>
</a>


<div class="card">
                                    <div class="card-header">Update Product</div>
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center title-2">Create Product</h3>
                                        </div>
                                        <hr>
                                        <!-- {{$posts}} -->
                                        
                                           <form action="{{route('product.update', $posts->id)}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
                                                <div class="col-6">
                                                <label class="control-label mb-1">Product Name</label>
                                                 <input name="title" type="text" value="{{$posts->title}}"
                                                 class="form-control cc-name valid" placeholder="Product title">   
                                                
                                                 @error('title')
                                                 <div class="alert alert-danger mt-1" role="alert">
											       {{$message}}
										         </div>
                                                 @enderror
                                                </div>

                                                <div class="col-6">
                                                <label class="control-label mb-1">Product Slug</label>
                                                <input name="slug" type="text" value="{{$posts->slug}}"
                                                 class="form-control cc-name valid" placeholder="Product slug">
                                                
                                                 @error('slug')
                                                 <div class="alert alert-danger mt-1" role="alert">
											       {{$message}}
										         </div>
                                                 @enderror
                                                </div>
                                            </div>

                                            <div class="form-group mt-3 mb-3">
                                                <label class="control-label mb-1 mt-2">Featured Image</label>
                                                 @if ($posts->featured_img == true)
                                                 <div 
                                                 style="
                                                 background-image:url(/images/{{$posts->featured_img}});
                                                 height: 200px;
                                                 background-repeat: no-repeat;
                                                 background-position: center;
                                                 background-size: cover;"
                                                 class="col col-md-12 mt-3 mb-5 p-0 d-flex 
                                                 justify-content-center align-items-center">
                                                 @else 
                                                 <div 
                                                 style="
                                                 background-image:url(/images/images.png);
                                                 height: 200px;"
                                                 class="col col-md-12 mt-3 mb-5 p-0 d-flex 
                                                 justify-content-center align-items-center">
                                                 @endif
                                                     <i class="fa fa-camera upload-button"></i>
                                                     <input class="fileUpload" accept="image/jpeg, image/jpg" name="featured_img" type="file" value="Choose a file">
                                                         <div class="upload-demo">             
                                                             <div class="upload-demo-wrap">
                                                             <img alt="your image" class="portimg" src="#">
                                                             </div>
                                                         </div>          
                                                 </div>
                                                
                                                 @error('featured_img')
                                                 <div class="alert alert-danger mt-1" role="alert">
											       {{$message}}
										         </div>
                                                 @enderror

                                            </div>

                                            <div class="row">
                                                <div class="col-4">
                                                    <label for="category_id">Category</label>
                                                    <select class="form-control" name="category_id" required>
                                                    @foreach ($catname as $name)
                                                
                                                    @endforeach
                                                        <option value="{{ $name->id }}"{{ $name->id === old('category_id') ? 'selected' : '' }}>{{ $name->name }}</option>
                                                        
                                                        @foreach ($categories as $category)
                                                        
                                                            <option value="{{ $category->id }}" {{ $category->id === old('category_id') ? 'selected' : '' }}>{{ $category->name }}</option>
                                                            @if ($category->children)
                                                                @foreach ($category->children as $child)
                                                                    <option value="{{ $child->id }}" {{ $child->id === old('category_id') ? 'selected' : '' }}>&nbsp;&nbsp;{{ $child->name }}</option>
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                    <div class="alert alert-danger mt-1" role="alert">
											          {{$message}}
										            </div>
                                                    @enderror
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">MRP Price</label>
                                                        <input id="cc-exp" name="mrp_price" type="text" 
                                                        class="form-control cc-exp" value="{{$posts->mrp_price}}"
                                                        placeholder="MRP">
                                                        @error('mrp_price')
                                                        <div class="alert alert-danger mt-1" role="alert">
											              {{$message}}
										                </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Sale Price</label>
                                                        <input id="cc-exp" name="sale_price" type="text" 
                                                        class="form-control cc-exp" value="{{$posts->sale_price}}"
                                                        placeholder="Sale Price">
                                                        @error('sale_price')
                                                        <div class="alert alert-danger mt-1" role="alert">
											              {{$message}}
										                </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">SKU</label>
                                                        <input id="cc-exp" name="sku" placeholder="Product SKU" 
                                                        class="form-control cc-exp" value="{{$posts->sku}}"> 
                                                        @error('sku')
                                                        <div class="alert alert-danger mt-1" role="alert">
											              {{$message}}
										                </div>
                                                        @enderror
                                            </div> 

                                            <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Specifications</label>
                                                        <textarea id="cc-exp" name="specification"
                                                         class="form-control cc-exp">
                                                         {{$posts->specification}}
                                                        </textarea>
                                                        @error('specification')
                                                        <div class="alert alert-danger mt-1" role="alert">
											              {{$message}}
										                </div>
                                                        @enderror
                                            </div>

                                             <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Short Description</label>
                                                        <textarea id="cc-exp" name="short_description" 
                                                        class="form-control cc-exp">
                                                        {{$posts->short_description}}
                                                        </textarea>
                                                        @error('short_description')
                                                        <div class="alert alert-danger mt-1" role="alert">
											              {{$message}}
										                </div>
                                                        @enderror
                                            </div>

                                            <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Description</label>
                                                        <textarea id="cc-exp" name="description" 
                                                        class="form-control cc-exp">
                                                         {{$posts->description}}
                                                        </textarea>
                                                        @error('description')
                                                        <div class="alert alert-danger mt-1" role="alert">
											              {{$message}}
										                </div>
                                                        @enderror
                                            </div>
                                            <div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                    <i class="fa fa-tags fa-md"></i>&nbsp;
                                                    <span id="payment-button-amount">Create Product</span>
                                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>


<div class="form-group">
    
</div>









@endsection