<?php

namespace App\Http\Controllers\Admin;

use App\Traits\AdminParameters;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;

class BaseController extends Controller
{
    use AuthorizesRequests, ValidatesRequests, AdminParameters;
    protected $response = [];
    
    public function __construct()
    {
        $this->middleware("can:$this->entity view")->only('index');
        $this->middleware("can:$this->entity create")->only('create','store');
        $this->middleware("can:$this->entity update")->only('update','edit');
        $this->middleware("can:$this->entity delete")->only('destroy');

        $this->response['entity'] = $this->entity;
    }

    protected function clearCache () {
        // Clear specific cache keys or the entire cache
        Cache::forget('roles-list'); // Clear specific cache key
        Cache::flush(); // Clear the entire cache

        // Or using Artisan command
        Artisan::call('cache:clear');
    }
}
