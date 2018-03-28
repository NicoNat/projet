<?php
/**
* Class PointsUtilisateur
* Permet de compter les points des utilisateurs.
*/


class PointsUtilisateur
{
	/**
	* @var int id utilisateur choisi pour compter ses points
	*/
	private $id_utilisateur;

	/**
	* @var int nombre de points de l'utilisateur.
	*/
	private $points = array();
	      
	//Getters

	/**
	* @return int renvoie l'id de cet utilsateur
	*/
	public function getId_utilisateur()
	{
		return $this->id_utilisateur;  
	}
	/**
	* @return int renvoie le nombre de point de cet utilisateur
	*/
	public function getPoints($id_questionnaire)
	{
		return $this->points[$id_questionnaire];  
	}

	//Setters 
	/**
	* @param $id_utilisateur int reçoit l'id de cet utilisateur
	*/
	private function setId_utilisateur($id_utilisateur)
	{
		$this->id_utilisateur = $id_utilisateur;
	}
	/**
	* @param $points int reçoit le nombre de point de cet utilisateur
	*/
	private function setPoints($id_questionnaire, $points)
	{
		$this->points[$id_questionnaire] = $points;
	}

	//Constructeurs
	/**
	* @param $id_utilisteur int contruit un nouvel objet Pointsutilisateur
	*/
	public function __construct($id_utilisateur)
	{
		$this->id_utilisateur = $id_utilisateur;
		$this->points[0] = 0;
	}

	//Fonctions autres
	/**
	* @param $point int Ajoute ou retire des points aux nombre de points actuels
	*/
	public function point($id_questionnaire, $point)
	{
		if(!empty($this->point[$id_questionnaire]))
		{
			$this->points[$id_questionnaire] = 0;
		}
		$this->points[$id_questionnaire] = $this->points[$id_questionnaire] + $point;
	}
}

?>
