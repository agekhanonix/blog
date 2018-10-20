<?php
function arab2rom($nombre_arab){
	$nb_b10=array('I','X','C','M');
	$nb_b5=array('V','L','D');
	$nbrom='';
	$nombre=$nombre_arab;
	if($nombre>=0 && $nombre<4000) {
		for($i=3; $i>=0 ; $i--) {	
			$chiffre=floor($nombre/pow(10,$i));
			if($chiffre>=1){
				$nombre=$nombre-$chiffre*pow(10,$i);
				if($chiffre<=3){
					for($j=$chiffre; $j>=1; $j--){ 
						$nbrom=$nbrom.$nb_b10[$i]; 
					}
				}elseif($chiffre==9){
					$nbrom=$nbrom.$nb_b10[$i].$nb_b10[$i+1];	
				}elseif($chiffre==4){
						$nbrom=$nbrom.$nb_b10[$i].$nb_b5[$i];
				}else{
					$nbrom=$nbrom.$nb_b5[$i];
					for($j=$chiffre-5; $j>=1; $j--){ 
						$nbrom=$nbrom.$nb_b10[$i]; 
					}	
				}
			}			
		}
	} else {
		echo 'Valeur Hors Limite';		
	}		
  	return $nbrom;
}

/**
 * Récupérer la véritable adresse IP d'un visiteur
 */
function getIp() {
	if (isset($_SERVER['HTTP_CLIENT_IP'])) {		// IP si internet partagé
		return $_SERVER['HTTP_CLIENT_IP'];
	} elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {// IP derrière un proxy
		return $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else { 										// Sinon : IP normale
		return (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '');
	}
}