<?php
    // Class (in this case it is a model) with the "clone" magic method to define how an object will be cloned
    class User
    {
        public $name;
        public $age;
        private $password;

        public function __construct($name, $age, $password)
        {
            $this->name = $name;
            $this->age = $age;
            $this->password = $password;
        }

        public function __clone()
        {
            $this->name = 'Clone of ' . $this->name;
            $this->password = '';
        }
    }

    // An action that will clone the object
    class DuplicateUser
    {
        public function handle(int $userID): User
        {
            // We shoould have a way to get the user from the storage, just mocking the object here for example purpose
            $user = new User('John Doe', 30, '123456');

            $duplicatedUser = clone $user;

            return $duplicatedUser;
        }
    }

    // CLient code
    $duplicateUser = new DuplicateUser();
    $duplicatedUser = $duplicateUser->handle(1);
?>

<?php
    include('../../components/header.php');
?>
    <h1>Prototype</h1>

    <p>Exemplo conceitual: <a href="https://refactoring.guru/design-patterns/prototype/php/example#example-1" target="_blank">https://refactoring.guru/design-patterns/prototype/php/example#example-1</a></p>

    <p>Ação de duplicar um usuário para mostrar o do método mágico <i>clone</i> em PHP, que estabelece as regras de clonagem de um objeto.</p>

    <p>Nesse exemplo adicionamos ao nome do usuário o texto "Clone of" para mostrar a execução do método "__clone". Além disso alteramos o valor da senha para mostrar como ele também altera e copia atributos privados</p>

    <h2>Objeto clonado:</h2>
    <?= var_dump($duplicatedUser) ?>
<?php
    include('../../components/footer.php');
?>