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
  <div class="counter" hidden="hidden" id="counter">
    <div class="text">
      <h5>Reboot Initiated</h5>
      <div class="sec" id="sec">
        45
      </div>seconds remaining
    </div>
  </div>
  <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">
                
                Alexa Bridge Interface 
            </a>
                <button class="btn btn-outline-warning my-2 my-sm-0 btn-sm" id="snr" name="snr">Save and Reboot</button>   
        </div>        
    </nav>
	<div class="config-panel">
		<div class="container">
			<div class="title">
				Alexa-TIS Bridge <a href="{{ url('/').'/reload/1' }}" class="btn btn-outline-secondary">Reload</a> <a href="http://silop.in" target="_blank"><img src="{{ URL::asset('/assets/logo.png') }}" height="60" width="144" class="float-right"></a>
			</div>
			<hr>
      <div class="errors">
                  @if($errors)
                              @if(count($errors))
                                  @foreach($errors->all() as $error)
                                      <div class="alert alert-danger alert-dismissible" role="alert">
                                          <font style="font-size: 12px; padding: 0px; margin : 0px;">
                                              {{$error}}
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
        <div class="devices">
          <div class="title">
            TIS APIs : <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#add_api">Create a new API</button>
          </div>
          <div class="content">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th scope="col">Index</th>
                  <th scope="col">IP Address</th>
                  <th scope="col">Device ID</th>
                  <th scope="col">Subnet ID</th>
                  <th scope="col">Channel ID</th>
                  <th scope="col">Action</th>
                  <th scope="col">APIs</th>
                </tr>
              </thead>
              <tbody>
                @if($apis!=NULL)
                  @foreach($apis as $api)
                    <tr>
                      <td>{{ $api['index'] }}</td>
                      <td>{{ $api['ip_addr'] }}</td>
                      <td>{{ $api['deviceID'] }}</td>
                      <td>{{ $api['subnetID'] }}</td>
                      <td>{{ $api['channel'] }}</td>
                      <td><a href="{{ url('/alexa/').'/'.$api['id'].'/delete/api' }}" class="btn btn-sm btn-outline-danger">Delete</a> <!-- <button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#edit_device">Edit</button> --></td>
                      <td>
                        <div>
                        <div class="row">
                          <div class="col">
                            <span class="badge badge-pill badge-success">ON</span> {{ 'http://localhost:599/api?index='.$api['index'].'&action=turnOn' }}
                          </div>
                        </div>
                        <hr style="margin:0px;padding:0px;">
                        <div class="row">
                          <div class="col">
                            <span class="badge badge-pill badge-danger">OFF</span> {{ 'http://localhost:599/api?index='.$api['index'].'&action=turnOff' }}
                          </div>
                        </div>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
      
				
			</div>
		</div>
	</div>

		<!-- Add API Modal -->
        <div class="modal fade" id="add_api" tabindex="-1" role="dialog" aria-labelledby="add_api" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Create a New API</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="container">
                  <div class="row">
                    <div class="col">
                      <div class="title">
                        {!! Form::open(array('route' => 'alexa/add/api','method'=>'POST')) !!}
                        <div class="row">
                         	<div class="col">
                         		<div class="form-group">
		                         	<label for="index">Index</label>
		                         	<input type="text" name="index" id="index" class="form-control form-control-sm" disabled="disabled" value="{{ $index+1 }}">
		                        </div>
                         	</div>
                         	<div class="col">
                         		<div class="form-group">
                          		<label for="ip_addr">IP Address</label>
		                         	<input type="text" name="ip_addr" id="ip_addr" class="form-control form-control-sm">
        		                </div>
                         	</div>
                        </div>
                				<div class="row">
                					<div class="col">
                						<div class="form-group">
		                         	<label for="device_id">Device ID</label>
		                         	<input type="text" name="device_id" id="device_id" class="form-control form-control-sm">
		                        </div>
                					</div>
                					<div class="col">
                						<div class="form-group">
                              <label for="subnet_id">Subnet ID</label>
                              <input type="text" name="subnet_id" id="subnet_id" class="form-control form-control-sm">
                            </div>
                          </div>
                				</div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label for="channel">Channel ID</label>
                              <input type="text" name="channel" id="channel" class="form-control form-control-sm">
                            </div>
                          </div>
                          <div class="col">
                            
                          </div>
                        </div>
                			</div>                  
                    </div>
                  </div>
                </div>
              </div>      
              <div class="modal-footer">
              	<button type="submit" class="btn btn-success">Add</button>
                {!! Form::close() !!}
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
              </div>
            </div>
          </div>
        </div>

        

        <!-- Edit Device Modal -->
        <div class="modal fade" id="edit_device" tabindex="-1" role="dialog" aria-labelledby="edit_device" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Device</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="title">
                                
                            </div>
                        </div>
                    </div>
                    
                </div>
              </div>
              <div class="modal-footer">
                <a href="#" class="btn btn-success">Save</a>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
              </div>
            </div>
          </div>
        </div>



	<script src="{{URL::asset('/js/jquery.min.js')}}"></script>
    <script src="{{URL::asset('/js/popper.min.js')}}"></script>
    <script src="{{URL::asset('/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript">
      $('#snr').on('click', function() {

        $('#counter').removeAttr('hidden');

        $.ajax({
          url: "{{ url('/reboot') }}",
          type: "GET",
          data: null,
          success: function(response) {
            console.log(response);
          },
          error: function(xhr) {
            
          }
        });
        var i=45;

         
          setInterval(function(){
            if(i>=0){
              $('#sec').text(i);
              /*console.log(i);  */
            }
            else{
              window.location.reload();
            }
            i--;

          }, 1000);

        

      });
    </script>
</body>
</html>