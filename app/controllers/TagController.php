<?php

use  Schema\Tags\Repo\TagInterface;
use  Schema\Compose\Repo\ProjetInterface;

class TagController extends \BaseController {

		
	protected $tag;
	
	protected $projet;


    public function __construct( TagInterface $tag,  ProjetInterface $projet){
		
		$this->tag    = $tag;
		
		$this->projet = $projet;

	}
	

	/**
	 * Display a listing of the resource.
	 * GET /tag
	 *
	 * @return Response
	 */
	public function index()
	{
		$tags   = $this->tag->getAll();
		$projet = $this->projet->getAll('app');
		
		
	    return View::make('tag.index')->with( array( 'tags' => $tags, 'projet' => $projet ));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /tag/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /tag
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /tag/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function allTags()
	{
		$tags = $this->tag->getAll();
		
		return Response::json( $tags, 200 );
	}
	
	public function tags()
	{
		
		$term = Input::get('term');
		$tags = $this->tag->search($term,true);
		
		return Response::json( $tags, 200 );
	}
	
	public function addTag()
	{

		$id   = Input::get('id');
		$tag  = Input::get('tag');
		
		$find = $this->tag->search($tag);
		
				
		// If tag not found	
		if(!$find)
		{
			$find = $this->tag->create(array('title' => $tag));
		}
		
		$projet = $this->projet->find($id);

		$projet->tags()->attach($find->id);
		
		return Response::json( $projet, 200 );
	}
	
		
	public function removeTag()
	{

		$id   = Input::get('id');
		$tag  = Input::get('tag');
		
		$find   = $this->tag->search($tag);	
		$projet = $this->projet->find($id);

		$projet->tags()->detach($find->id);
		
		return Response::json( $projet, 200 );
	}
	

	/**
	 * Show the form for editing the specified resource.
	 * GET /tag/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /tag/{id}
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
	 * DELETE /tag/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}