@extends('layouts.master')
@section('linkextra')
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/style.css') }}">
@endsection
@section('content')
<div id="loading">

</div>
	<div class="container">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<div class="col-xs-6 col-xs-offset-3">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">Input link</h3>
				</div>
				<div class="panel-body">
					<label for="link">Input your link</label>
					<div class="input-group form-group input-group-md" id="input_link">
						<span class="input-group-addon" id="basic-addon1">
							<span class="glyphicon glyphicon-cloud"></span>
						</span>
						<input name="link" type="url" class="form-control" id="link"">
						<span class="input-group-btn">
							<button type="button" class="btn btn-primary" id="go"><span class="glyphicon glyphicon-arrow-right">GO</span></button>
						</span>
					</div>
					<div id="result">
						<hr>
							<div class="alert" role="alert">
							<strong>Well done!</strong> Your link is shortern <br>
							  <span class="glyphicon glyphicon-hand-right"></span><span>      </span><a href="#" class="alert-link" id="hash">http://url.dev</a>
							</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

@section('script')
	<script>
		$(document).ready(function() {
			$.ajaxSetup({
			        headers: {
			            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			        }
			});

			function progress(){
				$("#loading").show();
				setTimeout(function(e){
					link = $("#link").val();
					$.post("create",{link : link},function(data){
						if(data.status == 1){
							$("#result").slideToggle();
							$(".alert").addClass('alert-success');
							$("#hash").attr("href",data.hash);
							$("#hash").text(data.hash);
						}
						$("#link").val("");
						$("#link").attr("placeholder",link);
						$("#loading").hide();
						
					});
				}, 100);				
			}
			$("#link").bind("paste",function(){
				progress();
			});
			$("#go").click(function(event) {
				progress();
			});
		});
	</script>
@stop