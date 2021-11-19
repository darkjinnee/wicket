<?php

namespace Darkjinnee\Wicket\Http\Controllers;

use App\Http\Controllers\Controller;
use Darkjinnee\Wicket\Wicket;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;

/**
 * Class BaseController
 * @package Darkjinnee\Wicket\Http\Controllers
 */
class BaseController extends Controller
{
    /**
     * @var Repository|Application|mixed
     */
    protected $fields;

    /**
     * @var Repository|Application|mixed
     */
    protected $classes;

    /**
     * @var array
     */
    protected $agent;

    /**
     * BaseController constructor.
     */
    public function __construct()
    {
        $this->fields = config('wicket.auth_fields');
        $this->classes = config('wicket.classes');
        $this->agent = Wicket::agent();
    }
}
