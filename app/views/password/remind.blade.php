@extends('layouts.master')

@section('content')

    <!-- content begin -->
	<div id="content">
        <div class="container">
            <div class="row">
	        	
	        	 <div class="span3">&nbsp;</div>
	             <div class="span6 login-frontpage">
	                <h3>Mise à jour de votre mot de passe</h3>
	                <p>Entrez votre votre email et vous recevrez un lien pour modifier votre mot de passe.</p>

						@if( Session::has('status'))

				            <div class="alert alert-success">			
				                    {{ Session::get('status') }}			
				                <button class="close" data-dismiss="alert" type="button">×</button>
				            </div>
				            
						@endif
						
						@if( Session::has('warning'))

				            <div class="alert alert-warning">			
				                    {{ Session::get('warning') }}			
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
					  					  
							{{ Form::open(array('method' => 'post', 'action' => 'RemindersController@postRemind', 'class' => 'form-reminder')) }}
							<div class="row">
								<div class="span4">
									{{ Form::label('email', 'Email', array( 'class' => '' ) ) }}							
									{{ Form::email('email', '' , array('class' => '')) }}
								</div>
								<div class="span1">
									<label>&nbsp;</label>
									{{ Form::submit('Envoyer', array('class' => 'btn')) }}
								</div>
							</div>
							<p class="clear"></p>
							{{ Form::close() }}
							
					  </div>
	            </div>
	            <div class="span3">&nbsp;</div>        
	
	        </div>
	    </div>
    </div>
    
@stop