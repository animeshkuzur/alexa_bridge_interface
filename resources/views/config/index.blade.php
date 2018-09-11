<!DOCTYPE html>
<html>
<head>
	<title>SILOP :: Smart Intelligent Living Our Promise</title>
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{URL::asset('/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{URL::asset('/css/styles.css')}}">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">
                
                Alexa Bridge Interface 
            </a>
        </div>        
    </nav>

	<div class="enable-panel">
		<div class="container">
			<div class="title">
				Unlock Bridge <a href="http://silop.in" target="_blank"><img src="{{ URL::asset('/assets/logo.png') }}" height="60" width="144" class="float-right"></a>
			</div>
			<hr>
			<div class="errors">
				@if($errors)
                    @if(count($errors))
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <font style="font-size: 12px; padding: 0px; margin : 0px;">
                                    {{ $error }}
                                </font>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                          
                                </button>
                            </div>
                        @endforeach
                    @endif
                @endif
			</div>
			<div class="content">
				{{ Form::open(array('route' => 'enable','method'=>'POST','files'=> true)) }}
                    <div class="form-group ">
                        <label for="key">Key File :</label>
                        <input type="file" class="form-control" id="key" aria-describedby="key" name="key">           
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                {{ Form::close() }}
			</div>
		</div>
	</div>
	<script src="{{URL::asset('/js/jquery.min.js')}}"></script>
    <script src="{{URL::asset('/js/popper.min.js')}}"></script>
    <script src="{{URL::asset('/js/bootstrap.min.js')}}"></script>
</body>
</html>