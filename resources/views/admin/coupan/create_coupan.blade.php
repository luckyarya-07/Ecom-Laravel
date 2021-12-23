@extends('admin/layout')
@section('coupan_class', 'active')
@section('title', 'Add Category')
@section('container')
<h1 class="heading-title-custom">Add Coupan</h1>
<a href="{{url('coupan')}}" class="mt-5 mb-2">
<button class="au-btn au-btn-icon au-btn--green au-btn--small">
 <i class="zmdi zmdi-minus"></i> back
</button>
</a>
<div class="card">
                                    <div class="card-header">Add Coupan</div>
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center title-2">Create Coupan</h3>
                                        </div>
                                        <hr>
                                        <form action="{{route('coupan.store')}}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label class="control-label mb-1">Coupan Name</label>
                                                 <input name="coupan_name" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the coupan name"
                                                 autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">   
                                                
                                                 @error('coupan_name')
                                                 <div class="alert alert-danger mt-1" role="alert">
											       {{$message}}
										         </div>
                                                 @enderror

                                            </div>
                                            <div class="form-group has-success">
                                                <label class="control-label mb-1">Coupan Code</label>
                                                <input name="coupan_code" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the coupan code"
                                                 autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                                                
                                                 @error('coupan_code')
                                                 <div class="alert alert-danger mt-1" role="alert">
											       {{$message}}
										         </div>
                                                 @enderror

                                            </div>
                                            <div class="form-group">
                                                <label class="control-label mb-1">Coupan Amount</label>
                                                <input name="coupan_amount" type="text" class="form-control cc-number identified visa" value="" data-val="true" data-val-required="Please enter the coupan amount" data-val-cc-number="Please enter a valid coupan amount" autocomplete="cc-number">
                                               
                                                @error('coupan_amount')
                                                 <div class="alert alert-danger mt-1" role="alert">
											       {{$message}}
										         </div>
                                                 @enderror

                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <label class="control-label mb-1">Start From</label>
                                                    <div class="input-group">
                                                        <input id="cc-exp" name="start_date" type="date" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the coupan expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="MM / YY" autocomplete="cc-exp">
                                                    </div>
                                                    @error('start_date')
                                                    <div class="alert alert-danger mt-1" role="alert">
											          {{$message}}
										            </div>
                                                    @enderror
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cc-exp" class="control-label mb-1">Expiration</label>
                                                        <input id="cc-exp" name="coupan_validity" type="date" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the coupan expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="MM / YY" autocomplete="cc-exp">
                                                        @error('coupan_validity')
                                                        <div class="alert alert-danger mt-1" role="alert">
											              {{$message}}
										                </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
                                            </div>
                                            <div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                    <i class="fa fa-tags fa-md"></i>&nbsp;
                                                    <span id="payment-button-amount">Save Coupan</span>
                                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

@endsection