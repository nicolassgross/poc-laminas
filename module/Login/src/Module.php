<?php

declare(strict_types=1);

namespace Login;

use Laminas\ModuleManager\Feature\ConfigProviderInterface;
use Laminas\ModuleManager\Feature\ControllerProviderInterface;
use Laminas\ModuleManager\Feature\ServiceProviderInterface;
use Login\Controller\LoginController;
use Login\Service\AuthService;
use Login\Service\Factory\AuthServiceFactory;

class Module implements ConfigProviderInterface
{
    public function getConfig(): array
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
