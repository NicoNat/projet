<?php



class Utilisateur
{
	/**
	* @var string login de l'utilisateur
	*/
	private static $login = 'indéfini';

	/**
	* @var int valeur pour savoir si l'utilisateur est prof
	*/
	private static $prof = 0;

	/**
	* @var int valeur de l'id de l'utilisateur
	*/
	private static $id = 0;
	      
	//Getters
	/**
	* @return string renvoie le login de cet utilsateur
	*/
	public function getLogin()
	{
		return self::$login;  
	}

	/**
	* @return int renvoie si l'utilsateur est prof
	*/
	public function getProf()
	{
		return self::$prof;  
	}
	/**
	* @return int renvoie l'id de cet utilsateur
	*/
	public function getId()
	{
		return self::$id;  
	}
	     
	//Setters 
	/**
	* @param $login2 change le login de l'utilisateur
	*/
	public function setLogin($login)
	{
		self::$login = $login;
	}
	/**
	* @param $prof2 change la valeur prof de l'utilisateur
	*/
	public function setProf($prof)
	{
		self::$prof = $prof;
	}
	/**
	* @param change l'id de l'utilisateur
	*/
	public function setId($id)
	{
		self::$id = $id;
	}
	      
	//Constructeurs
	/**
	* @param $id_utilisteur int contruit un nouvel objet Pointsutilisateur
	*/
	public function __construct($id)
	{
		global $bdd;
		$info = $bdd->prepare('SELECT * FROM UTILISATEUR WHERE id_utilisateur = ?');
		$info -> execute(array($id));
		$info = $info->fetch();
		self::$login = $info['login'];
		self::$prof = $info['prof'];
		self::$id = $info['id_utilisateur'];
	} 
}
?>