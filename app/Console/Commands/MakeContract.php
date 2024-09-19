<?php

namespace App\Console\Commands;

use App\Helpers\Helper;
use App\Traits\NameSpaceFixer;
use Illuminate\Support\Facades\File;
use Illuminate\Console\Command;

class MakeContract extends Command
{
    use NameSpaceFixer;

    protected $basePathService = 'App\Http\Services\Repositories\Contracts';
    protected $basePathRepository = 'App\Http\Services\Repositories';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:contract {contract : The name of the contract}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Contract service and repository';

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
     * @return int
     */
    public function handle()
    {
        $contractName = $this->argument('contract');

        if ($contractName === '' || is_null($contractName) || empty($contractName)) {
            $this->error('Name Invalid..!');
        }

        $this->createContract($contractName);
        $this->createRepository($contractName);
    }

    /**
     * create Service Contract
     */
    public function createContract($contractName)
    {
        $contractName = $contractName . "Contract";
        // create if folder Contracts not exists 
        if (!File::exists($this->getBaseDirectory($this->basePathService, $contractName))) {
            File::makeDirectory($this->getBaseDirectory($this->basePathService, $contractName), 0777, true);
        }

        $title = Helper::title($contractName);

        $eloquentFileName = 'app/Http/Services/Repositories/Contracts/' . $title . '.php';

        if (!File::exists($eloquentFileName)) {
            $eloquentFileContent = "<?php\n\nnamespace " . $this->basePathService
                . ";\n"
                . "\nuse Illuminate\Database\Eloquent\Collection;"
                . "\n\n"
                . "interface " . $contractName
                . "\n{\n"

                . "\t/**"
                . "\n\t * params string \$search"
                . "\n\t * @return Collection"
                . "\n\t*/"

                . "\n\n"
                . "\tpublic function paginated(array \$request);\n}";

            File::put($eloquentFileName, $eloquentFileContent);

            $this->info('Service Contract Created Successfully.');
        } else {
            $this->error('Service Contract Files Already Exists.');
        }
    }


    /**
     * create Repository Contract
     */
    public function createRepository($repoName)
    {
        $repoName = $repoName . "Repository";
        // create if folder Contracts not exists 
        if (!File::exists($this->getBaseDirectory($this->basePathRepository, $repoName))) {
            File::makeDirectory($this->getBaseDirectory($this->basePathRepository, $repoName), 0777, true);
        }

        $title = Helper::title($repoName);

        $nameModel = str_replace('Repository', '', $repoName);
        $eloquentFileName = 'app/Http/Services/Repositories/' . $title . '.php';
        $nameContract = str_replace('Repository', 'Contract', $repoName);

        if (!File::exists($eloquentFileName)) {
            $eloquentFileContent = "<?php\n\nnamespace " . $this->basePathRepository
                . ";\n"
                . "\nuse App\Http\Services\Repositories\BaseRepository;"
                . "\nuse App\Http\Services\Repositories\Contracts\\" . $nameContract
                . ";\nuse App\Models\\" . $nameModel

                . ";\n\nclass " . $repoName . " extends BaseRepository implements " . $nameContract
                . "\n{\n"

                . "\t/**"
                . "\n\t * @var"
                . "\n\t */\n"

                . "\tprotected \$model;\n\n"
                . "\tpublic function __construct(" . $nameModel . " \$model)\n"
                . "\t{\n"
                . "\t\t\$this->model = \$model;\n"
                . "\t}\n\n"

                . "\tpublic function paginated(array \$criteria)"
                . "\n\t{\n"
                . "\t\t\$perPage = \$criteria['per_page'] ?? 5;\n"
                . "\t\t\$field = \$criteria['sort_field'] ?? 'id';\n"
                . "\t\t\$sortOrder = \$criteria['sort_order'] ?? 'desc';\n"
                . "\t\t"
                . "return \$this->model->orderBy(\$field, \$sortOrder)->paginate(\$perPage);"
                . "\n\t}\n"
                . "\n}";


            File::put($eloquentFileName, $eloquentFileContent);

            $this->info('Repository Created Successfully.');
        } else {
            $this->error('Repository Files Already Exists.');
        }
    }
}
