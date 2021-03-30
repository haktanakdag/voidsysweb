<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8"/>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<!--<script src="../js/jquery-3.1.1.min.js" type="text/javascript"></script>-->
<!--<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
<link rel="stylesheet" type="text/css" href="../menu/menu.css" media="screen" />
<!-- MENU -->
<script src="../menu/highlight.pack.js"></script>
<script src="../menu/menu.js"></script>
<link href="../css/tab.css" rel="stylesheet" type="text/css"/>
<script src="../menu/src/jquery.cookie.js"></script>
<script type="text/javascript" src="../menu/src/jquery.navgoco.js"></script>
<link rel="stylesheet" type="text/css" href="../menu/src/jquery.navgoco.css" media="screen" />
<link rel="shortcut icon" href="../images/vkucuk.ico" type="image/x-icon" />
<script src="https://www.google.com/recaptcha/api.js?hl=tr"></script>
<script type="text/javascript" id="menu1-javascript">
$(document).ready(function() {
	// Initialize navgoco with default options
	$("#menu1").navgoco({
		caretHtml: '',
		accordion: false,
		openClass: 'open',
		save: true,
		cookie: {
			name: 'navgoco',
			expires: false,
			path: '/'
		},
		slide: {
			duration: 400,
			easing: 'swing'
		},
		// Add Active class to clicked menu item
		onClickAfter: active_menu_cb,
	});

	$("#collapseAll").click(function(e) {
		e.preventDefault();
		$("#menu1").navgoco('toggle', false);
	});

	$("#expandAll").click(function(e) {
		e.preventDefault();
		$("#menu1").navgoco('toggle', true);
	});
});
</script>
<script type="text/javascript" id="menu2-javascript">
$(document).ready(function() {
	$("#menu2").navgoco({accordion: true});
});
</script>
 <script type="text/javascript">
        function searchAndHighlight(searchTerm, selector) {
            if (searchTerm) {               
                var selector = selector || "#realTimeContents"; //use body as selector if none provided
                var searchTermRegEx = new RegExp(searchTerm, "ig");
                var matches = $(selector).text().match(searchTermRegEx);
                if (matches != null && matches.length > 0) {
                    $('.highlighted').removeClass('highlighted'); //Remove old search highlights 
 
                    //Remove the previous matches
                    $span = $('#realTimeContents span');
                    $span.replaceWith($span.html());
 
                    if (searchTerm === "&") {
                        searchTerm = "&amp;";
                        searchTermRegEx = new RegExp(searchTerm, "ig");
                    }
                    
                    $(selector).html($(selector).html().replace(searchTerm, "<b style='background-color: yellow;'>" + searchTerm + "</b>"));
                    $('.match:first').addClass('highlighted');

                    if ($('.highlighted:first').length) { //if match found, scroll to where the first one appears
                        $(window).scrollTop($('.highlighted:first').position().top);
                    }
                    return true;
                }
            }
            return false;
        }
 
        $(document).on('click', '.searchButtonClickText_h', function (event) {
 
            $(".highlighted").removeClass("highlighted").removeClass("match");
            if (!searchAndHighlight($('.textSearchvalue_h').val())) {
                alert("No results found");
            }
 
 
        });
    </script>
<!-- MENU -->

<!-- CK Editor -->
<script src="../ckeditor/ckeditor.js"></script>
<script src="../ckeditor/adapters/jquery.js"></script>
<!-- <link href="../ckeditor/sample.css" rel="stylesheet"></link>CK Editor -->

<link rel="stylesheet" href="../css/datepicker.css">
<link rel="stylesheet" href="../css/fieldset.css" type="text/css" />
<link rel="stylesheet" href="../css/hrstyle.css" type="text/css" />
<link href="../css/input.css" rel="stylesheet" type="text/css"/>
<link href="../css/gridtable.css" rel="stylesheet" type="text/css"/>
<link href="../css/pager.css" rel="stylesheet" type="text/css"/>
<link href="../css/table.css" rel="stylesheet" type="text/css"/>
<link href="../css/textarea.css" rel="stylesheet" type="text/css"/>
<link href="../css/tab.css" rel="stylesheet" type="text/css"/>
<link href="../css/responsivetable.css" rel="stylesheet" type="text/css"/>
<link href="../css/buttonlink.css" rel="stylesheet" type="text/css"/>
<link href="../css/select.css" rel="stylesheet" type="text/css"/>
<script src="../js/jquery.table2excel.js" type="text/javascript"></script>
<script src="../js/filterTable.js" type="text/javascript"></script>
<link href="../css/adisyon.css" rel="stylesheet" type="text/css"/>
<link href="../css/loading.css" rel="stylesheet" type="text/css"/>
<script src="../js/loading.js" type="text/javascript"></script>
</head>
