<?php
  function pola($input){
    $color['black']  = [1,2,5,7,10,11];
    $color['white'] = [3,4,6,8,9,12];

    if (in_array($input, $color['black'])) {
      return 'style="background : black; color: white;"';
    } else {
      return 'style="background : white"';
    }
  } 

  $no = 1;
  $v = 1;
  echo "<table>";
  for($i = 0; $i < 8; $i++){
   echo '<tr>';
    for($x = 0; $x < 8; $x++){
      echo '<td '.pola($v).'>';
      echo $no++;
      echo '</td>';
      if ($v==12) {
        $v = 1;
      } else {
        $v++;
      }
    }
   echo '</tr>';
  }
  echo "</table>";

?>