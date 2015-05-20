<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h4>Bonjour {{ $nom }},</h4>

		<div>
           Votre schéma <strong><a href="{{ url('user/'.$user_id) }}">{{ $titre }}</a></strong> sur www.droitenschema.ch vous a été renvoyé pour révision.
           
           @if(!empty($comment))
           		
           		<p><strong>Commentaire sur le schéma</strong></p>
           		<p>{{ nl2br($comment) }}</p>
           	
           @endif
		</div>
	</body>
</html>