<!-- gallery item -->
<div class="item">


	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<li class="active"><a href="#info_<?php echo $projet['id']; ?>" role="tab" data-toggle="tab">Projet</a></li>
		<li><a href="#commentaire_<?php echo $projet['id']; ?>" role="tab" data-toggle="tab">Commentaire</a></li>
		<li><a href="#mentions_<?php echo $projet['id']; ?>" role="tab" data-toggle="tab">Mentions et évaluation</a></li>
		@if(!empty($projet['tags']))
			 <li><a href="#tags_<?php echo $projet['id']; ?>" role="tab" data-toggle="tab">Tags</a></li>
		@endif
	</ul>
	
	<!-- Tab panes -->
	<div class="tab-content">
	  <div class="tab-pane active" id="info_<?php echo $projet['id']; ?>">
		  
		<p class="theme"><i class="icon-tag"></i>{{ $projet['theme']['titre'] }}</p>
		<p class="subtheme"><i class="icon-tag"></i>{{ $projet['subtheme']['titre'] }}</p>
		
		<div class="picframe" style="background:{{ $projet['theme']['couleur_secondaire'] }};">
			
		    <span class="itemColor" style="background:{{ $projet['theme']['couleur_primaire'] }};">
		        <a class="popup_modal" href="{{ url('compose/modal', array('id' => $projet['id'] ) ) }}"><img src="{{ asset('images/icon_projet.png') }}" alt="icone" /></a>
		    </span>
		    
		    <span class="itemInfos">
		        <h4>{{ link_to( 'compose/modal/'.$projet['id'], $projet['titre'], array('class' => 'popup_modal') ) }}</h4>
		        <p>{{ $projet['user']['prenom'] }} {{ $projet['user']['nom'] }}</p>
		    </span>
		    
		    <span class="projetRang edit_rang" data-column="rang" data-id="{{ $projet['id'] }}">{{ $projet['rang'] }}</span>
		
		</div>
		
	    <div class="optionsProjet">
	        
	        	        
	        @if($projet['status'] != 'archive')
	        	{{ Form::open(array('method' => 'POST','url' => array('compose/status')))}}
		            <input type="hidden" value="{{ $projet['id'] }}" name="id">
		            <input type="hidden" value="actif" name="status">
		            <button class="btn btn-mini option-approuve">Approuver</button>
		        {{ Form::close() }}
	        
		        {{ Form::open(array('method' => 'POST','url' => array('compose/status')))}}
		            <input type="hidden" value="{{ $projet['id'] }}" name="id">
		            <input type="hidden" value="archive" name="status">
		            <button class="btn btn-mini option-archive">Archiver</button>
		        {{ Form::close() }}
	        @endif
	
	        @if($projet['status'] == 'submitted')
	            {{ Form::open(array('method' => 'POST','url' => array('compose/status')))}}
	                <input type="hidden" value="{{ $projet['id'] }}" name="id">
	                <input type="hidden" value="revision" name="status">
	                <button class="btn btn-mini option-assign">A reviser</button>
	            {{ Form::close() }}
	        @endif

	
	        <a href="{{ url('compose/'.$projet['id'].'/delete') }}"data-action="Projet"class="deleteAction btn btn-mini option-delete btn-last">Supprimer</a>
	
	    </div>
		
	  </div>
	  <div class="tab-pane" id="commentaire_<?php echo $projet['id']; ?>">
		  
		<p class="text-left">
			<a class="btn btn-primary btn-small" data-toggle="collapse" data-target="#comment_{{ $projet['id'] }}"><?php  echo (!empty($projet['commentaire']) ? '&Eacute;diter le commentaire' : 'Ajouter un commentaire'); ?></a>
		</p>
		
	    <div id="comment_{{ $projet['id'] }}" class="collapse">
	    	<div id="commentaire_projet">
	        	<span data-column="commentaire" data-id="{{ $projet['id'] }}" class="edit_content">
	        	<?php 
		        	if(!empty($projet['commentaire'])){echo $projet['commentaire'];}
		        	else{ echo 'Bonjour,<br/>Merci du schéma.<br/>Avec mes meilleures salutations<br/>François Bohnet';}
	        	?>
	        	</span>
			</div>
	    </div>
	    <?php 
		    if(!empty($projet['commentaire'])){
			    echo '<div class="text-left">';
			    	echo '<p><strong>Commmentaire envoyé</strong></p>';
		    		echo nl2br($projet['commentaire']);
		    	echo '</div>';
		    }
		?>
	  </div>
	  <div class="tab-pane text-left" id="mentions_<?php echo $projet['id']; ?>">
		  
		  	<p><strong>Mention</strong></p>
		  	
		  	<?php 	$mentions = ( isset($projet['mentions']) ? explode(',', $projet['mentions']) : array());  ?>
		  	
		  	<form>
			  	<div class="checkbox">
				  <label>
				    <input type="checkbox" class="mentions mentions_<?php echo $projet['id']; ?>" 
				    	   data-projet="<?php echo $projet['id']; ?>" 
				    	   <?php if(in_array('originalité', $mentions)){echo 'checked';} ?> 
				    	   value="originalité">Originalité</label>
				</div>
				<div class="checkbox disabled">
				  <label>
				    <input type="checkbox" class="mentions mentions_<?php echo $projet['id']; ?>" 
				    	   data-projet="<?php echo $projet['id']; ?>" 
				    	   <?php if(in_array('reprise en classe', $mentions)){echo 'checked';} ?> 
				    	   value="reprise en classe">Reprise en classe</label>
				</div>
		  	</form>	
		  
		  	<p><strong>&Eacute;valuation</strong></p>
		    <div class="rateit" id="rateit" data-projet="<?php echo $projet['id']; ?>" data-rateit-value="<?php echo $projet['rating']; ?>" data-rateit-min="0" data-rateit-max="3"></div>

        
	  </div>
	  
	  @if(!empty($projet['tags']))
	  <div class="tab-pane text-left" id="tags_<?php echo $projet['id']; ?>">
		  
        	<?php $taggin = $projet['tags']; ?>
			<ul class="myTags" data-id="{{ $projet['id'] }}">
			    @foreach($taggin as $tag)
			    	<li>{{ $tag['title'] }}</li>
			    @endforeach
			</ul>
			
	  </div>
	  @endif
	  
	</div>

    

                                
</div>