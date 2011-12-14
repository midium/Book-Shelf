<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style type="text/css" media="screen">
body { margin: 0 }
.row, .col { overflow: hidden; position: absolute; }
.row { left: 0; right: 0; }
.col { top: 0; bottom: 0; }
.scroll-x { overflow-x: auto; }
.scroll-y { overflow-y: auto; }
.header.row { height: 75px; top: 0; }
.body.row { top: 75px; bottom: 50px; }
.footer.row { height: 50px; bottom: 0; }
</style>
</head>
<body>
    <div class="header row">
        <h2>My header</h2>
    </div>
 
    <div class="body row scroll-y">
        The body
    </div>
 
    <div class="footer row">
        My footer
    </div>
</body>
</html>