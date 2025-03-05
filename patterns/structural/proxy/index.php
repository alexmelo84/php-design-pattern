<?php
    // Original class interface
    interface OriginalGuzzleInterface
    {
        public function request(string $url): string;
    }

    // Concrete class that proxy will execute
    class CustomGuzzleClass implements OriginalGuzzleInterface
    {
        public function request(string $url): string
        {
            // Simulate a request to $url
            // $response = $this->getResponse($url);
            sleep(rand(1, 3));
            return "Response from $url<br>";
        }
    }

    // Proxy class that will manage the execution of the original class
    class CustomGuzzleProxy implements OriginalGuzzleInterface
    {
        private $guzzle;

        public function __construct(OriginalGuzzleInterface $guzzle)
        {
            $this->guzzle = $guzzle;
        }

        public function request(string $url): string
        {
            $start = microtime(true);
            $response = $this->guzzle->request($url);
            $end = microtime(true);

            $executionTime = $end - $start;

            echo "Request to $url took $executionTime seconds<br>";

            return $response;
        }
    }

    // Client code
    $guzzle = new CustomGuzzleClass();
    $guzzleProxy = new CustomGuzzleProxy($guzzle);
?>

<?php
    include('../../components/header.php');
?>
    <h1>Proxy</h1>

    <p>Exemplo conceitual: <a href="https://refactoring.guru/design-patterns/proxy/php/example#example-0" target="_blank">https://refactoring.guru/design-patterns/proxy/php/example#example-0</a></p>

    <p>Proxy é utilizado como uma camada entre o código cliente e um recurso em situações em que precise executar outras operações além das operações do recurso em si, por exemplo, fazer um log de execuções sem que o código cliente precise se preocupar com isso.</p>

    <p>Para isso funcionar, o proxy precisa implementar a mesma interface que a classe original, assim podendo gerenciar sua execução.</p>

    <p>Nesse exemplo o <i>proxy</i> é usado para gerenciar a execução de chamdas externas, como Curl ou Guzzle, e executar loggar o tempo de execução dessas chamadas externas.</p>

    <h2>Resultado:</h2>
    <ul>
        <li>Executando diretamente: <?php echo $guzzle->request('https://www.google.com'); ?></li>
        <li>Executando via proxy: <?php echo $guzzleProxy->request('https://www.bing.com'); ?></li>
    </ul>
<?php
    include('../../components/footer.php');
?>