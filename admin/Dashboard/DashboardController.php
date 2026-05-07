<?php

declare(strict_types=1);

namespace Admin\Dashboard;

use Admin\Articles\Article;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

final readonly class DashboardController
{
    public function __invoke(): View
    {

        $stats = DB::selectOne('
    SELECT
        (SELECT COUNT(*) FROM pages) AS pagesCount,
        (SELECT COUNT(*) FROM articles) AS articlesCount,
        (SELECT COUNT(*) FROM products) AS productsCount,
        (SELECT COUNT(*) FROM users) AS usersCount,
        (SELECT COUNT(*) FROM categories) AS categoriesCount,
        (SELECT COUNT(*) FROM news) AS newsCount
');

        return view('dashboard::index', [
            'pagesCount' => $stats->pagesCount,
            'articlesCount' => $stats->articlesCount,
            'productsCount' => $stats->productsCount,
            'usersCount' => $stats->usersCount,
            'categoriesCount' => $stats->categoriesCount,
            'newsCount' => $stats->newsCount,

            'lastPublishedArticle' => Article::query()
                ->whereNotNull('published')
                ->latest('updated_at')
                ->select(['id', 'published'])
                ->first(),

        ]);
    }
}
