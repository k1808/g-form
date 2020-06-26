<?php
function debug($arr){
  echo '<pre>';
  print_r($arr);
  echo '</pre><hr>';
}

function getComments($data){
  $result = '';
  foreach ($data as $elem) {
      $result .= '<div class="media mb-4"><img class="d-flex mr-3 rounded-circle" src="public/img/';
      $result .= $elem['avatar'] . '" width="50" height="50" alt=""><div class="media-body"><h5 class="mt-0">';
      $result .= $elem['name'] . '</h5><div class="mt-0"><small >';
      $result .= $elem['date_create'] . '</small></div>';
      $result .= $elem['comment'] . '</div></div>';
    }
		
	echo $result;    
} 



function validateLength($value, $min, $max) {
    if ($value) {
        $len = strlen($value);
        if ($len < $min or $len > $max) {
            return "Значение должно быть от $min до $max символов";
        }
    }

    return null;
}