<?php
use App\Api;
use Viewi\Routing\Route as ViewiRoute;

ViewiRoute::add('get', '/api/v1/plugins', [Api::class, 'plugins']);
ViewiRoute::add('get', '/api/v1/plugins/{id}/catalog', [Api::class, 'catalog']);
ViewiRoute::add('get', '/api/v1/plugins/{pluginId}/manga/{mangaId}', [Api::class, 'manga']);
ViewiRoute::add('get', '/api/v1/plugins/{pluginId}/manga/{mangaId}/chapters', [Api::class, 'chapters']);
ViewiRoute::add('get', '/api/v1/plugins/{pluginId}/manga/{mangaId}/chapter/{chapterId}', [Api::class, 'pages']);
