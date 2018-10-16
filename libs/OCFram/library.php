<?php
function arab2rom($nombre_arab)
{
	$nb_b10=array('I','X','C','M');
	$nb_b5=array('V','L','D');
	$nbrom='';
	$nombre=$nombre_arab;
	if($nombre>=0 && $nombre<4000)  // on peut convertir
		{
		for($i=3; $i>=0 ; $i--) 
		{	
			$chiffre=floor($nombre/pow(10,$i));
			if($chiffre>=1)
				{
					$nombre=$nombre-$chiffre*pow(10,$i);
					if($chiffre<=3)
					{
						for($j=$chiffre; $j>=1; $j--)
							{ 
								$nbrom=$nbrom.$nb_b10[$i]; 
							}
					}elseif($chiffre==9){
						
						 $nbrom=$nbrom.$nb_b10[$i].$nb_b10[$i+1];
						
					}elseif($chiffre==4){
						
						 $nbrom=$nbrom.$nb_b10[$i].$nb_b5[$i];
					}else{
						$nbrom=$nbrom.$nb_b5[$i];
						
						for($j=$chiffre-5; $j>=1; $j--)
							{ 
								$nbrom=$nbrom.$nb_b10[$i]; 
							}	
					}
			
				}			
		}
	       	}
	else
		{
			echo 'Valeur Hors Limite';		
		}		
  	return $nbrom;
}

function daterom()
{
$mois_rom = array('DEC', 'JAN', 'FEB', 'MAR', 'APR', 'MAI', 'IVN', 'IVL', 'AVG', 'SEP', 'OCT', 'NOV', 'DEC'); // on fait correspondre les indices aux mois on repete decembre a cause du modulo pour que (11+1)%12=0 ca donne decembre et non rien lol
// de plus on a ainsi JAN=1, FEB=2, plus simple non?
$j = date("d");
$mois = round(date("m")); // on arrondi pour pouvoir indexer(sinon au lieu de 3 on a 03 et ca bug!)
$annee = date("Y"); // Pour savoir si l'annee sera bissextile ou non
$date_romaine='';
$taille_mois=31;
$ad=0;
switch($mois){  //c etait ca ou encore faire deux array...
	case 3:case 5:case 7: case 10:
	$ides_mois=15;
	break;
	case 1:case 8:case 12:
	$ides_mois=13;
	break;
	case 4:case 6:case 9: case 11:
	$taille_mois=30;
	$ides_mois=13;
	break;
	default:	
	if($annee%4==0 || $annee%400==0){
		$taille_mois=29;}
	else{$taille_mois=28;}
	$ides_mois=13;
	break;
}

// Bon la il faut s y connaitre en calendrier romain :) on decompte les jours avant (a.d.) une certaine date du mois : les calandes (Kalendas) les nones et les ides(13 ou 15 e jour)
// Ensuite, on decompte les jours par rapport au mois suivant  (prochaine calende)

if($j==1){
	$date_romaine='KAL. '.$mois_rom[$mois].'.';}	// les calendes (premier jour du mois)
elseif($j<=$ides_mois-8){
	$ad=$ides_mois-8-$j;
	$date_romaine='NON. '.$mois_rom[$mois].'.';}   // les nones, 5 ou 7 eme jour (8 jours avant les ides)
elseif($j<=$ides_mois){
	$ad=$ides_mois-$j;
	$date_romaine='ID. '.$mois_rom[$mois].'.';}
else{							// avant les calendes du prochain mois
	$date_romaine='KAL. '.$mois_rom[($mois+1)%12].'.';
	$ad=$taille_mois-$j+1;
}
	if($ad==1){	
		$date_romaine='PRE '.$date_romaine; // "a.d. II" n existe pas, on dit PRIDIE (la veille)	
	}elseif($mois==2 && $ad+1>=6 && ($annee%4==0 || $annee%400==0)){ /* he oui le mois de fevrier (FEB) pose toujours des problemes ;)*/
		if($ad+1==6){		
		       	$date_romaine='a.d. BIS '.arab2rom($ad+1).' '.$date_romaine;}  // on utilise ma fonction lol la l année est bissextile
		else{
			$date_romaine='a.d. '.arab2rom($ad).' '.$date_romaine; //
			}
	}elseif($ad!=0){
		$date_romaine='a.d. '.arab2rom($ad+1).' '.$date_romaine;   // pour les autres mois
		}
	// calcul de la date
$date_romaine=$date_romaine.' '.arab2rom($annee+753).' A.U.C.';	
return $date_romaine;
}