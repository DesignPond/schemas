<?php

class SessionController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function auth()
	{
        return View::make('session.login');
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function login()
	{
        $user = array(
            'email'    => Input::get('email'),
            'password' => Input::get('password')
        );
        
        if (Auth::attempt($user)) {
        	
        	if(Auth::user()->activated)
        	{
	        	 return Redirect::intended('/')->with('success', 'Vous êtes connecté');
        	}
        	
        	Auth::logout();
        	
        	return Redirect::to('password/remind')->with('warning', 'Première connexion: Veuillez mettre à jour votre mot de passe.');
           
        }
        
        // authentication failure! lets go back to the login page
        return Redirect::to('login')
            ->with('flash_error', 'Les identifiants email / mot de passe sont incorrects')
            ->withInput();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function logout()
	{
        Auth::logout();
        return Redirect::intended('/');
        
	}

}
