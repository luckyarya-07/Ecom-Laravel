@extends('admin/layout')
@section('title', 'Category Listing')
@section('category_class', 'active')
@section('container')
<h1 class="heading-title-custom">Category Listing</h1>
<a href="{{ route('category.create') }}" class="mt-5 mb-2">
<button class="au-btn au-btn-icon au-btn--green au-btn--small">
 <i class="zmdi zmdi-plus"></i> add category
</button>
</a>
<div class="row m-t-30">
   <div class="col-md-12">
       <!-- DATA TABLE-->
       <div class="table-responsive m-b-40">
            @if (Session::has('success'))
            <div class="sufee-alert alert with-close alert-info alert-dismissible fade show">
				<span class="badge badge-pill badge-info">Success</span>
				{{session('success')}}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
          @endif
           <table class="table table-borderless table-data3 category-listing">
               <thead>
                   <tr>
                       <th>ID</th>
                       <th>Category Image</th>
                       <th>Category Name</th>
                       <th>Category Slug</th>
                       <th>Actions</th>
                   </tr>
               </thead>
               <tbody>
                    @php
                    {{ $i= 0; }}
                    @endphp
                     @foreach($pagination as $data)
                     
                   <tr>
                       <td>
                       {{ $data->id }}
                       </td>
                       <td>
                        @if ($data->category_img == true)
                        <img src="{{asset('images/').'/'.$data->category_img}}" id="cat_retrive_img">
                        @else
                        <img src="{{asset('images/images.png')}}" id="cat_retrive_img">
                        @endif
                       </td>
                       <td>{{ $data->category_name }}</td>
                       <td>{{ $data->category_slug }}</td>
                       <td>
                           <form action="{{ route('category.destroy', $data->id) }}" method="POST">
                           @csrf
                           @method('DELETE')
                           <div class="table-data-feature">
                           <a href="{{ route('category.edit', $data->id) }}" class="item ml-2" 
                           data-toggle="tooltip" 
                           data-placement="top" title="" data-original-title="Edit">
                            <i class="zmdi zmdi-edit"></i>
                           </a>
                           <button class="item" type="submit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
                            <i class="zmdi zmdi-delete"></i>
                            </button>
                           </form>
                           </div>
                        </td>
                       
                   </tr>
                   @endforeach
                  
               </tbody>
           </table>
            <div class="d-flex justify-content-center mt-2">
                {!! $pagination->appends(['sort' => 'category'])->links() !!}
            </div>
       </div>
       <!-- END DATA TABLE-->
   </div>
</div>
@endsection