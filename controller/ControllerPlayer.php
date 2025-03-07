<?php

require_once './model/ModelPlayer.php';
require_once './view/ViewHome.php';

/**
 *
 */
class ControllerPlayer extends ModelPlayer
{

    /**
     * @var ViewHome
     */
    private ViewHome $viewHome;

    /**
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->viewHome = new ViewHome();
    }

    /**
     * @return string
     * Permet la récupération et l'affichage de la liste des joueurs
     */
    private function getPlayersController(): string
    {
        $playersList = "";

        $players = $this->getPlayers();

        foreach ($players as $player) {
            $playersList .= "<li class='players'>
                                <h3>{$player['pseudo']}</h3>
                                <p>{$player['email']}</p>
                                <p>Score : {$player['score']}</p>
                            </li>";
        }

        return $playersList;
    }

    /**
     * @return string
     * Permet l'ajout en base de donnée d'un joueur avec les vérifications nécéssaires.
     */
    private function addPlayerController(): string {
        if (isset($_POST["submit"])) {
            if (!empty($_POST["email"]) && !empty($_POST["password"]) && !empty(($_POST['nickname'])) && !empty($_POST["score"])) {

                if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    return "L'email n'est pas au bon format.";
                }

                if(!filter_var($_POST['score'], FILTER_VALIDATE_INT)) {
                    return "Le score n'est pas au bon format.";
                }

                $exists = $this->getPlayerByMail($_POST["email"]);

                if (!empty($exists)) {
                    return "L'adresse e-mail est déjà utilisé.";
                }

                $this->setNickname($_POST['nickname']);
                $this->setEmail($_POST['email']);
                $this->setScore($_POST['score']);
                $this->setPassword($_POST['password']);

                $this->addPlayer();
                return !empty($this->getPlayerByMail($this->getEmail())) ? $this->getNickname() . ' à été enregistré en BDD !' : 'Le joueur n\'a pas été enregistré en BDD';
            } else {
                return 'Veuillez remplir les champs.';
            }
        }
        return "";
    }

    /**
     * @return array
     * Fonction d'ajout en base de donnée
     */
    public function addPlayer(): array
    {
        try {
            $pdo = $this->getBdd();
            $query = $pdo->prepare('INSERT INTO players (pseudo, email,score, psswrd) VALUES (:nickname,:email,:score,:password)');
            $query->bindValue(':nickname', $this->getNickname());
            $query->bindValue(':email', $this->getEmail());
            $query->bindValue(':score', $this->getScore());
            $query->bindValue(':password', $this->getPassword());
            $query->execute();
            return $this->getPlayerByMail($this->getEmail());
        } catch (PDOException $e) {
            return [];
        }
    }

    /**
     * @return array
     * Fonction de récupération en base de donnée
     */
    public function getPlayers(): array
    {
        try {
            $pdo = $this->getBdd();
            $query = $pdo->query('SELECT id,pseudo,score,email FROM players');
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    /**
     * @param string $email
     * @return array
     * Fonction de récupération via l'email en base de donnée
     */
    public function getPlayerByMail(string $email): array
    {
        try {
            $pdo = $this->getBdd();
            $query = $pdo->prepare('SELECT id,pseudo,score,email FROM players WHERE email = :email');
            $query->bindValue(':email', sanitize($email));
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $e) {
            return [];
        }
    }

    /**
     * @return string
     * Rendu de la page
     */
    public function render(): string
    {
        $this->viewHome->setMessage($this->addPlayerController());
        $this->viewHome->setPlayersList($this->getPlayersController());

        return $this->viewHome->displayView();
    }

}