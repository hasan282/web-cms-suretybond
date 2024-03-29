<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use Config\Services;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['cookie', 'hash', 'format', 'user'];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    protected $session, $plugin;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        $this->session = Services::session();
        $this->plugin  = Services::plugins();

        $this->plugin->set(['basic', 'fontawesome']);
    }

    /**
     * call a codeigniter view with some modify
     */
    protected function view(string $view, array $data = []): string
    {
        $data['darkmode'] = intval(get_cookie('DRKMOD') ?? '0') === 1;
        $data['toast']    = $this->session->getFlashdata('toast') ?? [];
        $data['plugins']  = $this->plugin->get();

        $viewscript = view($view, $data);
        return env_is('production') ? space_replace($viewscript) : $viewscript;
    }

    protected function login()
    {
        $gets = $this->request->getGet();
        $uri  = uri_string();
        if (!empty($gets))
            $uri = $uri . '?' . http_build_query($gets);
        $this->session->setFlashdata('requesturl', $uri);
        return redirect()->to('');
    }

    protected function unlock()
    {
        $this->session->setFlashdata('destination', uri_string());
        return redirect()->to('account/verification');
    }
}
