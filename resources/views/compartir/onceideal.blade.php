<html>

<head>
    <meta charset="utf-8">
	<title>¡Tu once ideal!</title>
	<meta property="og:url"                content="{{ Request::fullUrl() }}" />
	<meta property="og:type"               content="article" />
	<meta property="og:title"              content="¡Tu once ideal! " />
	<meta property="og:description"        content="Descarga la App Selección Colombia Oficial y viajemos juntos al Mundial Rusia 2018" />
	<meta property="og:image"              content="{{ config('app.url') . 'onceideal/' . $once['foto'] }}" />


</head>
<body>
{{ config('app.url') . 'onceideal/' . $once['foto'] }}
<img src="{{ config('app.url') . 'onceideal/' . $once['foto'] }}">

</body>
</html>