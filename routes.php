<?php
$router = app(\Illuminate\Routing\Router::class);

$router->get('/auth/2fareg', \Lshtmweb\Lumen2FA\TwoFactorController::class . '@show2FARegistrationInfo');
$router->post('/auth/2fareg', \Lshtmweb\Lumen2FA\TwoFactorController::class . '@activate2FA');
$router->put('/auth/2fareg', \Lshtmweb\Lumen2FA\TwoFactorController::class . '@disable2FA');
$router->post('/auth/2faverify', \Lshtmweb\Lumen2FA\TwoFactorController::class . '@verify2FA');
$router->post('/auth/2fadisable', \Lshtmweb\Lumen2FA\TwoFactorController::class . '@disableUser2FA');