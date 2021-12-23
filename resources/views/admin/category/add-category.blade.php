@extends('admin/layout')
@section('title', 'Add Category')
@section('category_class', 'active')
@section('container')
<h1 class="heading-title-custom">Add Category</h1>
<a href="{{url('category')}}" class="mt-5 mb-2">
<button class="au-btn au-btn-icon au-btn--green au-btn--small">
 <i class="zmdi zmdi-minus"></i> back
</button>
</a>
<div class="card m-t-30">
    <div class="card-header">
         <strong>Add Your Category</strong>  
    </div>

        <div class="card-body card-block">

             <form action="{{route('category.store')}}" method="post" class="form-horizontal" id="selectform" enctype="multipart/form-data">
                 @csrf
                 <div>
                     <div id="image_section" class="col col-md-12 mt-3 mb-5 d-flex justify-content-center align-items-center">
                         <i class="fa fa-camera upload-button"></i>
                         <input class="fileUpload" accept="image/jpeg, image/jpg" name="category_img" type="file" value="Choose a file">
                             <div class="upload-demo">             
                                 <div class="upload-demo-wrap">
                                 <img alt="your image" class="portimg" src="#">
                                 </div>
                             </div>          
                     </div>
                 </div>

                 <div class="row form-group">
                         <div class="col col-md-3">
                             <label for="hf-email" class=" form-control-label">Category Name</label>
                         </div>
                         <div class="col-12 col-md-9">
                             <input type="text" name="category_name" placeholder="Enter category name..." class="form-control" required />
                         </div>

                 @error('category_name')
                  <div class="sufee-alert alert with-close alert-secondary alert-dismissible fade show">
			  	     <span class="badge badge-pill badge-secondary">Success</span>
                       {{$message}}
			  	     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			  	     	<span aria-hidden="true">×</span>
			  	     </button>
			      </div>
                 @enderror
                 </div>
        
                 <div class="row form-group">
                      <div class="col col-md-3">
                         <label for="hf-password" class=" form-control-label">Category Slug</label>
                      </div>
                      <div class="col-12 col-md-9">
                         <input type="text" name="category_slug" placeholder="Enter category slug..." class="form-control" required />
                      </div>
                     @error('category_slug')
                      <div class="sufee-alert alert with-close alert-secondary alert-dismissible fade show mt-10">
			         	<span class="badge badge-pill badge-secondary">Success</span>
                         {{$message}}
			         	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			         		<span aria-hidden="true">×</span>
			         	</button>
			          </div>
                      @enderror
                 </div>

                 <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
                  <div class="card-footer">
                         <button type="submit" class="btn btn-primary btn-sm">
                             <i class="fa fa-dot-circle-o"></i> Submit
                         </button>
                         <button type="reset" class="btn btn-danger btn-sm"onclick="document.getElementById('selectform').reset(); document.getElementById('from').value = null; return false;">
                         <i class="fa fa-ban"></i> Reset
                         </button>
                  </div>
             </form>

        </div>
  
</div>

@endsection