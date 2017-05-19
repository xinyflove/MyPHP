<?php
/* Smarty version 3.1.29, created on 2016-06-08 15:49:23
  from "D:\WWW\demo\smarty\demo\templates\var.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5757ce03d74f65_15097721',
  'file_dependency' => 
  array (
    '322c634be9c643930630897a5fa1f74d6daeb11e' => 
    array (
      0 => 'D:\\WWW\\demo\\smarty\\demo\\templates\\var.tpl',
      1 => 1465372158,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5757ce03d74f65_15097721 ($_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '140915757ce03cc1c07_71343920';
$_smarty_tpl->smarty->ext->configLoad->_loadConfigFile($_smarty_tpl, "bar.conf", null, 0);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>变量</title>
</head>
<body>
	显示简单的变量 (非数组/对象) : <?php echo $_smarty_tpl->tpl_vars['foo1']->value;?>
 <br />
	在0开始索引的数组中显示第五个元素 : <?php echo $_smarty_tpl->tpl_vars['foo2']->value[4];?>
 <br />
	显示"bar"下标指向的数组值，等同于PHP的$foo['bar'] : <?php echo $_smarty_tpl->tpl_vars['foo3']->value['bar'];?>
 <br />
	显示以变量$bar值作为下标指向的数组值，等同于PHP的$foo[$bar] : <?php echo $_smarty_tpl->tpl_vars['foo4']->value[$_smarty_tpl->tpl_vars['bar1']->value];?>
 <br />
	显示对象属性 "name" : <?php echo $_smarty_tpl->tpl_vars['foo5']->value->name;?>
 <br />
	显示对象成员方法"getName"的返回 : <?php echo $_smarty_tpl->tpl_vars['foo5']->value->getName();?>
 <br />
	显示变量配置文件内的变量"foo : <?php echo $_smarty_tpl->smarty->ext->configLoad->_getConfigVariable($_smarty_tpl, 'foo6');?>
 <br />
	等同于{#foo6#} : <?php echo $_smarty_tpl->smarty->ext->configload->_getConfigVariable($_smarty_tpl, 'foo6');?>
 <br />

	<?php
$__section_item_0_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_item']) ? $_smarty_tpl->tpl_vars['__smarty_section_item'] : false;
$__section_item_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['foo2']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_item_0_start = min(0, $__section_item_0_loop);
$_smarty_tpl->tpl_vars['__smarty_section_item'] = new Smarty_Variable(array('total' => min(($__section_item_0_loop - $__section_item_0_start), $__section_item_0_loop)));
if ($_smarty_tpl->tpl_vars['__smarty_section_item']->value['total'] != 0) {
for ($_smarty_tpl->tpl_vars['__smarty_section_item']->value['iteration'] = 1, $_smarty_tpl->tpl_vars['__smarty_section_item']->value['index'] = $__section_item_0_start; $_smarty_tpl->tpl_vars['__smarty_section_item']->value['iteration'] <= $_smarty_tpl->tpl_vars['__smarty_section_item']->value['total']; $_smarty_tpl->tpl_vars['__smarty_section_item']->value['iteration']++, $_smarty_tpl->tpl_vars['__smarty_section_item']->value['index']++){
$_smarty_tpl->tpl_vars['__smarty_section_item']->value['index_prev'] = $_smarty_tpl->tpl_vars['__smarty_section_item']->value['index'] - 1;
$_smarty_tpl->tpl_vars['__smarty_section_item']->value['index_next'] = $_smarty_tpl->tpl_vars['__smarty_section_item']->value['index'] + 1;
$_smarty_tpl->tpl_vars['__smarty_section_item']->value['first'] = ($_smarty_tpl->tpl_vars['__smarty_section_item']->value['iteration'] == 1);
$_smarty_tpl->tpl_vars['__smarty_section_item']->value['last'] = ($_smarty_tpl->tpl_vars['__smarty_section_item']->value['iteration'] == $_smarty_tpl->tpl_vars['__smarty_section_item']->value['total']);
?>
	index=<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_item']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_item']->value['index'] : null);?>
,  
	index_prev=<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_item']->value['index_prev']) ? $_smarty_tpl->tpl_vars['__smarty_section_item']->value['index_prev'] : null);?>
,  
	index_next=<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_item']->value['index_next']) ? $_smarty_tpl->tpl_vars['__smarty_section_item']->value['index_next'] : null);?>
,  
	first=<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_item']->value['first']) ? $_smarty_tpl->tpl_vars['__smarty_section_item']->value['first'] : null);?>
,  
	last=<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_item']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_section_item']->value['last'] : null);?>
,  
	iteration =<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_item']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_section_item']->value['iteration'] : null);?>
,  
	total=<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_item']->value['total']) ? $_smarty_tpl->tpl_vars['__smarty_section_item']->value['total'] : null);?>
,  
	value=<?php echo $_smarty_tpl->tpl_vars['foo2']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_item']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_item']->value['index'] : null)];?>
<br /> 
	<?php }} else {
 ?>
	nothing
	<?php
}
if ($__section_item_0_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_item'] = $__section_item_0_saved;
}
?>
	时间 : <?php echo time();?>
 <br />
</body>
</html><?php }
}
