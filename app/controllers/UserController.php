<?php

use  Schema\User\Repo\UserInterface;
use  Schema\Compose\Repo\ProjetInterface;
use  Schema\Tags\Repo\TagInterface;
use Faker\Factory as Faker;

class UserController extends BaseController {

	protected $user;
	
	protected $projet;
	
	protected $custom;
	
	public function __construct(UserInterface $user , ProjetInterface $projet , TagInterface $tag){
		
		$this->user = $user;
		
		$this->projet = $projet;
		
		$this->tag    = $tag;
		
		$this->custom = new \Custom();

        $this->beforeFilter('auth', array('only' => array('show', 'manage','actifs','revision','archives')));
        $this->beforeFilter('admin', array('only' => array('manage','actifs','revision','archives')));

	}
	

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

        if( Auth::user()->id != $id)
            return Redirect::to('/');

        $user       = $this->user->find($id);
	    $projets    = $this->projet->projectsByUser($id);

        list($themes,$sorting) = $this->projet->sortProjectByTheme($projets);
        
        $data = array(
        	'titre'      => 'Profil',
			'soustitre'  => 'Vos informations et schémas',
			'user'       => $user,
			'projets'    => $projets,
			'themes'     => $themes,
			'sorting'    => $sorting
		);
		
	    return View::make('users.home')->with( $data );
	}

    public function manage(){

        $projets = $this->projet->getByStatus(array('submitted'));
        $projets = $this->projet->arrangeByStatus($projets);
        $user    = $this->user->find(Auth::user()->id);

        $data = array(
            'titre'     => 'Schémas',
            'soustitre' => 'Gestion',
            'user'      => $user,
            'projets'   => $projets
        );

        return View::make('users.manage')->with( $data );
    }

    public function actifs(){

        $projets = $this->projet->getByStatus(array('actif'));
        $projets = $this->projet->arrangeByStatus($projets);
        $user    = $this->user->find(Auth::user()->id);

        $data = array(
            'titre'     => 'Schémas',
            'soustitre' => 'Gestion',
            'user'      => $user,
            'projets'   => $projets
        );

        return View::make('users.actifs')->with( $data );
    }

    public function revision(){

        $projets = $this->projet->getByStatus(array('revision'));
        $projets = $this->projet->arrangeByStatus($projets);
        $user    = $this->user->find(Auth::user()->id);

        $data = array(
            'titre'     => 'Schémas',
            'soustitre' => 'Gestion',
            'user'      => $user,
            'projets'   => $projets
        );

        return View::make('users.revision')->with( $data );
    }

    public function archives(){
    
	   // Gate all years from projets
	    $all   = $this->projet->getArchives();
	    $years = $this->custom->selectYears($all);
	    
	    $tag   = Input::get('tag');   
	    $tag   = ($tag ? $tag : null);  
	    
		// Set filtersc
    	$filters = $this->custom->setFiltersArchive(Input::all());

    	    	
    	if($tag)
    	{
    		$tagname = $this->tag->find($tag);
    		$tagname = $tagname->title;
    		
    		// Get all tag and projetcs ids  
	    	$projets_ids = $this->tag->getAllTagsForProjets($tag);

		    $projets = ( !empty($projets_ids) ? $this->projet->getByArchives($projets_ids, $filters) : array() );
	    		
    	}
    	else
    	{
	    	$tagname = '';
    		$projets = $this->projet->getByArchives(null,$filters);
    	}
    		
	    $tags = $this->tag->getAll();
	    

        $data = array(
            'titre'        => 'Schémas',
            'soustitre'    => 'Gestion',
            'projets'      => $projets,
            'tags'         => $tags,
            'tagname'      => $tagname,
            'years'        => $years,
            'filters'      => $filters
        );

        return View::make('users.archives')->with( $data );

    }
    

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('users.edit');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    function getIdInArray($array, $term)
    {
        foreach ($array as $key => $value) {
            if ($value == $term) {
                return $key;
            }
        }

        throw new UnexpectedValueException;
    }

}
