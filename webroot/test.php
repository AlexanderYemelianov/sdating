<?php


$arr = ['a' => 'fa1', 'b' => 'b1', 'c' => 'c1'];



echo '
<form method="POST" action="test.php" enctype="multipart/form-data">
<input type="file" name="picture[]" multiple="true">
<button type="submit">Enter</button>
</form>
';

var_dump($arr);
$res = $arr['a'][0];
echo $res;

/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 10.03.2016
 * Time: 21:12
 */ 