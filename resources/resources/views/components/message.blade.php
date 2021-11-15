@if (session('message'))
    <div class="alert alert-success alert-dismissible text-center">
	  <button type="button" class="close" data-dismiss="alert">&times;</button>
	  <p><strong>{{ session('message') }}</strong></p>
	</div>
@endif