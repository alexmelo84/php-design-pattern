<?php
    // Occupations interface
    interface Occupation {
        public function name(): string;
        public function getDirectSubordinates(): array;
        public function addSubordinate(Occupation $occupation): void;
        public function getDirectSubordinatesOccupationsName(): string;
    }

    // Occupations
    class Programmer implements Occupation {
        private $subordinates = [];

        public function name(): string {
            return 'Programador';
        }

        public function getDirectSubordinates(): array {
            return $this->subordinates;
        }

        public function addSubordinate(Occupation $occupation): void {
            return;
        }

        public function getDirectSubordinatesOccupationsName(): string {
            return 'Sem subordinados';
        }
    }

    class QA implements Occupation {
        public function name(): string {
            return 'QA';
        }

        public function getDirectSubordinates(): array {
            return [];
        }

        public function addSubordinate(Occupation $occupation): void {
            return;
        }

        public function getDirectSubordinatesOccupationsName(): string {
            return 'Sem subordinados';
        }
    }

    class Coordinator implements Occupation {
        private $subordinates = [];

        public function name(): string {
            return 'Coordenador';
        }

        public function getDirectSubordinates(): array {
            return $this->subordinates;
        }

        public function addSubordinate(Occupation $occupation): void {
            $this->subordinates[] = $occupation;
        }

        public function getDirectSubordinatesOccupationsName(): string {
            return implode(', ', array_map(function($occupation) {
                return $occupation->name();
            }, $this->getDirectSubordinates()));
        }
    }

    class Manager implements Occupation {
        private $subordinates = [];

        public function name(): string {
            return 'Gerente';
        }

        public function getDirectSubordinates(): array {
            return $this->subordinates;
        }

        public function addSubordinate(Occupation $occupation): void {
            $this->subordinates[] = $occupation;
        }

        public function getDirectSubordinatesOccupationsName(): string {
            return implode(', ', array_map(function($occupation) {
                return $occupation->name();
            }, $this->getDirectSubordinates()));
        }
    }

    // Client code
    $manager = new Manager();
    $manager->addSubordinate(new Coordinator());

    $coordinator = new Coordinator();
    $coordinator->addSubordinate(new Programmer());
    $coordinator->addSubordinate(new QA());
?>

<?php
    include('../../components/header.php');
?>
    <h1>Composite </h1>

    <p>Exemplo conceitual: <a href="https://refactoring.guru/design-patterns/composite#pseudocode" target="_blank">https://refactoring.guru/design-patterns/composite#pseudocode</a></p>

    <p>Composite é uma forma de lidar com estruturas compostas, principalmente em forma de pirâmide.</p>

    <p>Nesse exemplo é mostrada uma hierarquia simples de níveis de trabalho em uma empresa onde cada nível tem seus cargos subordinados.</p>

    <h2>Resultado:</h2>
    <ul>
        <li>
            Gerente: <?= $manager->getDirectSubordinatesOccupationsName() ?>
        </li>
        <li>
            Coordenador: <?= $coordinator->getDirectSubordinatesOccupationsName() ?>
        </li>
        <li>
            Programador: <?= $coordinator->getDirectSubordinates()[0]->getDirectSubordinatesOccupationsName() ?>
        </li>
        <li>
            QA: <?= $coordinator->getDirectSubordinates()[1]->getDirectSubordinatesOccupationsName() ?>
        </li>
    </ul>
<?php
    include('../../components/footer.php');
?>