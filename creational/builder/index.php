<?php
    // Class model for a team
    class Team {
        public $sport;
        public $playersAmount;
        public $coach;
    }

    // Builder interface
    interface TeamBuilder {
        public function reset();
        public function setSport();
        public function setPlayersAmount();
        public function setCoach();
        public function getResult();
    }

    // Every sport builder
    class SoccerBuilder implements TeamBuilder {
        private $team;

        public function __construct() {
            $this->reset();
        }

        public function reset() {
            $this->team = new Team();
        }

        public function setSport() {
            $this->team->sport = 'Soccer';
        }

        public function setPlayersAmount() {
            $this->team->playersAmount = 11;
        }

        public function setCoach() {
            $this->team->coach = 'João';
        }

        public function getResult() {
            return $this->team;
        }
    }

    class BasketballBuilder implements TeamBuilder {
        private $team;

        public function __construct() {
            $this->reset();
        }

        public function reset() {
            $this->team = new Team();
        }

        public function setSport() {
            $this->team->sport = 'Basketball';
        }

        public function setPlayersAmount() {
            $this->team->playersAmount = 5;
        }

        public function setCoach() {
            $this->team->coach = 'Maria';
        }

        public function getResult() {
            return $this->team;
        }
    }

    // Director manages the team builders
    class TeamDirector {
        public function buildTeam(TeamBuilder $teamBuilder) {
            $teamBuilder->setSport();
            $teamBuilder->setPlayersAmount();
            $teamBuilder->setCoach();
        }
    }

    // Client code
    $teamDirector = new TeamDirector();

    $soccerBuilder = new SoccerBuilder();
    $teamDirector->buildTeam($soccerBuilder);
    $soccerTeam = $soccerBuilder->getResult();

    $basketballBuilder = new BasketballBuilder();
    $teamDirector->buildTeam($basketballBuilder);
    $basketballTeam = $basketballBuilder->getResult();
?>

<?php
    include('../../components/header.php');
?>
    <h1>Builder</h1>

    <p>Exemplo conceitual: <a href="https://refactoring.guru/design-patterns/builder" target="_blank">https://refactoring.guru/design-patterns/builder</a></p>

    <p>Neste exemplo vemos a utilização do builder para a criação de objetos complexos sem que o código cliente saiba das etapas de criação.</p>

    <p>É utilizado o conceito de <i>Director</i> para gerenciar os builders, mas essa camada não é obrigatória.</p>

    <h2>Futebol</h2>
    <p>Esporte: <?= $soccerTeam->sport ?></p>
    <p>Jogadores: <?= $soccerTeam->playersAmount ?></p>
    <p>Treinador: <?= $soccerTeam->coach ?></p>

    <h2>Basquete</h2>
    <p>Esporte: <?= $basketballTeam->sport ?></p>
    <p>Jogadores: <?= $basketballTeam->playersAmount ?></p>
    <p>Treinador: <?= $basketballTeam->coach ?></p>
<?php
    include('../../components/footer.php');
?>