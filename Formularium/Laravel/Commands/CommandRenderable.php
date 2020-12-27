<?php declare(strict_types=1);

namespace Formularium\Laravel\Commands;

use Formularium\Exception\Exception;
use Formularium\Factory\DatatypeFactory;
use Formularium\Factory\FrameworkFactory;
use Formularium\Factory\RenderableFactory;
use Formularium\Frontend\Blade\Framework;
use FormulariumTests\DatatypeTest;
use Illuminate\Console\Command;

class CommandRenderable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'formularium:renderable
        {name : The datatype name}
        {--framework=* : The frameworks to use. You can use this options several times. Use "*" for all.}
        {--namespace=Formularium\\Frontend : base namespace. Defaults to Formularium\\Frontend }
        {--path= : path to save the file. Defaults to base_path("app/Frontend") }
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates renderable scaffolding';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $frameworkNames = $this->option('framework');
        if (is_string($frameworkNames)) {
            $frameworkNames = [$frameworkNames];
        }
        /**
         * @var array $frameworkNames
         */
        if (in_array('*', $frameworkNames)) {
            $frameworks = FrameworkFactory::factoryAll();
        } else {
            $frameworks = array_map(
                [FrameworkFactory::class, 'factory'],
                $frameworkNames
            );
        }

        $name = $this->argument('name');
        if (!is_string($name)) {
            $this->error('Name must be a string');
            return;
        }
        $datatype = DatatypeFactory::factory($name);
        $datatypeLower = mb_strtolower($datatype->getName());
        $baseNamespace = $this->option('namespace');
        if (!is_string($baseNamespace)) {
            $this->error('namespace must be a string');
            return;
        }

        $basePath = $this->option('path');
        if (!is_string($basePath)) {
            $this->error('path must be a string');
            return;
        }

        $printer = new \Nette\PhpGenerator\PsrPrinter();

        foreach ($frameworks as $framework) {
            /**
             * @var Framework $framework
             */
            $phpns = $framework->generateRenderable($datatype, $baseNamespace);
            $code = "<?php declare(strict_types=1);\n" . $printer->printNamespace($phpns);
            $basepath = $basePath . '/' . $framework->getName() . '/Renderable/';
            if (!is_dir($basepath)) {
                \Safe\mkdir($basepath, 0777, true);
            }
    
            $filename = $basepath . 'Renderable_' . $datatypeLower . '.php';
            if (!file_exists($filename)) {
                $this->info("Created renderable at {$filename}.");
                file_put_contents($filename, $code);
            } else {
                $this->warn("Filename $filename already exists.");
            }
        }
    }
}
