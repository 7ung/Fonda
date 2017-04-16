<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
//            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        //
        'auth_user' => \App\Http\Middleware\VerifyUserToken::class,
        'auth_token' => \App\Http\Middleware\VerifyToken::class,
        /**
         * Check input format
         */
        'validate_input' => \App\Http\Middleware\ResourcesMiddleware\ValidateInputFormat::class,

        // Resource Middleware
        /**
         * location_res => Assert can found location and parse location object to lower layer
         *
         * Must sure have USER from higher layer
         */
        'location_res' => \App\Http\Middleware\ResourcesMiddleware\LocationResource::class,

        /**
         * Assert can found image and parse image object to lower layer
         *
         * Must sure have USER from higher layer
         */
        'image_res' => \App\Http\Middleware\ResourcesMiddleware\ImageResource::class,

        /**
         *
         */
        'fonda_res' => \App\Http\Middleware\ResourcesMiddleware\FondaResource::class,

        /**
         *
         */
        'fonda_image_res' => \App\Http\Middleware\ResourcesMiddleware\FondaImageResource::class,

        /**
         *
         */
        'fonda_sale_res' => \App\Http\Middleware\ResourcesMiddleware\SaleResource::class,

        /**
         *
         */
        'fonda_utility_res' => \App\Http\Middleware\ResourcesMiddleware\FondaUtilityResource::class,

        /**
         *
         */
        'fonda_culinary_res' => \App\Http\Middleware\ResourcesMiddleware\FondaCulinaryResource::class,

        /*
         *
         */
        'comment_res' => \App\Http\Middleware\ResourcesMiddleware\CommentResource::class,

        /**
         * Assert user is Vendor Role
         */
        'auth_vendor' => \App\Http\Middleware\VendorUserRole::class,


    ];
}
