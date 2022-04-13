<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Repositories\NewsRepository;
use App\Services\NewsParser;
use Illuminate\Console\Command;

class ScrapNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'scrap news';

    private NewsParser $newsParser;

    private NewsRepository $newsRepository;

    public function __construct(
        NewsParser     $newsParser,
        NewsRepository $newsRepository
    )
    {
        $this->newsParser     = $newsParser;
        $this->newsRepository = $newsRepository;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        foreach ($this->newsParser->parse() as $post) {
            $this->newsRepository->save(
                $this->newsRepository->getByExternalIdOrNew($post['external_id'], $post)
            );
        }

        return 0;
    }
}
