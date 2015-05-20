<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		
		<h2>Droit en Schémas</h2>
		<h3>Demande de mise à jour du mot de passe sur www.droitenschema.ch</h3>
		
		<p>Bonjour, <br/>
			Cet email vous a été envoyé suite à votre demande de réinitialisation de mot de passe. Veuillez cliquer sur le lien ci-dessous.
		</p>

		<p>
			<a style="text-align:center;font-size:11px;font-family:arial,sans-serif;
			color:white;font-weight:bold;border-color:#3079ed;background-color:#06274a;
			text-decoration:none;display:inline-block;
			min-height:27px;padding-left:8px;padding-right:8px;
			line-height:27px;border-radius:2px;border-width:1px" 
			href="{{ URL::to('password/reset', array($token)) }}">Réinitialiser le mot de passe </a> .
		</p>
		<p>Pour des raisons de sécurité, ce lien n'est valide que pendant une heure. 
		<br/>Si vous ne cliquez pas sur ce lien avant ce délai, vous devrez recommencer la procédure de réinitialisation de mot de passe.</p>
		<p><a style="font-size:11px;color:#9a9a9a;" href="{{ url('/') }}">Droit en sch&eacute;mas</a></p>
	</body>
</html>