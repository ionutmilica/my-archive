<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{$site_lang}" lang="{$site_lang}">

<head>    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{$page_title}</title>    
    <meta name="description" content="{$site_description}" />    
    <meta name="keywords" content="{$keywords}" />        
    <link rel="shortcut icon" href="{$relative_tpl}img/favicon/favicon.ico" type="image/x-icon" />
    <link href="{$relative_tpl}css/reset.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="{$relative_tpl}css/all.css" rel="stylesheet" type="text/css" media="all"/>
    <!--
    <link href="{$relative_tpl}css/plugins.css" rel="stylesheet" type="text/css" media="screen" />
    -->
    <link href="http://gf1.geo.gfsrv.net/cdn00/8ea731419f2e28ec7230029e11c836.css" rel="stylesheet" type="text/css" media="screen" />
        
    <!--[if lt IE 7]><link rel="stylesheet" type="text/css" href="{$relative_tpl}css/IE/ie6.css" media="screen"/><![endif]-->
    <!--[if gte IE 6]><link rel="stylesheet" type="text/css" href="{$relative_tpl}css/IE/ie7.css" media="screen"/><![endif]-->
    <script type="text/javascript" src="{$relative_tpl}js/jquery.js"></script>
    <script type="text/javascript" src="{$relative_tpl}js/jquery.validationEngine.modified.js"></script>
    <script type="text/javascript" src="{$relative_tpl}js/jquery.validationEngine.rules.js"></script>
    <script type="text/javascript" src="{$relative_tpl}js/iepngfix_tilebg.js"></script>
    <script type="text/javascript" src="{$relative_tpl}js/jquery.tools.min.js"></script>
    <script type="text/javascript" src="{$relative_tpl}js/jquery.fancybox-1.3.1.pack.js"></script>
    
    <script type="text/javascript" src="{$relative_tpl}js/jquery_ext.js"></script>
    <script type="text/javascript" src="{$relative_tpl}js/coda.js"></script>            
    <script type="text/javascript" src="{$relative_tpl}js/jquery.bgiframe.js"></script>
    <script type="text/javascript" src="{$relative_tpl}js/jquery.jeditable.mini.js"></script>
            
    <script type="text/javascript" src="{$relative_tpl}js/screen.js"></script>
                
    <script type="text/javascript" src="{$relative_tpl}js/main.js"></script>
    <script type="text/javascript" src="{$relative_tpl}js/init.php"></script>         
</head>
<body>
<div id="page">  
    {if $logged_in == true}
        {include file="logged_in_header.tpl"}
    {else}
        {include file="logged_out_header.tpl"}
    {/if}
	<!-- left column - navigation -->
	<div class="container-wrapper">
		<div class="container">        
            <!-- Prima coloana -->		
                
            {if $logged_in == true}
                {include file="logged_in_col_1.tpl"}
            {else}
                {include file="logged_out_col_1.tpl"}
            {/if}  	        
            
            <!-- coloana din mijloc -->		
                
            {include file="$content_tpl.tpl"}
                
                <!-- coloana din dreapta -->
                
            {if $logged_in == true}
                {include file="logged_in_col_2.tpl"}
            {else}
                {include file="logged_out_col_2.tpl"}
            {/if}                                    
		</div>
	</div>
</div>

<!-- footer -->

<!-- 
    @package: Metin2 HP FrameWork
    @author: Ionut M.    
    @last_updated: 09/06/2012
    @version: 1.0 Beta
    
-->



<!-- footer -->
<div class="footer-wrapper">
    <div id="footer"> 
        <a class="gameforge4d" href="http://{$relative}" target="_blank" rel="nofollow">Mt-2.Ro</a>
        <ul>
            <li class="first">
                © 2012 {$site_name}. <br /> 
                Nu avem nici un fel de pariteneriat/afiliat cu firma Gameforge 4D GmbH.            
            </li>
            
        </ul>
    </div>
</div>
<div id="lbBottomContainer" style="display: none;">
    <div id="lbBottom"></div>
    <a id="lbCloseLink" href="#"></a>
    <div id="lbCaption">
        <div id="lbNumber">
            <div style="clear: both;"></div>
        </div>
    </div>
</div>
<div class="simple_overlay" id="gallery"> <a class="back">back</a> <a class="forward">forward</a> <img class="progress" src="http://gf1.geo.gfsrv.net/cdn34/c5bff171fb231aceb560e1af283d7d.gif" alt="..." /> </div>
<div class="overlay" id="overlay">
    <div class="contentWrap"></div>
</div>

</body>
</html>        