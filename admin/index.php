<?php
include_once('platform.functions.php');
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../styles/main/mainStyle.css" type="text/css"/>
    <link rel="stylesheet" href="../styles/main/dashboard.css" type="text/css"/>
</head>

<body>

<div id="upperPanel">
<?php
include_once('./layout/upperPanel.php');
?>
</div>

<div id="wrapper">
<div id="navigationBar">
<?php
include_once('./layout/menu.php');
?>
</div>
<div id="content">
<div id="quickActions">
<?php
include_once('./quickActions.php');
include_once('./systemInfo.php');
?>
</div>
</div>
</div>
<footer>
<?php
include_once('./layout/footer.php');
?>
</footer>


</body>
</html>