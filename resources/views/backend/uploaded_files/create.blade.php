@extends('backend.layouts.app')

@section('content')
<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class="row align-items-center">
		<div class="col-md-6">
			<h1 class="h3">{{translate('Upload New File')}}</h1>
		</div>
		<div class="col-md-6 text-md-right">
			<a href="{{ route('uploaded-files.index') }}" class="btn btn-link text-reset">
				<i class="las la-angle-left"></i>
				<span>{{translate('Back to uploaded files')}}</span>
			</a>
		</div>
	</div>
</div>
<div class="card">
    <div class="card-header">
        <h5 class="mb-0 h6">{{translate('Drag & drop your files')}}</h5>
    </div>
    <div class="card-body">
    	<!--div id="aiz-upload-files" class="h-420px" style="min-height: 65vh">
    		
    	</div-->
		<form method="post" action="{{route('uploaded-files.store')}}" enctype="multipart/form-data">
			@csrf
			<div class="row">
				<div class="col-4">
					<div class="form-group">
						<label for="file_upl">Upload File</label>
						<input type="file" class="form-control" id="file_upl" name="file_upl" required>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-4">
					<div class="form-group">
						<label for="file_upl">Select Users</label>
						<select class="form-control aiz-selectpicker" id="user_list" name="user_list[]" multiple required>
							@foreach($sellers as $item)
							<option value="{{$item->id}}">{{$item->name}}</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-2">
					<div class="form-group">
						<input type="submit" class="form-control btn btn-info" id="" name="" value="Submit">
					</div>
				</div>
			</div>
		</form>
    </div>
</div>
@endsection

@section('script')
	<script type="text/javascript">
		$(document).ready(function() {
			AIZ.plugins.aizUppy();
		});
	</script>
@endsection