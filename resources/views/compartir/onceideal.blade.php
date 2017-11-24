<html>

<head>
    <meta charset="utf-8">
	<title>TU ONCE IDEAL</title>
	<meta property="og:url"                content="{{ Request::fullUrl() }}" />
	<meta property="og:type"               content="article" />
	<meta property="og:title"              content="TU ONCE IDEAL" />
	<meta property="og:description"        content="¡Escoge tu once ideal y comparte con tus amigos! Descarga ya la App Oficial de Millonarios FC" />
	<meta property="og:image"              content="{{ config('app.url') . 'onceideal/' . $once['foto'] }}" />


</head>
<body>
{{ config('app.url') . 'onceideal/' . $once['foto'] }}
<img src="{{ config('app.url') . 'onceideal/' . $once['foto'] }}">

</body>
</html>