<?php

use App\Api;
use Components\Views\Home\HomePage;
use Components\Views\NotFound\NotFoundPage;
use Components\Views\Search\SearchPage;
use Viewi\Routing\Route as ViewiRoute;

ViewiRoute::get('/', HomePage::class);
ViewiRoute::get('/search', SearchPage::class);
ViewiRoute::add('get', '/api/plugins', [Api::class, 'plugins']);
ViewiRoute::add('get', '/api/plugins/{id}/search', [Api::class, 'search']);
ViewiRoute::get('*', NotFoundPage::class);
