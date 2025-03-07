<!-- VUE DE LA PAGE D'ACCUEIL -->
<?php

/**
 *
 */
class ViewHome
{

    /**
     * @var string|null
     */
    private? string $message = "";
    /**
     * @var string|null
     */
    private? string $playersList = "";

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string|null $message
     * @return void
     */
    public function setMessage(?string $message): void
    {
        $this->message = $message;
    }

    /**
     * @return string|null
     */
    public function getPlayersList(): ?string
    {
        return $this->playersList;
    }

    /**
     * @param string|null $playersList
     * @return void
     */
    public function setPlayersList(?string $playersList): void
    {
        $this->playersList = $playersList;
    }

    /**
     *
     */
    public function __construct() {}


    /**
     * @return string
     */
    public function displayView() {
        return '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="./assets/style.css">
                <title>Document</title>
            </head>
            <body>
                <header>
                    <nav>
                        <ul>
                            <li><a href="/">Accueil</a></li>
                        </ul>
                    </nav>
                    <h1>Accueil</h1>              
                </header>
                <main>
                <section>
                <h2>Inscription d\'un Joueur</h2>
                <form method="post" action="">
                    <input type="text" name="nickname" placeholder="Votre Pseudo">
                    <input type="email" name="email" placeholder="Votre Email">
                    <input type="password" name="password" placeholder="Votre Mot de Passe" >
                    <input type="number" name="score" placeholder="Votre Score" >
                    <button type="submit" name="submit">Envoyer</button>
                </form>
            </section>
            <p>'.  $this->getMessage() .'</p>
            <ul>
                '. $this->getPlayersList() .'
            </ul>
    
                </main>
                <footer>
                Le footer
                </footer>
            </body>
            </html>
    ';
    }

}