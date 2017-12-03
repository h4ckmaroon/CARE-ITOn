@extends('layouts.master')

@section('title')
    {{"Scan Request Code"}}
@stop

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/datatables/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/datatables/datatables-responsive/css/dataTables.responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/plugins/pace/pace.min.css') }}">
@endsection

@section('content')


<div class = "col-row" style = "display: inline;" id = "mainbody" >
<table class="tsel" border="0" width="100%">
	<tbody>
		<tr>
			<td valign="top" align="center" width="50%">
				<table class="tsel" border="0">
					<tbody><tr>
					<td><img class="selector" id="webcamimg" src="../pics/vidcam.png" onclick="setwebcam()" align="left" style="opacity: 1;" width=" 24px" height = "24px"></td>
					<td><img class="selector" id="qrimg" src="../pics/cam.png" onclick="setimg()" align="right" style="opacity: 0.2;"  width=" 24px" height = "24px"></td></tr>
					<tr><td colspan="2" align="center">
					<div id="outdiv"><video id="v" autoplay=""></video></div></td></tr>
					</tbody>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="3" align="center"> </td>
		</tr>
		<tr>
			<td colspan="3" align="center">
			<div id="result">- scanning -</div>
			</td>
		</tr>
	</tbody>
</table>
</div>

<canvas id="qr-canvas" width="800" height="600" style="width: 800px; height: 600px;"></canvas>
<script type="text/javascript">load();</script>

<style type="text/css">
	#qr-canvas:{
		display: none;
	}
</style>
@stop

@section('scripts')
<script src = "{{ URL::asset('/qrcodes/llqrcode.js') }} " ></script>
<script src = "{{ URL::asset('/qrcodes/webqr.js') }} " ></script>
<script type="text/javascript">

 var getCode = document.getElementById('result');

           if (getCode.innerHTML != "- scanning -" ){
           		$.ajax({
           		type: "POST",
                    cache: false,
                    url : "{{action('CollectionController@checkCode')}}",
                    data: {data:getCode},
                        success: function(data) {
                          console.log(data);
                          if (data==1) {

                           alert('Request Found!');
                           
                          }else{
                           $('#result').html('<span class="text-danger"> QR Code not registered</span>');
                          }
                          
                        }
           		});
           }

</script>
@stop
