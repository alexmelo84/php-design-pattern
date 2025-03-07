<?php
    interface Mediator
    {
        public function notify(string $event): void;
    }

    class ConcreteMediator implements Mediator
    {
        private $object;

        public function __construct(ObjectInterface $object)
        {
            $this->object = $object;
        }

        public function notify(string $event): void
        {

        }
    }

    interface ObjectInterface
    {
        public function handle();
    }
?>

<?php
    include('components/header.php');
?>
    <h1>Mediator</h1>

    <p>Exemplo conceitual: <a href="https://refactoring.guru/design-patterns/mediator/php/example#example-0" target="_blank">https://refactoring.guru/design-patterns/mediator/php/example#example-0</a></p>

    <p>Mediator serve para diminuir o acoplamento entre componentes, fazendo com que eles se comuniquem de forma indireta através de um mediador.</p>

    <p>Como explicado no parágrafo "Usage examples", esse pattern não é muito utilizado no PHP por não ser uma linguagem direcionada à criação de GUI's, mas esse pattern pode ser implementado. Um uso é nos <i>events dispatchers</i> de frameworks.</p>

    <p>Nesse exemplo é mostrado um funcionamento simples de um mediador.</p>

    <h2>Resultado:</h2>
<?php
    include('components/footer.php');
?>