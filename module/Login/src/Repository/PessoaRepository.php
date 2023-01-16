<?php

namespace Login\Repository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Login\Entidade\Pessoa;

class PessoaRepository extends EntityRepository
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create(Pessoa $pessoa)
    {
        $this->entityManager->persist($pessoa);
        $this->entityManager->flush();
    }

    public function read($id)
    {
        return $this->entityManager->find(Pessoa::class, $id);
    }

    public function update(Pessoa $pessoa)
    {
        $this->entityManager->merge($pessoa);
        $this->entityManager->flush();
    }

    public function delete($id)
    {
        $pessoa = $this->read($id);
        $this->entityManager->remove($pessoa);
        $this->entityManager->flush();
    }

    public function findByCredentials($ds_login, $ds_senha)
    {
        $objQuery = $this->entityManager->createQueryBuilder();

        $objQuery->select(
            [
                'p.cd_pessoa',
                'p.ds_login',
                'p.ds_senha'
            ]
        );

        $objQuery->from(
            Pessoa::class,
            'p'
        );

        $objQuery->andWhere(
            $objQuery->expr()->eq('p.ds_login', ':ds_login'),
            $objQuery->expr()->eq('p.ds_senha', ':ds_senha')
        );

        $objQuery->setParameter('ds_login', $ds_login);
        $objQuery->setParameter('ds_senha', $ds_senha);

        $arrDados = $objQuery->getQuery()->getOneOrNullResult();

        return $arrDados;
    }
}