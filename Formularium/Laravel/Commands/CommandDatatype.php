<?php declare(strict_types=1);

namespace Formularium\Laravel\Console\Commands;

use Formularium\Datatype;
use Formularium\Exception\Exception;
use Illuminate\Console\Command;

class CommandDatatype extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'formularium:datatype
        {name : The datatype name}
        {--basetype= : the basetype it inherits from ("string"), if there is one.}
        {--namespace= : the class namespace. Defaults to "\\App\\Datatypes"}
        {--path= : path to save the file. Defaults to "basepath("app\\Datatypes") }
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
        $code = Datatype::generate(
            // @phpstan-ignore-next-line
            (string)$this->option('datatype'),
            // @phpstan-ignore-next-line
            (string)$this->option('basetype'),
            // @phpstan-ignore-next-line
            $this->option('namespace') ? (string)$this->option('namespace') : 'App\\Datatypes'
        );

        try {
            $retval = Datatype::generateFile(
                $code,
                // @phpstan-ignore-next-line
                $this->option('path') ? (string)$this->option('path') : base_path('app/Datatypes')
            );

            $this->line($retval['code']);
            $this->line($retval['test']);
            $this->info('Finished. You might want to run `composer dump-autoload`');
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
