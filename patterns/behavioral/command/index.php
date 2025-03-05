<?php
    // Command interface to declare the execution method
    interface Command
    {
        public function execute(): void;
    }

    // Different commands
    class GetUserCommand implements Command
    {
        public function execute(): void
        {
            echo "Simple command. Getting user from storage...";
        }
    }

    class CreateUserCommand implements Command
    {
        private $receiver;
        private $name;
        private $email;

        public function __construct(User $receiver, string $name, string $email)
        {
            $this->receiver = $receiver;
            $this->name = $name;
            $this->email = $email;
        }

        public function execute(): void
        {
            echo "Complex command...";
            $this->receiver->validate($this->name, $this->email);
            $this->receiver->create($this->name, $this->email);
        }
    }

    // Receiver class containing the business logic
    class User
    {
        private $name;
        private $email;

        public function __construct(string $name = '', string $email = '')
        {
            $this->name = $name;
            $this->email = $email;
        }

        public function validate(): void
        {
            echo "Validating user data...";
        }

        public function create(): void
        {
            echo "Creating user...";
        }
    }

    // Invoker is responsible for running commands
    class Invoker
    {
        public function run(Command $command)
        {
            $command->execute();
        }
    }

    // Client code
    $invoker = new Invoker();
?>

<?php
    include('components/header.php');
?>
    <h1>Command</h1>

    <p>Exemplo conceitual: <a href="https://refactoring.guru/design-patterns/chain-of-responsibility/php/example#example-0" target="_blank">https://refactoring.guru/design-patterns/chain-of-responsibility/php/example#example-0</a></p>

    <p>Command transforma uma requisição em um objeto com todos os dados da requisição.</p>

    <p>No exemplo tem um caso de comando simples e outro complexo, onde o <i>invoker</i> recebe um objeto e pode realizar diversas operações.</p>

    <h2>Resultado:</h2>
    <ul>
        <li>
            Comando simples: 
            <?php
                $invoker->run(new GetUserCommand());
            ?>
        </li>
        <li>
            Comando complexo: 
            <?php
                $user = new User();
                $invoker->run(new CreateUserCommand($user, 'Name', 'email'));
            ?>
        </li>
<?php
    include('components/footer.php');
?>