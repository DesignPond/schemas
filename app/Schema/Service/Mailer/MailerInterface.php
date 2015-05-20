<?php namespace Schema\Service\Mailer;

interface MailerInterface{

	/*
	 * send email with comment and project to owner
	 * @return array
	*/	
	public function sendemail( $id_projet , $status);	
	

    
}