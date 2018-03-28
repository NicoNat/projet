<?php

class pointsparquestionnaire extends pointsutilisateurs{

	/**
	* @var integer id_questionnaire du questionnaire en question
	*/
	protected $id_questionnaire;

	/**
	* @var integer note_du_questionnaire du questionnaire en question
	*/
	protected $note_du_questionnaire;

	//Getters

	/**
	* @return int renvoie l'id du questionnaire
	*/
	public function getId_questionnaire()
	{
		return $this->id_questionnaire;  
	}
	/**
	* @return int renvoie le nombre de point de cet utilisateur
	*/
	public function geNote_du_questionnaire()
	{
		return $this->note_du_questionnaire;  
	}

	//Setters 
	/**
	* @param $id_utilisateur int reçoit l'id du questionnaire
	*/
	private function setId_questionnaire($id_questionnaire)
	{
		$this->id_questionnaire = $id_questionnaire;
	}
	/**
	* @param $points int reçoit le nombre de point de cet utilisateur
	*/
	private function setNote_du_questionnaire($note_du_questionnaire)
	{
		$this->note_du_questionnaire = $note_du_questionnaire;
	}

	//Constructeurs
	/**
	* @param $id_utilisteur integer
	* @param $id_questionnaire integer
	*/
	public function __construct($id_utilisateur, $id_questionnaire)
	{
		parent::__construct($id_utilisateur);
		$this->note_du_questionnaire = 0;
	}

	//Fonctions autres
	/**
	* @param $point int Ajoute ou retire des points aux nombre de points actuels
	*/
	public function point($point)
	{
		$this->note_du_questionnaire = $this->note_du_questionnaire + $point;
	}

}

?>
