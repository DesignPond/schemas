<?php

class Custom {
	
	public function makeSlug($string){
	
		 $str = htmlentities($string);
	     
	     $str = preg_replace('#&([A-za-z])(?:acute|cedil|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
	     $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
	     $str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractères
	     
	     $str = preg_replace('/\W+/', '_', $str);
	    
	     return $str;  
	}
	
	public function limit_words($string, $word_limit){
	
		$words = explode(" ",$string);
		$new = implode(" ",array_splice($words,0,$word_limit));
		if( !empty($new) ){
			$new = $new.'...';
		}
		return $new;
	}
	
	public function if_exist(&$argument, $default="") {
	
	   if(!isset($argument)) 
	   {
	       $argument = $default;
	       
	       return $argument;
	   }
	   
	   $argument = trim($argument);
	   
	   return $argument;
	}
	
	public function formatDate($date){
		
		$Carbon = new Carbon\Carbon();
		$dateFormatted   = $Carbon->createFromFormat('Y-m-d H:i:s', $date);
		return  $dateFormatted;
	}
	
	public function buildTree(Array $data, $parent = 0) 
	{
		$tree = array();
				    
	    foreach ($data as $d) 
	    {
	        if ($d['parents'] == $parent) 
	        {
	            $children = $this->buildTree($data, $d['id']);
	            
	            // set a trivial key
	            if (!empty($children)) 
	            {
	                $d['_children'] = $children;
	            }
	            
	            $tree[] = $d;
	        }
	    }
	    
	    return $tree;
	}
	
	public function printTree($tree, $r = 0, $p = null) 
	{
	    foreach ($tree as $i => $t) 
	    {
	        $dash = ($t['parents'] == 0) ? '' : str_repeat('-', $r) .' ';
	        
	        printf("\t<option value='%d'>%s%s</option>\n", $t['id'], $dash, $t['title']);
	        
	        if ($t['parents'] == $p) 
	        {
	            // reset $r
	            $r = 0;
	        }
	        
	        if (isset($t['_children'])) 
	        {
	            $this->printTree($t['_children'], ++$r, $t['parents']);
	        }
	    }
	}
	
	/**
	 *  year of projets sor dropdown
	*/
	public function selectYears($projets){
		
		$years = array();
		
		if( !empty($projets) )
		{
			foreach($projets as $projet)
			{
				$years[] = $projet->created_at->year; 
			}
		}
		
		$years = array_unique($years);
		
		return $years;
		
		
	}
	
	/**
	 *  Prepare filters to passe to repo for archives
	*/
	public function setFiltersArchive($input){
		
		$allowed = array('date','mention','rating','name');
		$filters = array();
		
		if(!empty($input)){
			
			foreach($input as $filter => $value){
				
				if( in_array($filter, $allowed))
				{				
					$filters[$filter] = (!empty($value) ? $value : null);
				}
			}
		}
		
		return $filters;
		
	}
	
}