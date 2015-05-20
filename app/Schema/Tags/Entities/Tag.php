<?php namespace Schema\Tags\Entities;

use Schema\Common\BaseModel as BaseModel;

class Tag extends BaseModel {

	protected $guarded = array('id');
	public $timestamps = false;

    /**
     * Validation rules
     *
     * @var array
     */
    protected static $rules = array(
        'title' => 'required'
    );

    /**
     * Validation messages
     *
     * @var array
     */
    protected static $messages = array(
        'title.required' => 'Le champs titre est requis'
    );


	public function projet_tags()
    {
        return $this->belongsToMany('Schema\Compose\Entities\Projet', 'projet_tag', 'tag_id', 'projet_id');
    }
    
}
