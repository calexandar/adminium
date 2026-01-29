<?php

declare(strict_types=1);

namespace Admin\Dashboard;


use Admin\Pages\Page;
use Illuminate\View\View;
use Admin\Articles\Article;
use Admin\Products\Product;
use Admin\UserManagment\User;
use Admin\Categories\Category;
use Admin\News\News;

final readonly class DashboardController
{
    public function __invoke(): View
    {
        return view('dashboard::index', [
            'pagesCount' => Page::count(),
            'articlesCount' => Article::count(),
            'productsCount' => Product::count(),
            'usersCount' => User::count(),
            'categoriesCount' => Category::count(),
            'newsCount' => News::count(),

            'lastPublishedArticle' => Article::whereNotNull('published')
                ->orderBy('updated_at', 'desc')
                ->first(),
        ]);
    }
}
