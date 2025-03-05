<?php
    // Interface to set the chain of responsibility
    interface BuyMarketHandler
    {
        public function setNext(BuyMarketHandler $handler): BuyMarketHandler;

        public function handle(string $request): ?string;
    }

    // Abstract class to implement the chain of responsibility
    abstract class AbstractBuyMarketHandler implements BuyMarketHandler
    {
        private BuyMarketHandler $nextHandler;

        public function setNext(BuyMarketHandler $handler): BuyMarketHandler
        {
            $this->nextHandler = $handler;

            return $handler;
        }

        public function handle(string $request): ?string
        {
            if ($this->nextHandler) {
                return $this->nextHandler->handle($request);
            }

            return null;
        }
    }

    // Concrete handlers
    class RiceHandler extends AbstractBuyMarketHandler
    {
        public function handle(string $request): ?string
        {
            if ($request === 'rice') {
                return 'Rice';
            } else {
                return parent::handle($request);
            }
        }
    }

    class BeansHandler extends AbstractBuyMarketHandler
    {
        public function handle(string $request): ?string
        {
            if ($request === 'beans') {
                return 'Beans';
            } else {
                return parent::handle($request);
            }
        }
    }

    class ToiletPaperHandler extends AbstractBuyMarketHandler
    {
        public function handle(string $request): ?string
        {
            if ($request === 'toilet paper') {
                return 'Toilet Paper';
            } else {
                return parent::handle($request);
            }
        }
    }

    class SoapHandler extends AbstractBuyMarketHandler
    {
        public function handle(string $request): ?string
        {
            if ($request === 'soap') {
                return 'Soap';
            } else {
                return parent::handle($request);
            }
        }
    }

    class BreadHandler extends AbstractBuyMarketHandler
    {
        public function handle(string $request): ?string
        {
            if ($request === 'bread') {
                return 'Bread';
            } else {
                return parent::handle($request);
            }
        }
    }

    // Client code
    $completeList = [
        'rice',
        'beans',
        'toilet paper',
        'soap',
        'bread',
    ];
    $onlyFoodList = [
        'rice',
        'beans',
        'bread',
    ];
    $onlyHygieneList = [
        'toilet paper',
        'soap',
    ];
    $partialList = [
        'rice',
        'toilet paper',
        'bread',
    ];

    $riceHandler = new RiceHandler();
    $beansHandler = new BeansHandler();
    $toiletPaperHandler = new ToiletPaperHandler();
    $soapHandler = new SoapHandler();
    $breadHandler = new BreadHandler();

    // Buildiing chains
    $riceHandler->setNext($beansHandler)->setNext($toiletPaperHandler)->setNext($soapHandler)->setNext($breadHandler);
?>

<?php
    include('components/header.php');
?>
    <h1>Chain of Responsability</h1>

    <p>Exemplo conceitual: <a href="https://refactoring.guru/design-patterns/chain-of-responsibility/php/example#example-0" target="_blank">https://refactoring.guru/design-patterns/chain-of-responsibility/php/example#example-0</a></p>

    <p>Chain of Responsability serve para configurar uma sequência de execução, de forma encadeada e contínua.</p>

    <p>Exemplo de lista de compras organizada pela ordem que os produtos são encontrados em determinado mercado.</p>

    <h2>Resultado:</h2>
    <ul>
        <li>
            Compra completa:
            <?php
                foreach ($completeList as $item) {
                    echo $riceHandler->handle($item) . ' | ';
                }
            ?>
        </li>
        <li>
            Somente alimentos:
            <?php
                foreach ($onlyFoodList as $item) {
                    echo $riceHandler->handle($item) . ' | ';
                }
            ?>
        </li>
        <li>
            Somente higiene:
            <?php
                foreach ($onlyHygieneList as $item) {
                    echo $riceHandler->handle($item) . ' | ';
                }
            ?>
        </li>
        <li>
            Lista parcial:
            <?php
                foreach ($partialList as $item) {
                    echo $riceHandler->handle($item) . ' | ';
                }
            ?>
        </li>
    </ul>
<?php
    include('components/footer.php');
?>