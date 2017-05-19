<{config_load file="bar.conf"}>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>变量</title>
</head>
<body>
	显示简单的变量 (非数组/对象) : <{$foo1}> <br />
	在0开始索引的数组中显示第五个元素 : <{$foo2[4]}> <br />
	显示"bar"下标指向的数组值，等同于PHP的$foo['bar'] : <{$foo3.bar}> <br />
	显示以变量$bar值作为下标指向的数组值，等同于PHP的$foo[$bar] : <{$foo4.$bar1}> <br />
	显示对象属性 "name" : <{$foo5->name}> <br />
	显示对象成员方法"getName"的返回 : <{$foo5->getName()}> <br />
	显示变量配置文件内的变量"foo : <{#foo6#}> <br />
	等同于{#foo6#} : <{$smarty.config.foo6}> <br />

	<{section name=item loop=$foo2 start=0 step=1}>
	index=<{$smarty.section.item.index}>,  
	index_prev=<{$smarty.section.item.index_prev}>,  
	index_next=<{$smarty.section.item.index_next}>,  
	first=<{$smarty.section.item.first}>,  
	last=<{$smarty.section.item.last}>,  
	iteration =<{$smarty.section.item.iteration}>,  
	total=<{$smarty.section.item.total}>,  
	value=<{$foo2[item]}><br /> 
	<{sectionelse}>
	nothing
	<{/section}>
	时间 : <{time()}> <br />
</body>
</html>