<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>demo</title>
</head>
<body>
	<ul>
		<{foreach from=$list item="myitem"}>
		<li><{$myitem@key}><{$myitem['name']}></li>
		<{/foreach}>
	</ul>
</body>
</html>