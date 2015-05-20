@extends('layouts.master')

@section('content')

    <!-- content begin -->
	<div id="content">
        <div class="container">
            <div class="row">
	        	
	        	 <div class="span4">&nbsp;</div>
	             <div class="span4 login-frontpage">
	                <h3>Mettre à jour le mot de passe</h3>
	                

						@if( Session::has('status'))

				            <div class="alert alert-success">			
				                    {{ Session::get('status') }}			
				                <button class="close" data-dismiss="alert" type="button">×</button>
				            </div>
				            
						@endif
						
						@if( Session::has('error'))

				            <div class="alert alert-danger">
				                    {{ Session::get('error') }}
				                <button class="close" data-dismiss="alert" type="button">×</button>
				            </div>
				            
						@endif
					 
					  <div class="contact_form_holder">	
					  					  
							{{ Form::open(array('method' => 'post', 'action' => 'RemindersController@postReset', 'class' => 'form-reminder')) }}
							
								<input type="hidden" name="token" value="{{ $token }}">


								{{ Form::label('email', 'Email' ) }}							
								{{ Form::email('email', '' ) }}
								
								{{ Form::label('password', 'Nouveau mot de passe' ) }}							
								{{ Form::password('password', '' , array('class' => '')) }}
								
								{{ Form::label('password_confirmation', 'Confirmation du mot de passe' ) }}							
								{{ Form::password('password_confirmation', '' ) }}
								
								<p></p>
								{{ Form::submit('Mettre à jour', array('class' => 'btn')) }}
							
							<p class="clear"></p>
							{{ Form::close() }}
						
							
					  </div>
	            </div>
	            <div class="span4">&nbsp;</div>        
	
	        </div>
	    </div>
    </div>
    
@stop