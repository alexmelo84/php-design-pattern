<?php
    // Abstraction layer
    abstract class ProgrammingLanguage
    {
        protected $language;

        abstract public function isCompiled(): bool;

        abstract public function isInterpreted(): bool;

        abstract public function getVersion(): string;
    }

    // Concrete abstraction, every programming language type must extend the abstraction class
    class PHPLanguage extends ProgrammingLanguage
    {
        public function __construct()
        {
            $this->language = 'PHP';
        }

        public function isCompiled(): bool
        {
            return false;
        }

        public function isInterpreted(): bool
        {
            return true;
        }

        public function getVersion(): string
        {
            return '8.4';
        }
    }

    class JavaLanguage extends ProgrammingLanguage
    {
        public function __construct()
        {
            $this->language = 'Java';
        }

        public function isCompiled(): bool
        {
            return true;
        }

        public function isInterpreted(): bool
        {
            return false;
        }

        public function getVersion(): string
        {
            return '23.0.2';
        }
    }

    // Implementation Layer
    interface Platform
    {
        public function execute(): array;
    }

    class PHPPlatform implements Platform
    {
        protected $language;

        public function __construct(ProgrammingLanguage $language)
        {
            $this->language = $language;
        }

        public function execute(): array
        {
            return [
                'isCompiled' => $this->language->isCompiled(),
                'isInterpreted' => $this->language->isInterpreted(),
                'version' => $this->language->getVersion()
            ];
        }
    }

    class JavaPlatform implements Platform
    {
        protected $language;

        public function __construct(ProgrammingLanguage $language)
        {
            $this->language = $language;
        }

        public function execute(): array
        {
            return [
                'isCompiled' => $this->language->isCompiled(),
                'isInterpreted' => $this->language->isInterpreted(),
                'version' => $this->language->getVersion()
            ];
        }
    }

    // CLient code
    $php = new PHPPlatform(new PHPLanguage());
    $java = new JavaPlatform(new JavaLanguage());
?>

<?php
    include('../../components/header.php');
?>
    <h1>Bridge </h1>

    <p>Exemplo conceitual: <a href="https://refactoring.guru/design-patterns/bridge/php/example#example-1" target="_blank">https://refactoring.guru/design-patterns/bridge/php/example#example-1</a></p>

    <p>Utilização de bridge, que é uma forma de separar a abstração da implementação.</p>

    <p>Nesse exemplo foram utilizadas as linguagens de programação. A camada de abstração contém as informações respectivas de cada linguagem, enquanto a camada de implementação executaria cada linguagem baseada nas informações da camada abstrata.</p>

    <h2>Resultado:</h2>
    <ul>
        <li>
            <h3>PHP</h3>
            <?= json_encode($php->execute()) ?>
        </li>
        <li>
            <h3>Java</h3>
            <?= json_encode($java->execute()) ?>
        </li>
    </ul>
<?php
    include('../../components/footer.php');
?>