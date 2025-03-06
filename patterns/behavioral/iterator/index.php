<?php
    // Concrete iterator
    class CollectionIterator implements \Iterator
    {
        private $tree;
        private $position = 0;
        private $reverse = false;

        public function __construct($tree, bool $reverse = false)
        {
            $this->tree = $tree;
            $this->reverse = $reverse;
        }

        public function current(): mixed
        {
            return $this->tree->getItems()[$this->position];
        }

        public function key(): mixed
        {
            return $this->position;
        }

        public function next(): void
        {
            $this->position = $this->position + ($this->reverse ? -1 : 1);
        }

        public function rewind(): void
        {
            $this->position = $this->reverse ? count($this->tree->getItems()) - 1 : 0;
        }

        public function valid(): bool
        {
            return isset($this->tree->getItems()[$this->position]);
        }
    }

    // Concrete collections
    class Collection implements \IteratorAggregate
    {
        private $tree;

        public function __construct($tree)
        {
            $this->tree = $tree;
        }

        public function getItems()
        {
            return $this->tree;
        }

        public function getIterator(): Iterator
        {
            return new CollectionIterator($this);
        }

        public function getReverseIterator(): Iterator
        {
            return new CollectionIterator($this, true);
        }
    }

    // Client code
    $collection = [
        'nivel1',
        'nivel2',
        'nivel3',
        'nivel4'
    ];

    $collection = new Collection($collection);
?>

<?php
    include('components/header.php');
?>
    <h1>Iterator</h1>

    <p>Exemplo conceitual: <a href="https://refactoring.guru/design-patterns/iterator/php/example#example-0" target="_blank">https://refactoring.guru/design-patterns/iterator/php/example#example-0</a></p>

    <p>Iterator permite a leitura de uma coleção sem acoplar o código a uma determinada estrutura de dados.</p>

    <p>Como o PHP já oferece já oferece uma interface de iteração, o trabalho é mais simples, basta implementar a interface e adicionar a lógica desejada.</p>

    <p>No exemplo é mostrado como podemos ler uma lista em formato de árvore de forma direta e inversa.</p>

    <h2>Resultado:</h2>
    <ul>
        <li>
            Lendo de forma direta:
            <ul>
                <?php
                    foreach ($collection->getIterator() as $item) {
                        echo '<li>' . $item . '</li>';
                    }
                ?>
            </ul>
        </li>
        <li>
            Lendo de forma inversa:
            <ul>
                <?php
                    foreach ($collection->getReverseIterator() as $item) {
                        echo '<li>' . $item . '</li>';
                    }
                ?>
            </ul>
        </li>
    </ul>
<?php
    include('components/footer.php');
?>