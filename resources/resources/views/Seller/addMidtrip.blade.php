@extends('Seller.layouts.app')
@section('data')
<div class="container border p-3 bg-light shadow round10">
	<form method="post" action="midtrip_post" enctype="multipart/form-data">
		@csrf
		<div class="form-group">
			<label for="location">Select Location</label>
			<select name="location_name" required class="form-control round10 shadow">
                <option>Please Select Location</option>
                @foreach($location as $locations)
                    <option value="{{ $locations -> id }}*{{ $locations -> name }}">{{ $locations -> name }}</option>
                @endforeach
            </select>
		</div>
		<div class="form-group">
			<label> Enter midtrip name :-</label>
			<input type="text" class="form-control shadow round10" name="midtrip_name[]" placeholder="Enter midtrip name"/>
		</div>
		
		<div class="form-group">
			<label> Enter midtrip description :-</label>
			<textarea class="form-control shadow round10" row="05" name="midtrip_des[]"></textarea>
		</div>
		
		<div class="form-group">
			<input type="file" name="midtrip_pic[]" class="form-control shadow round10" />
		</div>
		<div id="cont">
		</div>
		<div class="mt-3">
			<button type="button" class="btn round20 color1" onclick="addField()">Add midtrip</button>
		</div>
		<div class="text-center mt-4">
			<input class="bttn bttn-float bttn-md round20 color1 shadow" type="submit" name="submit"/>
		</div>
	</form>
</div>
@endsection
<script>
	let incValue = 1;
	function addField(){
		incValue = incValue + 1;
		var cont = document.getElementById('cont');
		
		var inputBr = document.createElement('br');
		cont.appendChild(inputBr);

		cont.appendChild(document.createTextNode("MidTrip " + incValue));
		var input = document.createElement('input');

		input.type = "text";
		input.style ="width:100%;padding:4px;margin:2px;border-radius:10px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);margin-top:10px";
		input.class= "form-control shadow round10";
		input.placeholder="Enter midtrip name";
		input.name = "midtrip_name[]";
		input.required = "required";
		cont.appendChild(input);

		var inputBr = document.createElement('br');
		cont.appendChild(inputBr);
		var inputBr = document.createElement('br');
		cont.appendChild(inputBr);

		cont.appendChild(document.createTextNode("MidTrip description " + incValue));
		var inputDes = document.createElement('textarea');
		inputDes.style ="width:100%;padding:10px;border-radius:10px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);margin-top:10px";
		inputDes.name = "midtrip_des[]";
		inputDes.row = "05";
		inputDes.required = "required";
		cont.appendChild(inputDes);

		// cont.appendChild(document.createTextNode("MidTrip picture"));
		var inputPic  = document.createElement('input');
		inputPic.style = "width:100%;padding:10px;border-radius:10px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);margin-top:10px";
		inputPic.type = "file";
		inputPic.name = "midtrip_pic[]";
		inputPic.required = "required";
		cont.appendChild(inputPic);
		var inputBr = document.createElement('br');
		cont.appendChild(inputBr);
	}
</script>