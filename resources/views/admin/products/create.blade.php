@extends('admin/layout')
@section('title', 'Create Products')
@section('products_class', 'active')
@section('container')
<h1 class="heading-title-custom">Create Product</h1>
<a href="{{ route('product.index') }}" class="mt-2 mb-2">
<button class="au-btn au-btn-icon au-btn--green au-btn--small">
 <i class="zmdi zmdi-minus"></i> product listing
</button>
</a>


<div class="card">
                                    <div class="card-header">Add Product</div>
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center title-2">Create Product</h3>
                                        </div>
                                        <hr>
                                        <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                           
                                            <div class="row">
                                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
                                                <div class="col-6">
                                                <label class="control-label mb-1">Product Name</label>
                                                 <input name="title" type="text" 
                                                 class="form-control cc-name valid" 
                                                 onload="convertToSlug(this.value)" onkeyup="convertToSlug(this.value)"
                                                 placeholder="Product title">   
                                                
                                                 @error('title')
                                                 <div class="alert alert-danger mt-1" role="alert">
											       {{$message}}
										         </div>
                                                 @enderror
                                                </div>

                                                <div class="col-6">
                                                <label class="control-label mb-1">Product Slug</label>
                                                <input name="slug" type="text"
                                                class="form-control cc-name valid"
                                                id="product_slug"
                                                value="" 
                                                placeholder="Product slug">
                                               
                                                
                                                 @error('slug')
                                                 <div class="alert alert-danger mt-1" role="alert">
											       {{$message}}
										         </div>
                                                 @enderror
                                                </div>
                                            </div>

                                            <!-- <div class="form-group mt-3 mb-3">
                                                <label class="control-label mb-1 mt-2">Featured Image</label>
                                                 <div id="image_section" class="col col-md-12 d-flex justify-content-center align-items-center">
                                                     <i class="fa fa-camera upload-button"></i>
                                                     <input class="fileUpload" accept="image/jpeg, image/jpg" name="featured_img" type="file" value="Choose a file">
                                                         <div class="upload-demo">             
                                                             <div class="upload-demo-wrap">
                                                             <img alt="your image" class="portimg" src="#">
                                                             </div>
                                                         </div>          
                                                 </div>    -->
                                                
                                                 
                                            <!-- </div> -->

                                            <div class="form-group mt-3 mb-3">
                                                <label class="control-label mb-1 mt-2">Featured Image</label>
                                                 
                                                 <input type="file" name="multi_img" id="multi_img">
                                                 <!-- <input type="file" 
                                                  class="filepond"
                                                  name="multi_img"
                                                  id="multi_img"
                                                  multiple
                                                  data-max-file-size="3MB"
                                                  data-max-files="3" /> -->
                                                 
                                                 <!-- <input type="hidden" name="multi_img"> -->
                                                 @error('multi_img')
                                                 <div class="alert alert-danger mt-1" role="alert">
											       {{$message}}
										         </div>
                                                 @enderror

                                            </div>
                                            
                                            <div class="form-group mt-3 mb-3">
                                                <label class="control-label mb-1 mt-2">Add Product Images</label>
                                                <!-- <input type="file" name="featured_img[]" id="new">  -->
                                                  <!-- <input type="file" name="featured_img[]" id="new2">
                                                  <input type="file" name="featured_img[]" id="new3">  -->
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
                                                        <option value="">Select a Category</option>
                                                
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
                                                        <input id="cc-exp" name="mrp_price" type="text" class="form-control cc-exp"
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
                                                        <input id="cc-exp" name="sale_price" type="text" class="form-control cc-exp"
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
                                                        @php
                                                        $uniqsku = uniqid();
                                                       
                                                        @endphp
                                                        <input id="cc-exp" name="sku" value="{{$uniqsku}}"
                                                        placeholder="Product SKU" class="form-control cc-exp">
                                                        </input>
                                                        @error('sku')
                                                        <div class="alert alert-danger mt-1" role="alert">
											              {{$message}}
										                </div>
                                                        @enderror
                                            </div> 

                                            <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Specifications</label>
                                                        <textarea id="cc-exp" name="specification" class="form-control cc-exp">
                                                        </textarea>
                                                        @error('specification')
                                                        <div class="alert alert-danger mt-1" role="alert">
											              {{$message}}
										                </div>
                                                        @enderror
                                            </div>

                                             <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Short Description</label>
                                                        <textarea id="cc-exp" name="short_description" class="form-control cc-exp">
                                                        </textarea>
                                                        @error('short_description')
                                                        <div class="alert alert-danger mt-1" role="alert">
											              {{$message}}
										                </div>
                                                        @enderror
                                            </div>

                                            <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Description</label>
                                                        <textarea id="cc-exp" name="description" class="form-control cc-exp">
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
@section('scripts')                              
<script>
FilePond.registerPlugin(
	
	// encodes the file as base64 data
  FilePondPluginFileEncode,
	
	// validates the size of the file
	FilePondPluginFileValidateSize,
	
	// corrects mobile image orientation
	FilePondPluginImageExifOrientation,
	
	// previews dropped images
  FilePondPluginImagePreview
);

FilePond.create(
	document.querySelector('input[id="multi_img"]')
);

FilePond.create(
	document.querySelector('input[id="new"]')
);
FilePond.create(
	document.querySelector('input[id="new2"]')
);
FilePond.create(
	document.querySelector('input[id="new3"]')
);
// const inputElement = document.querySelector('input[id="multi_img"]');
// const pond = FilePond.create( inputElement );

FilePond.setOptions({
    server: {
        url: '/upload',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    }
});

/* Encode string to slug */
function convertToSlug( str ) {
	
  //replace all special characters | symbols with a space
  str = str.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ').toLowerCase();
	
  // trim spaces at start and end of string
  str = str.replace(/^\s+|\s+$/gm,'');
	
  // replace space with dash/hyphen
  str = str.replace(/\s+/g, '-');	
  document.getElementById("product_slug").value = str;
  
//   $("#product_slug").val(Text); 
  //return str;
}

if (window.File && window.FileList && window.FileReader) {
    $("#files").on("change", function(e) {
      var files = e.target.files,
        filesLength = files.length;
      for (var i = 0; i < filesLength; i++) {
        var f = files[i]
        var fileReader = new FileReader();
        fileReader.onload = (function(e) {
          var file = e.target;
          $("<span class=\"pip\">" +
            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
            "<br/><span class=\"remove\">Remove image <i class=\"fas fa-minus-square\" aria-hidden=\"true\"></i></span>" +
            "</span>").insertAfter("#files");
          $(".remove").click(function(){
            $(this).parent(".pip").remove();
          });
          
          // Old code here
          /*$("<img></img>", {
            class: "imageThumb",
            src: e.target.result,
            title: file.name + " | Click to remove"
          }).insertAfter("#files").click(function(){$(this).remove();});*/
          
        });
        fileReader.readAsDataURL(f);
      }
      console.log(files);
    });
  } else {
    alert("Your browser doesn't support to File API")
  }

   $(".add-btn").click(function(){ 
          var html = $(".clone").html();
          $(".increment").after(html);
      });
      $("body").on("click",".close-btn",function(){ 
          $(this).parents(".control-group").remove();
      });
</script>


@endsection

@endsection