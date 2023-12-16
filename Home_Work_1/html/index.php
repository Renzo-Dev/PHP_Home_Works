<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<!--<form action="--><?php //=$_SERVER['PHP_SELF']?><!--">-->
<!--    <input type="text" name="firstValue" value="--><?php //=$_REQUEST['firstValue']?><!--">-->
<!--    <input type="text" name="secondValue" value="--><?php //=$_REQUEST['secondValue']?><!--">-->
<!--    <input type="submit">-->
<!--</form>-->
</body>
</html>
<?php
function inc(&$inc)
{
    $inc+=10;
    echo "inc= $inc";
}

$val = 10;
inc($val);
echo "<br>val= $val";


?>
