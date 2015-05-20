@extends('layouts.master')

@section('content')

<!-- Subheader -->
@include('partials.subheader')

<?php  $custom = new Custom; ?>
	
<div id="content">
    <div class="container">
        <div class="row"> 
	
				<!-- content begin -->
		        <div id="content">
		            <div class="container">

		                <div class="row">
		                    <div id="gallery" class="gallery">

		                    @if ( !empty($projets) )

                                <?php
                                    echo '<pre>';
                                    print_r($projets);
                                    echo '</pre>';
                                ?>

							@endif 
							
		                    </div>
		                </div>
		            </div>
		        </div>
		        <!-- content close -->
			 	
		</div>
	</div>
</div>
					
@stop