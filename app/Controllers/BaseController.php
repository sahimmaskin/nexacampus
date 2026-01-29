<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

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
     * @var list<string>
     */
    protected $helpers = [];
    protected $session;
    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        $this->session = \Config\Services::session();
        $trustModel = new \App\Models\TrustModel();

        // 🔐 If not logged in but remember_token cookie exists
        if (! session()->get('isAdmin') && isset($_COOKIE['remember_token'])) {
            $token = $_COOKIE['remember_token'];

            $trust = $trustModel
                ->where('remember_token', $token)
                ->where('token_expire >=', date('Y-m-d H:i:s'))
                ->first();

            if ($trust) {

                $trustId = $trust['id'];

                if ($trust['status'] == 'Active') {
                    // Auto-login the user
                    session()->set([
                        'isAdmin'   => true,
                        'adminId'   => $trustId,
                        'adminName' => $trust['name'],
                    ]);
                }
            }
        }

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = service('session');
    }
}
