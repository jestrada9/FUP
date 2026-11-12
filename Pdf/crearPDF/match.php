<?php
function like_match($pattern, $subject)
{
    $pattern = str_replace('%', '.*', preg_quote($pattern, '/'));
    return (bool) preg_match("/^{$pattern}$/i", $subject);
}

$sin_folear = like_match('%000001%','2416315786');
if($sin_folear == true){
	echo "foleame";
}
else{
	echo "ya estoy";
}
//var_dump($sin_folear)
?>