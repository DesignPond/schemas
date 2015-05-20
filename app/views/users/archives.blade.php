@extends('layouts.master')

@section('content')

<!-- Subheader -->
@include('partials.subheader')

<?php 

	$custom = new \Custom; 
	$tree   = $custom->buildTree($tags->toArray());

?>

<div id="content">
    <div class="container">
        <div class="row">
            <div class="span12">
                <h3>Archives</h3>
            </div>
        </div>

        <div class="row">
            <div class="span12">

            	            	{{ Form::open(array( 'url' => 'archives', 'id' => 'filter')) }}
            	
	            <div class="form-group pull-right">
		            <div style="width: 130px;" class="span2 text-left">	
						<select name="mention" class="form-control">
							<option value="">Mention</option>
							<option <?php if( isset($filters['mention']) && $filters['mention'] == 'originalité' ){ echo 'selected'; } ?> value="originalité">Originalité</option>
							<option <?php if( isset($filters['mention']) && $filters['mention'] == 'reprise en classe' ){ echo 'selected'; } ?> value="reprise en classe">Reprise en classe</option>
						</select>		
					</div>
					<div style="width: 100px;" class="span2 text-left">	
						<select name="rating" class="form-control">
							<option value="">&Eacute;valuation</option>
							<option <?php if( isset($filters['rating']) && $filters['rating'] == '1' ){ echo 'selected'; } ?> value="1">1 étoile</option>
							<option <?php if( isset($filters['rating']) && $filters['rating'] == '2' ){ echo 'selected'; } ?> value="2">2 étoile</option>
							<option <?php if( isset($filters['rating']) && $filters['rating'] == '3' ){ echo 'selected'; } ?> value="3">3 étoile</option>
						</select>		
					</div>
		            <div style="width: 100px;" class="span2 text-left">	
						<select id="filterYear" name="date" class="form-control">
							<option value="">Année</option>
							<?php
								if(!empty($years)){
									foreach($years as $year){
										echo '<option '; 
										if( isset($filters['date']) && $filters['date'] == $year ){ echo ' selected '; }
										echo ' value="'.$year.'">'.$year.'</option>';
									}
								}	
							?>
						</select>		
					</div>
					<div style="width: 100px;" class="span2 text-left">	
						<select name="name" class="form-control">
							<option value="">Nom par</option>
							<?php
								foreach(range('A', 'Z') as $char) {
									echo '<option '; 
									if( isset($filters['name']) && $filters['name'] == $char ){ echo ' selected '; }
									echo ' value="'.$char.'">'.$char.'</option>';
								}
							?>
						</select>		
					</div>
					<div style="width: 100px;" class="span2 text-left">	
						<select name="tag" class="form-control">
							<option value="">Tag</option>
							<?php $custom->printTree($tree); ?>
						</select>		
					</div>
					<div class="span1 text-right">
						<button class="btn btn-primary" type="submit">Trier</button>
					</div>
				</div>
				
				{{ Form::close() }}
								
			</div>
        </div>
        <div class="row">
            <div id="accordion" class="span12 gallery user-gallery">

                @if(!empty($projets))

                    @foreach($projets as $projet)          
                                               
                        <!-- gallery item -->
                      
                            @include('partials.card')
                   
                        <!-- close gallery item -->
                            
                    @endforeach
                    <hr/>
                    
                    <?php echo $projets->links(); ?>
                    
                @else
                	<div class="alert alert-warning">Aucun projet ne possède ce tag: <strong>{{ $tagname }}</strong></div>
                @endif
                
                

            </div>
        </div>


    </div>
</div>

@stop