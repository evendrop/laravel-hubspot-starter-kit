<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel HubSpot Starter Kit</title>
	@php
		$manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);
		echo '<pre>';
			print_r($manifest);
	@endphp
	@vite('resources/css/app.css')
	@routes
</head>
<body class="sidebar-expanded">
	<div id="app" class="flex h-screen overflow-hidden"></div>

	@if(env('APP_ENV') === 'production')
		@if(isset($manifest['style.css']))
			<link rel="stylesheet" href="/assets/{{ $manifest['style.css'] }}">
		@endif
		@if(isset($manifest['index.js']))
		<script type="module" src="/assets/{{ $manifest['index.js'] }}"></script>
		@endif
	@else
		<script type="module" src="http://localhost:3000/vite/client"></script>
		<script type="module" src="http://localhost:3000/resources/js/app.js"></script>
	@endif
</body> 
</html>