<?php

class Input
{
    public $_type;
    public $_name;
    public $_value;
    public $_background;
    public $_width;
    public $_height;


    public function __construct($_background, $_width, $_height, $_name, $_value) {
        $this->_background = $_background;
        $this->_width = $_width;
        $this->_height = $_height;
        $this->_name = $_name;
        $this->_value = $_value;
    }
}

class Radio extends Input
{
    private $_isChecked;

    public function __construct($_background, $_width, $_height, $_name, $_value, bool $_isChecked)
    {
        $this->_background = $_background;
        $this->_width = $_width;
        $this->_height = $_height;
        $this->_name = $_name;
        $this->_value = $_value;
        $this->setCheckedState($_isChecked);
        $this->_type = "radio";
    }

    public function getCheckedState() : string
    {
        return $this->_isChecked;
    }

    public function setCheckedState(bool $state): void
    {
        if ($state === true){
            $this->_isChecked = "checked";
        }
        else {
            $this->_isChecked = " ";
        }
    }
}

class CheckBox extends Input
{
    private $_isChecked;

    public function __construct($_background, $_width, $_height, $_name, $_value, bool $_isChecked)
    {
        $this->_background = $_background;
        $this->_width = $_width;
        $this->_height = $_height;
        $this->_name = $_name;
        $this->_value = $_value;
        $this->setCheckedState($_isChecked);
        $this->_type = "checkbox";
    }

    public function getCheckedState() : string
    {
        return $this->_isChecked;
    }

    public function setCheckedState(bool $state): void
    {
        if ($state === true){
            $this->_isChecked = "checked";
        }
        else {
            $this->_isChecked = " ";
        }
    }
}

class Text extends Input
{
    public $_placeHolder;
    public function __construct($_background, $_width, $_height, $_name, $_value,$placeHolder)
    {
        $this->_background = $_background;
        $this->_width = $_width;
        $this->_height = $_height;
        $this->_name = $_name;
        $this->_value = $_value;
        $this->_placeHolder = $placeHolder;
        $this->_type = "text";
    }
}

class Button extends Input
{
    public $_placeHolder;
    public function __construct($_background, $_width, $_height, $_name, $_value)
    {
        $this->_background = $_background;
        $this->_width = $_width;
        $this->_height = $_height;
        $this->_name = $_name;
        $this->_value = $_value;
        $this->_type = "button";
    }
}

class Email extends Input
{
    public $_placeHolder;
    public function __construct($_background, $_width, $_height, $_name, $_value,$placeHolder)
    {
        $this->_background = $_background;
        $this->_width = $_width;
        $this->_height = $_height;
        $this->_name = $_name;
        $this->_value = $_value;
        $this->_placeHolder = $placeHolder;
        $this->_type = "email";
    }
}

class Phone extends Input
{
    public $_placeHolder;
    public function __construct($_background, $_width, $_height, $_name, $_value,$placeHolder)
    {
        $this->_background = $_background;
        $this->_width = $_width;
        $this->_height = $_height;
        $this->_name = $_name;
        $this->_value = $_value;
        $this->_placeHolder = $placeHolder;
        $this->_type = "phone";
    }
}

function convertToHTML($element) : string
{
    if ($element instanceof Radio || $element instanceof CheckBox) {
        return "<input type='$element->_type' style='width: {$element->_width}px;height: {$element->_height}px;background-color: {$element->_background}' {$element->getCheckedState()} name='{$element->_name}' value='{$element->_value}'>";
    } else if ($element instanceof Text || $element instanceof Button || $element instanceof Email || $element instanceof Phone) {
        return "<input type='$element->_type' style='width: {$element->_width}px;height: {$element->_height}px;background-color: {$element->_background}' name='$element->_name' value='$element->_value' placeholder='$element->_placeHolder'>";
    }
    return 'Not found';
}
?>

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
<?php
$firstName = new Text("white",300,15,"firstName","","First Name");
$lastName = new Text("white",300,15,"firstName","","Last Name");
$Email = new Email("white",300,15,"Email","","Email");
$Phone = new Phone("white",300,15,"Phone","","Phone");
$Male = new Phone("white",300,15,"Phone","","Phone");
$male = new Radio("white",20,20,"gender","male","");
$female = new Radio("white",20,20,"gender","female","");
$subscribe = new Radio("white",20,20,"subscribe","Subscribe","");
$button = new Button("green",150,25,"saved","saved");
echo "    <div>First name ". convertToHTML($firstName) . "</div>
    <div>Last name ". convertToHTML($lastName) . "</div>
    <div>Last name ". convertToHTML($lastName) . "</div>
    <div>Email ". convertToHTML($Email) . "</div>
    <div>Phone ". convertToHTML($Phone) . "</div>
    <div style='display: flex;align-items: center;justify-content: start'>". convertToHTML($male) . " Male " . convertToHTML($female) . " Female</div>
    <div style='display: flex;align-items: center'> Subscribe". convertToHTML($subscribe) . "</div>
    <div>". convertToHTML($button) . "</div>";
?>

</body>
</html>
