<?php

$router = new Router();

$router->get('/test', function() {
    return 'Router get';
});

$router->post('/test', function() {
    return 'Router post';
});