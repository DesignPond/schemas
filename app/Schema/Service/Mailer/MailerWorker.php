<?php namespace Schema\Service\Mailer;

use Schema\Compose\Repo\ProjetInterface;


class MailerWorker implements MailerInterface {

	
	protected $projet;
	
	
	// Class expects an Eloquent model
	public function __construct(ProjetInterface $projet)
	{
		
		$this->projet = $projet;	
		
	}
	
	/*
	 * send email with comment and project to owner
	 * @return array
	*/	
	public function sendemail( $id_projet , $status){
	
		try{
		
			$projet  = $this->projet->find($id_projet);
			
			$email   = $projet['user']['email'];
			$user_id = $projet['user']['id'];
			$nom     = $projet['user']['prenom'].' '.$projet['user']['nom'];
			$titre   = $projet['titre'];
			$comment = $projet['commentaire'];
			
			$fromEmail = 'info@droitenschema.ch';
	        $fromName  = 'Droit en schémas';
			
			\Mail::send('emails.revision', array('titre' => $titre,'nom' => $nom, 'comment' => $comment, 'user_id' => $user_id), function($message) use ( $email, $nom, $fromEmail, $fromName )
			{
			    $message->to($email, $nom)->from($fromEmail, $fromName)->subject('Votre schéma sur droitenschema.ch a été envoyé en révision');
			});
	
			
		}
        catch (Schema\Exceptions\MailException $e)
        {
            return Redirect::back()->withErrors($e->getErrors());
        }
		
	}	
    
}