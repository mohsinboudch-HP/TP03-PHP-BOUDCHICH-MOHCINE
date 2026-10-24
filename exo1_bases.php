<?php
// commentaire 
# commentaire
/* commentaire 
   commentaire
*/
    echo "Hello PHP";
?>
<?php
  //'$x'-- valide
  //'$_x'-- valide 
  //'$2x'-- invalide
  //'$x-y'-- invalide
  //$Prix_HT-- valide
  //$Prix ht-- invalide
  // $état -- valide
  //car l'espace ,tiret et les chiffres ne sont pas  autorisés dans le nom d'une variable
  $x = 1;
  $_x = 2;
  $Prix_HT = 50;
  $état = "actif";
  echo " <br> X=$x,_X=$_x, Prix_HT=$Prix_HT, État=$état";
  $A="MAJUSCULE";
  $a="minuscule";
echo" <br> A=$A, <br> a=$a";
  

?>