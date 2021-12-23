@extends('admin/layout')
@section('title', 'Products')
@section('products_class', 'active')
@section('container')
<h1 class="heading-title-custom">Products Listing</h1>
<a href="{{ route('product.create') }}" class="mt-3 mb-2">
<button class="au-btn au-btn-icon au-btn--green au-btn--small">
 <i class="zmdi zmdi-plus"></i> add product
</button>
</a>

  @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <h4 class="alert-heading">Success!</h4>
                <p>{{ Session::get('success') }}</p>

                <button type="button" class="close" data-dismiss="alert aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

<!-- DATA TABLE-->
      <div class="table-responsive table-responsive-data2">
            <table class="table table-data2">
                  <thead>
                        <tr>
                            <th>
                                <label class="au-checkbox">
                                    <input type="checkbox">
                                    <span class="au-checkmark"></span>
                                </label>
                            </th>
                            <th>title</th>
                            <th>slug</th>
                            <th>category</th>
                            <th>price</th>
                        </tr>
                  </thead>          
                    <tbody>
                    @foreach($pagination as $post)
                    <tr class="tr-shadow">
                        <td>
                            <label class="au-checkbox">
                                <input type="checkbox" value="{{ $post->id }}">
                                <span class="au-checkmark"></span>
                            </label>
                        </td>
                        <td>{{ $post->title }}</td>
                        <td>
                            <span class="block-email">{{ $post->slug }}</span>
                        </td>
                        <td>
                            <span class="status--process">
                            {{ $post->category ? $post->category->name : 'Uncategorized' }}
                            </span>
                        </td>
                        <td>
                        {{ $post->mrp_price }} 
                        @if (  $post->sale_price != NULL ) 
                        - {{ $post->sale_price }} 
                        @endif
                        </td>
                        <td>
                            <form action="{{ route('product.destroy', $post->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="table-data-feature">
                                <a href="{{ route('product.edit', $post->id) }}" class="item ml-2" 
                                data-toggle="tooltip" 
                                data-placement="top" title="" data-original-title="Edit">
                                 <i class="zmdi zmdi-edit"></i>
                                </a>
                                <button class="item" type="submit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
                                    <i class="zmdi zmdi-delete"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                     <tr class="spacer"></tr>
                    @endforeach
                    
                    </tbody>
            </table>
            
            <div class="d-flex justify-content-center mt-2">
                {!! $pagination->appends(['sort' => 'products'])->links() !!}
            </div> 
      </div>
       <!-- END DATA TABLE-->
<!-- <div class="row">
    @foreach($posts as $post)
        <div class="col-md-4 mt-4">
            <div class="card">
                <div class="card-header">
                    <h3>{{ $post->title }}</h3>
                    <p class="text-muted">{{ $post->category ? $post->category->name : 'Uncategorized' }}</p>
                </div>
                <div class="card-body">
                    <p>{{ substr($post->description, 0, 100) }}</p>
                    <a href="{{ route('product.show', $post->slug) }}" class="btn btn-primary btn-block">Read More</a>
                </div>
            </div>
        </div>
    @endforeach
</div> -->







@endsection