<?php
/* Smarty version 3.1.29, created on 2016-06-20 14:00:36
  from "D:\WWW\demo\smarty\demo\templates\foreach.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_57678684afca22_79681593',
  'file_dependency' => 
  array (
    '76aca97361508921c2a39e8bfc9bc40003a24795' => 
    array (
      0 => 'D:\\WWW\\demo\\smarty\\demo\\templates\\foreach.tpl',
      1 => 1466402433,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_57678684afca22_79681593 ($_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '3126157678684ab9641_56475345';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>demo</title>
</head>
<body>
	<ul>
		<?php
$_from = $_smarty_tpl->tpl_vars['list']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_myitem_0_saved_item = isset($_smarty_tpl->tpl_vars['myitem']) ? $_smarty_tpl->tpl_vars['myitem'] : false;
$_smarty_tpl->tpl_vars['myitem'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['myitem']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['myitem']->key => $_smarty_tpl->tpl_vars['myitem']->value) {
$_smarty_tpl->tpl_vars['myitem']->_loop = true;
$__foreach_myitem_0_saved_local_item = $_smarty_tpl->tpl_vars['myitem'];
?>
		<li><?php echo $_smarty_tpl->tpl_vars['myitem']->key;
echo $_smarty_tpl->tpl_vars['myitem']->value['name'];?>
</li>
		<?php
$_smarty_tpl->tpl_vars['myitem'] = $__foreach_myitem_0_saved_local_item;
}
if ($__foreach_myitem_0_saved_item) {
$_smarty_tpl->tpl_vars['myitem'] = $__foreach_myitem_0_saved_item;
}
?>
	</ul>
</body>
</html><?php }
}
