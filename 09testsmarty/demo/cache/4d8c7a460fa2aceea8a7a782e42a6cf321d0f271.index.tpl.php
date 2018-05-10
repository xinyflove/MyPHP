<?php
/* Smarty version 3.1.29, created on 2016-10-24 16:29:23
  from "D:\phpStudy\WWW\demo\smarty\demo\templates\index.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_580dc6638103e6_80483427',
  'file_dependency' => 
  array (
    '4d8c7a460fa2aceea8a7a782e42a6cf321d0f271' => 
    array (
      0 => 'D:\\phpStudy\\WWW\\demo\\smarty\\demo\\templates\\index.tpl',
      1 => 1450605426,
      2 => 'file',
    ),
  ),
  'cache_lifetime' => 120,
),true)) {
function content_580dc6638103e6_80483427 ($_smarty_tpl) {
?>
{config_load file="test.conf" section="setup"}
{include file="header.tpl" title=foo}

<PRE>

{* bold and title are read from the config file *}
    {if #bold#}<b>{/if}
        {* capitalize the first letters of each word of the title *}
        Title: {#title#|capitalize}
        {if #bold#}</b>{/if}

    The current date and time is {$smarty.now|date_format:"%Y-%m-%d %H:%M:%S"}

    The value of global assigned variable $SCRIPT_NAME is {$SCRIPT_NAME}

    Example of accessing server environment variable SERVER_NAME: {$smarty.server.SERVER_NAME}

    The value of {ldelim}$Name{rdelim} is <b>{$Name}</b>

variable modifier example of {ldelim}$Name|upper{rdelim}

<b>{$Name|upper}</b>


An example of a section loop:

    {section name=outer
    loop=$FirstName}
        {if $smarty.section.outer.index is odd by 2}
            {$smarty.section.outer.rownum} . {$FirstName[outer]} {$LastName[outer]}
        {else}
            {$smarty.section.outer.rownum} * {$FirstName[outer]} {$LastName[outer]}
        {/if}
        {sectionelse}
        none
    {/section}

    An example of section looped key values:

    {section name=sec1 loop=$contacts}
        phone: {$contacts[sec1].phone}
        <br>

            fax: {$contacts[sec1].fax}
        <br>

            cell: {$contacts[sec1].cell}
        <br>
    {/section}
    <p>

        testing strip tags
        {strip}
<table border=0>
    <tr>
        <td>
            <A HREF="{$SCRIPT_NAME}">
                <font color="red">This is a test </font>
            </A>
        </td>
    </tr>
</table>
    {/strip}

</PRE>

This is an example of the html_select_date function:

<form>
    {html_select_date start_year=1998 end_year=2010}
</form>

This is an example of the html_select_time function:

<form>
    {html_select_time use_24_hours=false}
</form>

This is an example of the html_options function:

<form>
    <select name=states>
        {html_options values=$option_values selected=$option_selected output=$option_output}
    </select>
</form>

{include file="footer.tpl"}
<?php }
}
