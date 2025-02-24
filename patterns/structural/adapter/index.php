<?php
    // Interface for sports scores
    interface ScoreInterface {
        public function addScore(string $teamName);
    }

    // Classes to manage score for sports
    class Score implements ScoreInterface {
        public function addScore(string $teamName) {
            // Here it would save in the storage one more point or goal for team
            return "One more for $teamName!\n";
        }
    }

    class BasketballScore implements ScoreInterface {
        protected $adapter;
        protected $pointAmount;

        public function __construct(BasketballAdapter $adapter, int $pointAmount) {
            $this->adapter = $adapter;
            $this->pointAmount = $pointAmount;
        }

        public function addScore(string $teamName) {
            // Here it would save in the storage one or more points to the team
            return $this->adapter->saveScore($this->pointAmount, $teamName);
        }
    }

    /**
     * Adapter for basketball score.
     * In basketball one team can make 1, 2 or 3 points, so we need to adapt the ScoreInterface to accept these rules. 
     */
    class BasketballAdapter
    {
        private $pointAmount;
        private $teamName;

        public function __construct(int $pointAmount, string $teamName)
        {
            $this->pointAmount = $pointAmount;
            $this->teamName = $teamName;
        }

        public function saveScore()
        {
            // Here we would save in the score storage the points amount passed in the constructor
            return "Saving $this->pointAmount points for $this->teamName!";
        }
    }

    // CLient code
    $football = new Score();

    $basketballOnePoints = new BasketballScore(new BasketballAdapter(1, 'Team B'), 1);
    $basketballTwoPoints = new BasketballScore(new BasketballAdapter(2, 'Team B'), 2);
    $basketballThreePoints = new BasketballScore(new BasketballAdapter(3, 'Team B'), 3);
?>

<?php
    include('../../components/header.php');
?>
    <h1>Adapter</h1>

    <p>Exemplo conceitual: <a href="https://refactoring.guru/design-patterns/adapter/php/example#example-1" target="_blank">https://refactoring.guru/design-patterns/adapter/php/example#example-1</a></p>

    <p>Exemplo de como utilizar um adaptador para converter uma interface.</p>
    
    <p>Nesse caso de uso há uma interface que adiciona um ponto ou gol para para um time, mas se precisar implementar um novo esporte com diferentes pontuações pode-se utilizar o <i>adapter</i> para converter para adicionar a pontuação correspondente.</p>

    <h2>Resultado:</h2>
    <ul>
        <li>
            Time A de futebol marca um gol: <?= $football->addScore('Team A'); ?>
        </li>
        <li>
            Time A de futebol marca outro gol: <?= $football->addScore('Team A'); ?>
        </li>
        <li>
            Time B de futebol marca um gol: <?= $football->addScore('Team A'); ?>
        </li>
        <li>
            Time C de basquete converte um lance livre: <?= $basketballOnePoints->addScore('Team C'); ?>
        </li>
        <li>
            Time C de basquete converte uma bandeja: <?= $basketballTwoPoints->addScore('Team C'); ?>
        </li>
        <li>
            Time C de basquete converte chute de 3 pontos: <?= $basketballThreePoints->addScore('Team C'); ?>
        </li>
    </ul>
<?php
    include('../../components/footer.php');
?>