<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Psr\Http\Message\UriInterface;
use Spatie\Sitemap\SitemapGenerator;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Genarate sitemap';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        SitemapGenerator::create(config('app.url'))
            ->shouldCrawl(function (UriInterface $url) {
                // ignore images
                if (str_contains($url->getPath(), '/images/'))
                    return false;

                // ignore pages with query params (like pagination)
                if (!empty($url->getQuery()))
                    return false;

                return true;
            })
            ->writeToFile(public_path('sitemap.xml'));
    }
}
