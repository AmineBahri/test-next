<!DOCTYPE html>
<html>
<head>
	<title>Inscription nouveau utilisateur</title>
</head>
<body>
 <h3>Bienvenue {{$data['name']}}</h3>
 <h4>Vous pouvez maintenant connecter</h4>
 <h4>cliquer sur ce lien <a href="{{route('home')}}">Laravel</a></h4>
</body>
</html>