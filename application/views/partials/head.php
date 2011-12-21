<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html><head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>MiDiUm Book Shelf</title>
    
	<script src="/js/jquery-1.6.2.min.js" type="text/javascript"></script>
    <script src="/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
    <script src="/js/jquery.liveready-1.0-min.js" type="text/javascript"></script>
    
    <script type="text/javascript">
	function show_view(view_name) {
		 var p = {};
		 p['view'] = view_name;
		 $('#body-container').load('main/showView',p,function(str){
	
		 });
	}
	
    </script>
    
	<link rel="shortcut icon" type="image/x-icon" href="/assets/images/icons/books.png"/>    
    <? if (isset($login_page)) {
			if ($login_page) { ?> 
				<link type="text/css" href="/css/login.css" media="screen" rel="stylesheet" />
                
				<script src="/js/jquery.validate.js" type="text/javascript"></script>
                <script src="/js/jquery.validate-rules.js" type="text/javascript"></script>
                <script src="/js/login.js" type="text/javascript"></script>
                
			<? } else { ?>
                <link rel="stylesheet" href="/css/default.css" type="text/css" />
                <link type="text/css" href="/css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
				<link rel="stylesheet" href="/css/menu_style.css" type="text/css" />
    <? 		   }
	   } else { ?>
            <link rel="stylesheet" href="/css/default.css" type="text/css" />
            <link type="text/css" href="/css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
			<link rel="stylesheet" href="/css/menu_style.css" type="text/css" />
    <? } ?>     
</head>
<body <?php if($login_page) { echo('id="login"'); } else { echo(''); } ?>>