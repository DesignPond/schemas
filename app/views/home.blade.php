@extends('layouts.master')

@section('content')

    <!-- Subheader -->
    @include('partials.subheader')


	<?php  $Carbon = new Carbon\Carbon();?>  
						
	<div class="container marge-top">
        <div class="row marge-top">
            <div class="span8 hometext">
                <h3>Le site Droit en schémas</h3>
                <img style="float: left; margin:0 20px 20px 0;" src="<?php echo asset('images/procedure_civile_schemas_soft.png'); ?>" alt="procédure civile en schémas">
                <p>&nbsp;</p>
				<p>Complément indispensable de l'ouvrage <strong>"La procédure civile en schémas"</strong>, ce site reprend l’ensemble des schémas du livre ainsi que d'autre schémas additionels.</p>
                <p>Les graphiques couvrent les matières traitées par le Code, en décrivant les processus formels et en tentant de conceptualiser les notions essentielles.</p>
				<p>Un soin particulier a été mis dans la réalisation des schémas, déclinés en douze couleurs et dégradés afin d’en faciliter la lecture et la compréhension.</p>
            </div>
            <div class="span4 login-frontpage">
            
            	  @if (Auth::check())
    	  
            	  	<h3>Vos infos</h3>
				  	<div class="widget tab-holder">
                            <div class="de_tab">
                                <ul class="de_nav">
                                    <li><span class="active">Vos schémas</span></li>
                                    <li><span>Profil</span></li>
                                </ul>

                                <div class="de_tab_content">
                                    <div class="tab-small-post tab-hompage">
                                        <ul>
                                        
                                        @if ( !empty($user_projets) )
											@foreach($user_projets as $user_projet) 
											
											<?php  $projetdate = $Carbon->createFromFormat('Y-m-d H:i:s', $user_projet['created_at'] ); ?>

                                            <li>
                                                <span class="post-content">
                                                    {{ link_to('compose/'.$user_projet['id'], $user_projet['titre'] ) }}
                                                </span>
                                                <span class="post-date">{{ $projetdate->format('d/m/Y'); }}</span>
                                            </li>
                                            
											@endforeach
										@endif 
										
                                        </ul>
                                        <p>{{ link_to('user/'. Auth::user()->id , 'Tous vos projets', array( 'class' => 'btn btn-mini btn-primary') ) }}</p>
                                    </div>

                                    <div class="tab-small-post">
                                        <address>
			                                {{ Auth::user()->prenom }} {{ Auth::user()->nom }}
			                                <span><strong>Email:</strong><a href="mailto:{{ Auth::user()->email }}">{{ Auth::user()->email }}</a></span>
			                            </address>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

	              @else
	              
	             	 <h3>Login</h3>
	                
	                  <ul class="errors">
						 @foreach($errors->all() as $message)
						 <li>{{ $message }}</li>
						 @endforeach
					  </ul>
					 
					  <div class="contact_form_holder">	
					  					  
							{{ Form::open(array( 'url' => 'login', 'class' => 'form-login')) }}
	
							{{ Form::label('email', 'Email', array( 'class' => '' ) ) }}							
							{{ Form::text('email', '' , array('class' => '')) }}
	
							{{ Form::label('password', 'Mot de passe', array( 'class' => '' )) }}
							{{ Form::password('password', '' , array('class' => '')) }}
							
							{{ Form::submit('Envoyer', array('class' => 'btn')) }}							
							
							<p class="clear"></p>
							
							<a href="{{ action('RemindersController@getRemind')  }}"><i class="icon-question"></i>Mot de passe perdu?</a>
														
							{{ Form::close() }}
							
														
							<div class="clearfix"></div>
							<p class="text-right muted"><a href="mailto:info@droitenschema.ch">Problème avec le site?</a></p>
							
					  </div>

					  

				  @endif
				  
            </div>

        </div>
    </div>
     
	
@stop