<?php

namespace Login\Repository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Login\Entidade\Pessoa;

class PessoaRepository extends EntityRepository
{
    private $objPessoaRepository;
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->objPessoaRepository = $entityManager->getRepository(Pessoa::class);
        $this->entityManager = $entityManager;
    }

    public function insert(Pessoa $pessoa)
    {
        $this->entityManager->persist($pessoa);
        $this->entityManager->flush();

        return true;
    }

    public function update(
        int $id,
        array $arrDadosAtualizados
    )
    {
        $user = $this->objPessoaRepository->find($id);

        if(empty($user)) {
            return false;
        }

        //vai percorrer o array que contém os novos dados a serem atualizados, verificar o valor, criar o setter com base nas chaves do array
        //e se o método existir na entidade Pessoa, irá setar o dado, caso contrário não irá alterar outros campos do registro.
        foreach($arrDadosAtualizados as $key => $value) {
            if(!empty($value)) {
                $setter = 'set' . ucfirst($key);
                if (method_exists($user, $setter)) {
                    $user->{$setter}($value);
                }
            }
        }
        
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return true;
    }

    public function delete(int $id)
    {
        $user = $this->objPessoaRepository->find($id);

        if(empty($user)) {
            return false;
        } 

        $this->entityManager->remove($user);
        $this->entityManager->flush();

        return true;
    }

    public function listUser(int $id = null)
    {
        if(empty($id)) {
            return $this->objPessoaRepository->findAll();
        }

        return array($this->objPessoaRepository->find($id));
    }
}