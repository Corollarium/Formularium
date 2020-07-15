<?php declare(strict_types=1);

namespace Formularium\Laravel\Commands;

use Formularium\ValidatorFactory;
use Formularium\Exception\Exception;
use Illuminate\Console\Command;

class CommandValidator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'formularium:validator
        {name : The validator name}
        {--namespace= : the class namespace. Defaults to "\\App\\Validators"}
        {--path= : path to save the file. Defaults to "basepath("app\\Validators") }
        {--test-path= : path to save the file. Defaults to "basepath("tests/Unit") }
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates scaffolding using Modelarium';

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
        $code = ValidatorFactory::generate(
            // @phpstan-ignore-next-line
            (string)$this->argument('name'),
            // @phpstan-ignore-next-line
            $this->option('namespace') ? (string)$this->option('namespace') : 'App\\Validators'
        );

        try {
            $retval = ValidatorFactory::generateFile(
                $code,
                $this->option('path') ? $this->option('path') : /** @scrutinizer ignore-call */ base_path('app/Validators'),
                $this->option('test-path') ? $this->option('test-path') : /** @scrutinizer ignore-call */ base_path('tests/Unit/')
            );

            $this->line($retval['code']);
            $this->line($retval['test']);
            $this->info('Finished. You might want to run `composer dump-autoload`');
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
