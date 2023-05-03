<?php

use App\Api;
use Components\Views\Home\HomePage;
use Components\Views\NotFound\NotFoundPage;
use Components\Views\Catalog\CatalogPage;
use Components\Views\Chapter\ChapterPage;
use Components\Views\Manga\MangaPage;
use Viewi\Routing\Route as ViewiRoute;

# -- FRONTEND -- #
ViewiRoute::get('/', HomePage::class);
ViewiRoute::get('/catalog', CatalogPage::class);
ViewiRoute::get('/plugins/{pluginId}/manga/{mangaId}', MangaPage::class);
ViewiRoute::get('/plugins/{pluginId}/manga/{mangaId}/chapter/{chapterId}', ChapterPage::class);

# -- API -- #
ViewiRoute::add('get', '/api/plugins', [Api::class, 'plugins']);
ViewiRoute::add('get', '/api/plugins/{id}/catalog', [Api::class, 'catalog']);
ViewiRoute::add('get', '/api/plugins/{pluginId}/manga/{mangaId}', [Api::class, 'manga']);
ViewiRoute::add('get', '/api/plugins/{pluginId}/manga/{mangaId}/chapters', [Api::class, 'chapters']);
ViewiRoute::add('get', '/api/plugins/{pluginId}/manga/{mangaId}/chapter/{chapterId}', [Api::class, 'pages']);

# -- MISC -- #
ViewiRoute::get('*', NotFoundPage::class);
