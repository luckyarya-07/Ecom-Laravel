@extends('admin/layout')
@section('title', 'Coupans')
@section('coupan_class', 'active')
@section('container')
<h1 class="heading-title-custom">Coupan Listing</h1>
<a href="{{ route('coupan.create') }}" class="mt-5 mb-2">
<button class="au-btn au-btn-icon au-btn--green au-btn--small">
 <i class="zmdi zmdi-plus"></i> add coupan
</button>
</a>
<div class="row m-t-30">
   <div class="col-md-12">
       @if (Session::has('success'))
            <div class="sufee-alert alert with-close alert-info alert-dismissible fade show">
				<span class="badge badge-pill badge-info">Success</span>
				{{session('success')}}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
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
                            <th>name</th>
                            <th>coupan code</th>
                            <th>start date</th>
                            <th>valid to</th>
                            <th>status</th>
                            <th>amount</th>
                        </tr>
                  </thead>          
                    <tbody>
                    @foreach($all__data as $data)
                    <tr class="tr-shadow">
                        <td>
                            <label class="au-checkbox">
                                <input type="checkbox" value="{{ $data->id }}">
                                <span class="au-checkmark"></span>
                            </label>
                        </td>
                        <td>{{ $data->coupan_name }}</td>
                        <td>
                            <span class="block-email">{{ $data->coupan_code }}</span>
                        </td>
                        <td class="desc">{{ $data->start_date }}</td>
                        <td class="desc">{{ $data->coupan_validity }}</td>
                        <td>
                            <span class="status--process">
                            @if ( date('Y-m-d')  ==  $data->start_date)
                            Active
                            @elseif ( date('Y-m-d')  <  $data->start_date )
                            Coming Soon
                            @elseif ( date('Y-m-d')  <  $data->coupan_validity )
                            Active
                            @elseif ( date('Y-m-d')  >=  $data->coupan_validity )
                            Expire
                            @else 
                            Coming Soon
                            @endif

                            </span>
                        </td>
                        <td>{{ $data->coupan_amount }}</td>
                        <td>
                            <form action="{{ route('coupan.destroy', $data->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="table-data-feature">
                                <a href="{{ route('coupan.edit', $data->id) }}" class="item ml-2" 
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
      </div>
       <!-- END DATA TABLE-->
   </div>
</div>
@endsection