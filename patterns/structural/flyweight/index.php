<?php
    /** 
     * Flyweight class. Its function is to store all shared data.
     * In this case it would store bank data to avoid multiple instances of the same bank or unnecessary
     * database querying for the same bank.
     */
    class BankFlyweight
    {
        private array $bankData;

        public function __construct(array $banData)
        {
            $this->bankData = $banData;
        }

        public function transaction(array $uniqueState): void
        {
            $s = json_encode($this->bankData);
            $u = json_encode($uniqueState);
            echo "Flyweight: Displaying shared ($s) and unique ($u) state.\n";
        }
    }

    /**
     * Bank flyweight factory. It manages flyweight objects and creates them if they do not exist.
     */
    class BankFlyweightFactory
    {
        private array $banks = [];

        public function __construct(array $initialBanks)
        {
            foreach ($initialBanks as $state) {
                $this->banks[$this->getKey($state)] = new BankFlyweight($state);
            }
        }

        private function getKey(array $state): string
        {
            ksort($state);

            return implode("_", $state);
        }

        public function getBank(array $sharedState): BankFlyweight
        {
            $key = $this->getKey($sharedState);

            if (!isset($this->banks[$key])) {
                echo "FlyweightFactory: Can't find a flyweight, creating new one.\n";
                $this->banks[$key] = new BankFlyweight($sharedState);
            } else {
                echo "FlyweightFactory: Reusing existing flyweight.\n";
            }

            return $this->banks[$key];
        }

        public function listBanks(): string
        {
            $count = count($this->banks);
            $return = "FlyweightFactory: I have $count flyweights:<br>";
            foreach ($this->banks as $key => $bank) {
                $return .= $key . "<br>";
            }

            return $return;
        }
    }

    /**
     * Flyweights creation.
     * It could be created in the app initialization or in the runtime.
     */
    $factory = new BankFlyweightFactory([
        ["Banco do Brasil", "001", "0001"],
        ["Bradesco", "237", "0002"],
        ["Itaú", "341", "0003"],
    ]);
?>

<?php
    include('../../components/header.php');
?>
    <h1>Flyweight</h1>

    <p>Exemplo conceitual: <a href="https://refactoring.guru/design-patterns/flyweight/php/example#example-0" target="_blank">https://refactoring.guru/design-patterns/flyweight/php/example#example-0</a></p>

    <p>Sua função é compartilhar partes comuns de um estado para múltiplos objetos. Esse conceito não é muito comum em PHP porque o código não fica todo disponível em memória como em linguagens compiladas.</p>

    <p>Nesse exemplo é utilizada transação bancária para mostrar a utilização do <i>flyweight</i>.</p>

    <h2>Resultado:</h2>
    <ul>
        <li>
            Estado inicial do flyweight:
            <br>
            <?= $factory->listBanks(); ?>
        </li>
        <li>
            Ao fazermos uma transação em um banco que já está em meória, ele reutiliza o objeto:
            <br>
            <?php
                $bank = $factory->getBank(["Banco do Brasil", "001", "0001"]);
                $bank->transaction(["João", "R$ 100,00"]);
            ?>
        </li>
        <li>
            Se fizermos uma transação em um banco que não está em meória, ele cria um novo objeto:
            <br>
            <?php
                $bank = $factory->getBank(["Santander", "033", "0004"]);
                $bank->transaction(["Maria", "R$ 200,00"]);
            ?>
        </li>
    </ul>
<?php
    include('../../components/footer.php');
?>