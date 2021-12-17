@extends('layout.mainlayout')
@section('content')

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="row">
			<div class="col-md-12">	
					@if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
					{{ __('You are logged in !') }}
            </div> 
        </div>
    </div>
</div>
@endsection
