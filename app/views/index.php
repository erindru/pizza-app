<!doctype html>
<html ng-app="pizza-app">
	<head>
		<title>Outrageously Good Pizza</title>
		<link rel="stylesheet" type="text/css" href="<?= URL::asset('css/compiled.css') ?>" />
	</head>
	<body ng-controller="MainController">
		<div id="container">
			{{ result }}
		</div>
		<script type="text/javascript" src="<?= URL::asset('js/compiled.js') ?>"></script>
	</body>
</html>