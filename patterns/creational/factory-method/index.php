<?php
    /**
     * In this example we have a factory method that creates connections to different types of integrations.
     * The client code instantiates one concrete creator and then this creator will make the respective connection.
     * Since every API has its own connection method, it isolates the connection logic for every connection.
    */

    // This the creator, an abstract class
    abstract class ConnectionFactory {
        abstract public function connect();

        public function getRequest(string $url)
        {
            $this->connect();
            
            echo 'Get data from ' . $url;
        }

        public function postRequest(string $url, array $data)
        {
            $this->connect();
            
            echo 'Post data to ' . $url;
            echo '<br>';
            echo 'Data: ' . json_encode($data);
        }
    }

    // These are the concrete creators
    class IntegrationOne extends ConnectionFactory {
        public function connect()
        {
            return new ConnectionOne();
        }
    }

    class IntegrationTwo extends ConnectionFactory {
        public function connect()
        {
            return new ConnectionTwo();
        }
    }

    class IntegrationThree extends ConnectionFactory {
        public function connect()
        {
            return new ConnectionThree();
        }
    }

    // Product interface to set the behaviors
    interface Connection {
        public function connect();
    }

    // Concrete products
    class ConnectionOne implements Connection {
        public function connect()
        {
            echo "Connecting to Connection One";
        }
    }

    class ConnectionTwo implements Connection {
        public function connect()
        {
            echo "Connecting to Connection Two";
        }
    }

    class ConnectionThree implements Connection {
        public function connect()
        {
            echo "Connecting to Connection Three";
        }
    }

    // Client code
    $integrationOne = new IntegrationOne();
    $integrationTwo = new IntegrationTwo();
    $integrationThree = new IntegrationThree();
?>

<?php
    include('../../components/header.php');
?>
    <h1>Factory Method</h1>

    <p>Exemplo conceitual: <a href="https://refactoring.guru/design-patterns/factory-method/php/example#example-1" target="_blank">https://refactoring.guru/design-patterns/factory-method/php/example#example-1</a></p>

    <p>Neste exemplo vemos a utilização de uma factory para gerenciar diferentes formas de conexão, numa situação em que um sistema precise ter conexões para vários sistemas externos, isso acaba isolando a lógica de conexão para cada integração.</p>

    <h2>Integração Um</h2>
    <ul>
        <li>Requisição GET: </li><?= $integrationOne->getRequest('URL to get in integration 1'); ?>
        <li>Requisição POST: </li><?= $integrationOne->postRequest('URL to post in integration 1', ['field1' => 'value1']); ?>
    </ul>

    <h2>Integração Dois</h2>
    <ul>
        <li>Requisição GET: </li><?= $integrationTwo->getRequest('URL to get in integration 2'); ?>
        <li>Requisição POST: </li><?= $integrationTwo->postRequest('URL to post in integration 2', ['field2' => 'value2']); ?>
    </ul>

    <h2>Integração Três</h2>
    <ul>
        <li>Requisição GET: </li><?= $integrationThree->getRequest('URL to get in integration 3'); ?>
        <li>Requisição POST: </li><?= $integrationThree->postRequest('URL to post in integration 3', ['field3' => 'value3']); ?>
    </ul>
<?php
    include('../../components/footer.php');
?>