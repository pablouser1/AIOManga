<?php

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
# v1
require __DIR__ . '/v1.php';

# -- MISC -- #
ViewiRoute::get('*', NotFoundPage::class);
