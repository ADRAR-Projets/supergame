<?php
//MODEL POUR LA TABLE JOUEURS

require_once './utils/utils.php';

/**
 *
 */
class ModelPlayer {


    /**
     * @var int|null
     */
    private ?int $id;
    /**
     * @var string|null
     */
    private ?string $nickname;
    /**
     * @var string|null
     */
    private ?string $email;

    /**
     * @var int|null
     */
    private ?int $score;
    /**
     * @var string|null
     */
    private ?string $password;

    /**
     * @var PDO|null
     */
    protected ?PDO $bdd;


    /**
     *
     */
    public function __construct()
    {
        $this->bdd = connect();
    }

    /**
     * @return PDO
     * Récupère l'instance de la base de donnée
     */
    public function getBdd(): PDO
    {
        return $this->bdd;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNickname(): string
    {
        return $this->nickname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return int|null
     */
    public function getScore(): ?int
    {
        return $this->score;
    }

    /**
     * @param int $id
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = sanitize($id);
    }

    /**
     * @param string $nickname
     * @return void
     */
    public function setNickname(string $nickname): void
    {
        $this->nickname = sanitize($nickname);
    }

    /**
     * @param string $email
     * @return void
     */
    public function setEmail(string $email): void
    {
        $this->email = sanitize($email);
    }

    /**
     * @param string $password
     * @return void
     */
    public function setPassword(string $password): void
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * @param int|null $score
     * @return void
     */
    public function setScore(?int $score): void
    {
        $this->score = sanitize($score);
    }

}

?>