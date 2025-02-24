<?php
    // Singleton base class to allow multiple classes to inherit from it and become singletons
    class Singleton {
        /**
         * Propety to store the singleton's instances
         */
        private static $instances = [];

        /**
         * Constructor must be protected to avoid new instantions
         */
        protected function __construct() {}

        /**
         * Clone method must be private to avoid cloning
         */
        protected function __clone() {}

        /**
         * Wakeup method must be private to avoid serializations
        */
        protected function __wakeup() {}

        /**
         * Method that returns the singleton's instance
         */
        public static function getInstance() {
            $subclass = static::class;
            if (!isset(self::$instances[$subclass])) {
                self::$instances[$subclass] = new static;
            }
            return self::$instances[$subclass];
        }
    }

    class Database extends Singleton {
        private $connection;

        protected function __construct() {
            // $this->connection = new PDO('mysql:host=localhost  dbname=test', 'root', '');
        }

        public function select(array $fields, array $where = []): PDOStatement|false|string
        {
            // Here would come the logic to mount the query

            // return $this->connection->query('');

            return 'Executed from Database class singleton';
        }
    }

    // There should be more classes inheriting from Singleton

    // Client code
    $database1 = Database::getInstance();
    $result1 = $database1->select(['field1'], []);

    $database2 = Database::getInstance();
    $comparing = ($database1 === $database2)? 'true' : 'false';
?>
<!-- CURRENT_DATE -->
<?php
    include('../../components/header.php');
?>
    <h1>Singleton</h1>

    <p>Exemplo conceitual: <a href="https://refactoring.guru/design-patterns/singleton/php/example#example-1" target="_blank">https://refactoring.guru/design-patterns/singleton/php/example#example-1</a></p>

    <p>Singleton garante que uma classe terá apenas uma instância em todo o projeto.</p>

    <p>Utilizar com precaução e em situações específicas, ver prós e contras desse pattern: <a href="https://refactoring.guru/design-patterns/singleton#pros-cons" target="_blank">https://refactoring.guru/design-patterns/singleton#pros-cons</a>.</p>

    <h2>Resultado:</h2>
    <ul>
        <li>
            O resultado da query é <?= $result1; ?>.
        </li>
        <li>
            Executando duas instâncias da classe e comparando-as: <?= $comparing; ?>.
        </li>
    </ul>
<?php
    include('../../components/footer.php');
?>