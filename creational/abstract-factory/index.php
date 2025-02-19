<?php
    // Abstract factory interface
    interface DogFactory {
        public function getSize(): Size;
        public function getBehavior(): Behavior;
    }

    // Concrete factories, each one for a specific breed
    class PinscherFactory implements DogFactory {
        public function getSize(): Size {
            return new PinscherSize();
        }

        public function getBehavior(): Behavior {
            return new PinscherBehavior();
        }
    }

    class BeagleFactory implements DogFactory {
        public function getSize(): Size {
            return new BeagleSize();
        }

        public function getBehavior(): Behavior {
            return new BeagleBehavior();
        }
    }

    class StBernardFactory implements DogFactory {
        public function getSize(): Size {
            return new StBernardSize();
        }

        public function getBehavior(): Behavior {
            return new StBernardBehavior();
        }
    }

    // Every aspect or variant of an object must have its own interface
    interface Size {
        public function getSize(): string;
    }

    class PinscherSize implements Size {
        public function getSize(): string {
            return 'Pequeno';
        }
    }

    class BeagleSize implements Size {
        public function getSize(): string {
            return 'Médio';
        }
    }

    class StBernardSize implements Size {
        public function getSize(): string {
            return 'Grande';
        }
    }

    interface Behavior {
        public function getBehavior(): string;
    }

    class PinscherBehavior implements Behavior {
        public function getBehavior(): string {
            return 'Agressivo';
        }
    }

    class BeagleBehavior implements Behavior {
        public function getBehavior(): string {
            return 'Brincalhão';
        }
    }

    class StBernardBehavior implements Behavior {
        public function getBehavior(): string {
            return 'Calmo';
        }
    }

    // Client code
    class Dog {
        public function getBreedData(DogFactory $factory): array
        {
            $size = $factory->getSize();
            $behavior = $factory->getBehavior();

            return [
                'size' => $size->getSize(),
                'behavior' => $behavior->getBehavior()
            ];
        }
    }

    // When we can instantiate a dog (or any kind of object) and and it'll accept any dog breed factory
    $dog = new Dog();
    $pinscher = $dog->getBreedData(new PinscherFactory());
    $beagle = $dog->getBreedData(new BeagleFactory());
    $stBernard = $dog->getBreedData(new StBernardFactory());
?>

<?php
    include('../../components/header.php');
?>
    <h1>Abstract factory</h1>

    <p>Exemplo conceitual: <a href="https://refactoring.guru/design-patterns/abstract-factory/php/example#example-1" target="_blank">https://refactoring.guru/design-patterns/abstract-factory/php/example#example-1</a></p>

    <p>Neste exemplo vemos a utilização de uma factory abstrata para a criação de objetos com atributos específicos. No caso são diferentes raças de cachorro com suas respectivas propriedades.</p>

    <h2>Pinscher</h2>
    <p>Tamanho: <?= $pinscher['size'] ?></p>
    <p>Comportamento: <?= $pinscher['behavior'] ?></p>

    <h2>Beagle</h2>
    <p>Tamanho: <?= $beagle['size'] ?></p>
    <p>Comportamento: <?= $beagle['behavior'] ?></p>

    <h2>St. Bernard</h2>
    <p>Tamanho: <?= $stBernard['size'] ?></p>
    <p>Comportamento: <?= $stBernard['behavior'] ?></p>
<?php
    include('../../components/footer.php');
?>