@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card  border-info mb-3 mt-5">
                <div class="card-header p-3 fs-4 fw-bold text-bg-primary">
                    {{ __('Home Page') }}
                </div>

                <div class="card-body p-5">
                  
                    <div class="alert alert-success" role="alert">
                        {{ __('Hello!') }} {{ ucwords(Auth::user()->name) }} {{ __('You have successfully logged in...') }}
                    </div>                 

                </div>
                
            </div>
        </div>
    </div>

</div>
@endsection
