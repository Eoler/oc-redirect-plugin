<?php

declare(strict_types=1);

namespace Vdlp\Redirect\Controllers;

use Backend\Behaviors\FormController;
use Backend\Behaviors\ListController;
use Backend\Classes\Controller;
use BackendMenu;

/** @noinspection ClassOverridesFieldOfSuperClassInspection */

/**
 * Class Categories
 *
 * @package Vdlp\Redirect\Controllers
 * @mixin FormController
 * @mixin ListController
 */
class Categories extends Controller
{
    /**
     * {@inheritdoc}
     */
    public $implement = [
        FormController::class,
        ListController::class
    ];

    /**
     * @var string
     */
    public $formConfig = 'config_form.yaml';

    /**
     * @var string
     */
    public $listConfig = 'config_list.yaml';

    /**
     * {@inheritdoc}
     */
    public $requiredPermissions = ['vdlp.redirect.access_redirects'];

    /**
     * {@inheritdoc}
     */
    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Vdlp.Redirect', 'redirect', 'categories');
    }
}
