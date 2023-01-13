<?php

declare(strict_types=1);

namespace Login\Controller;

use Doctrine\ORM\EntityManager;
use Laminas\Authentication\AuthenticationService;
use Laminas\Authentication\Result;
use Laminas\Http\Request;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Login\Entidade\Pessoa;
use Login\Repository\PessoaRepository;

class IndexController extends AbstractActionController
{
    public function loginAction()
    {
        $this->layout()->setTemplate('login/index');
        return $this;
    }

    public function authAction()
    {
        $ds_login = $this->params()->fromQuery('ds_login');
        $ds_senha = $this->params()->fromQuery('ds_senha');

        // Attempt authentication, saving the result:
        $result = $this->authenticate($ds_login, $ds_senha);

        if (!$result->isValid()) {
            // Authentication failed; print the reasons why:
            foreach ($result->getMessages() as $message) {
                echo "$message\n";
            }
        } else {
            // Authentication succeeded; the identity ($username) is stored
            // in the session:
            // $result->getIdentity() === $auth->getIdentity()
            $result->getIdentity() === $ds_login;
        }
    }

    public function authenticate(
        string $ds_login,
        string $ds_senha
    )
    {
        $user = $this->getUserByUsername(1);

        if ($user->getDsLogin() == $ds_login && $user->getDsSenha() == $ds_senha) {
            return new Result(Result::SUCCESS, $user->getId(), ['Authenticated successfully.']);
        }

        return new Result(Result::FAILURE_CREDENTIAL_INVALID, null, ['Invalid credentials.']);
    }

    // public function logoutAction()
    // {
    //     $auth = new AuthenticationService();
    //     $auth->clearIdentity();
    //     return $this->redirect()->toRoute('login');
    // }

    public function getUserByUsername()
    {

        return $objPessoaRepository;
    }

    public function getObjEntityManager()
    {
        return $this->getServiceManager()
            ->get(EntityManager::class);
    }

    public function getServiceManager()
    {
        return $this->getEvent()
            ->getApplication()
            ->getServiceManager();
    }
}
