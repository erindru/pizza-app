<!doctype html>
<html ng-app="pizza-app">
	<head>
		<title>Extremely Simple Pizzas</title>
		<link rel="stylesheet" type="text/css" href="<?= URL::asset('css/compiled.css') ?>" />
	</head>
	<body>
		<div id="main" class="container">
			<h1 id="title"><a href="<?= URL::to("/"); ?>">Extremely Simple Pizzas</h1>
			<div ng-view></div>
			<a class="pull-right" href="#/admin">Admin</a>
		</div>
		<script type="text/javascript" src="<?= URL::asset('js/compiled.js') ?>"></script>
		<script type="text/javascript">
			angular.module("pizza-app").constant("BASE_URL", "<?= URL::to('/'); ?>");
		</script>
	</body>
</html>