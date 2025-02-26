<?php
    // Interface for concrete components
    interface MusicInterface
    {
        public function addInstrument(string $instrument);
        public function generate();
    }

    // Concrete component. It contains the original object, without any attached bahavior
    class Music implements MusicInterface
    {
        private array $instruments = [];

        public function addInstrument(string $instrument)
        {
            $this->instruments[] = $instrument;
        }

        public function generate()
        {
            if (empty($this->instruments)) {
                $this->addInstrument('vocal');
            }

            return 'Generating the music with following instruments: ' . implode(', ', $this->instruments);
        }
    }

    /**
     * Base decorator. His living reason is to implement infrastructure for concrete decorators and delegate the action
     * (in this case the action is adding an instrument) to the subclasses.
     */
    class MusicDecorator implements MusicInterface
    {
        protected MusicInterface $music;

        public function __construct(MusicInterface $music)
        {
            $this->music = $music;
        }

        public function addInstrument(string $instrument)
        {
            $this->music->addInstrument($instrument);
        }

        public function generate()
        {
            return $this->music->generate();
        }
    }

    // Concrete decorators
    class VocalDecorator extends MusicDecorator
    {
        public function addVocal()
        {
            $this->addInstrument('vocal');
        }
    }

    class GuitarDecorator extends MusicDecorator
    {
        public function addGuitar()
        {
            $this->addInstrument('guitar');
        }
    }

    class BassDecorator extends MusicDecorator
    {
        public function addBass()
        {
            $this->addInstrument('bass');
        }
    }

    class DrumsDecorator extends MusicDecorator
    {
        public function addDrums()
        {
            $this->addInstrument('drums');
        }
    }

    class FluteDecorator extends MusicDecorator
    {
        public function addFlute()
        {
            $this->addInstrument('flute');
        }
    }

    // Client code
    $vocal = new Music();

    $duo = new Music();
    $vocalDuo = new VocalDecorator($duo);
    $vocalDuo->addVocal();
    $guitar = new GuitarDecorator($duo);
    $guitar->addGuitar();

    $complete = new Music();
    $vocalComplete = new VocalDecorator($complete);
    $vocalComplete->addVocal();
    $guitarComplete = new GuitarDecorator($complete);
    $guitarComplete->addGuitar();
    $bass = new BassDecorator($complete);
    $bass->addBass();
    $drums = new DrumsDecorator($complete);
    $drums->addDrums();
    $flute = new FluteDecorator($complete);
    $flute->addFlute();
?>

<?php
    include('../../components/header.php');
?>
    <h1>Decorator</h1>

    <p>Exemplo conceitual: <a href="https://refactoring.guru/design-patterns/decorator/php/example#example-1" target="_blank">https://refactoring.guru/design-patterns/decorator/php/example#example-1</a></p>

    <p>Decorator é uma padrão de projeto que adiciona comportamentos a um objeto utilizando um <i>wrapper</i>.</p>

    <p>Nesse exemplo usamos os decorators para montar grupos musicais de diferents combinações.</p>

    <h2>Resultado:</h2>
    <ul>
        <li>Apenas vocal: <?= $vocal->generate(); ?></li>
        <li>Vocal e guitarra: <?= $duo->generate(); ?></li>
        <li>Grupo completo: <?= $complete->generate(); ?></li>
    </ul>
<?php
    include('../../components/footer.php');
?>