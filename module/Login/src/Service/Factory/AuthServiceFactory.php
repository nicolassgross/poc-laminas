<?php

namespace Login\Service\Factory;

use Doctrine\ORM\EntityManager;
use Laminas\Http\Request;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Login\Entidade\Pessoa;
use Login\Repository\PessoaRepository;
use Login\Service\AuthService;
use Psr\Container\ContainerInterface;

class AuthServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $em = $container->get(EntityManager::class);
        $objPessoaRepository = $em->getRepository(Pessoa::class);
        return new $requestedName(
            $objPessoaRepository
        );

    }
}
