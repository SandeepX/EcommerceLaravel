@if(isset($errors) && $errors->count()>0)

	<div class="alert alert-danger alert-bordered alert-dismissable fade show">
		<button class="close" data-dismiss="alert" aria-label="Close">×</button>
		You have an error  {{ $errors }}
	</div>
@endif

@if(session('success'))
	<div class="alert alert-success alert-bordered alert-dismissable fade show">
		<button class="close" data-dismiss="alert" aria-label="Close">×</button>
		{{ session('success') }}
	</div>
@endif


@if(session('error'))
	<div class="alert alert-danger alert-bordered alert-dismissable fade show">
		<button class="close" data-dismiss="alert" aria-label="Close">×</button>
		{{ session('error') }}
	</div>
@endif


	