<?php
    // Facade's interface
    interface FileGeneratorFacade
    {
        public function generateFile(string $fileName): string;
    }

    // Facade itself
    class GeneratorFacade implements FileGeneratorFacade
    {
        private $generator;

        public function __construct(FileGenerator $generator)
        {
            $this->generator = $generator;
        }

        public function generateFile(string $fileName): string
        {
            $this->generator->setFileName($fileName);
            return $this->generator->generate();
        }
    }

    // Subsystems used in the facade
    interface FileGenerator
    {
        public function setFileName(string $name);
        public function generate(): string;
    }

    // Concrete class for generating files
    class TextFileGenerator implements FileGenerator
    {
        private $fileName;

        public function setFileName(string $name)
        {
            $this->fileName = $name;
        }

        public function generate(): string
        {
            return 'Generating the text file: ' . $this->fileName;
        }
    }

    class PDFFileGenerator implements FileGenerator
    {
        private $fileName;

        public function setFileName(string $name)
        {
            $this->fileName = $name;
        }

        public function generate(): string
        {
            return 'Generating the PDF file: ' . $this->fileName;
        }
    }

    // Client code
    $textGenerator = new TextFileGenerator();
    $facadeText = new GeneratorFacade($textGenerator);

    $pdfGenerator = new PDFFileGenerator();
    $facadePDF = new GeneratorFacade($pdfGenerator);
?>

<?php
    include('../../components/header.php');
?>
    <h1>Facade</h1>

    <p>Exemplo conceitual: <a href="https://refactoring.guru/design-patterns/facade/php/example#example-0" target="_blank">https://refactoring.guru/design-patterns/facade/php/example#example-0</a></p>

    <p>Facade serve para esconder do cliente a complexidade de determinada operação. O cliente terá acesso apenas à interface, enquanto a facade gerenciará a execução dos subsistemas.</p>

    <p>Nesse exemplo a facade é utilizada para gerar um arquivo sem que o cliente saiba dos detalhes de cada extensão.</p>

    <h2>Resultado:</h2>
    <ul>
        <li>Arquivo texto: <?= $facadeText->generateFile('example-text.txt'); ?></li>
        <li>Arquivo PDF: <?= $facadePDF->generateFile('example-pdf.pdf'); ?></li>
    </ul>
<?php
    include('../../components/footer.php');
?>