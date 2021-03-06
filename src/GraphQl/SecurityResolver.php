<?php

namespace GraphQl;

use Concrete\Core\Support\Facade\Application as App;

class SecurityResolver
{
    public static function get()
    {
        $queryType = [];

        $mutationType = [
            'login' => function ($root, $args) {
                $username = (string) $args['username'];
                $password = (string) $args['password'];

                $authorize = App::make(\Helpers\Authorize::class);
                return $authorize->loginAndGetToken($username, $password);
            },
            'checkNonce' => function ($root, $args) {
                $username = (string) $args['username'];
                $nonce = (string) $args['nonce'];
                $u2SAPass = (string) $args['u2SAPass'];

                $authorize = App::make(\Helpers\Authorize::class);
                return $authorize->checkNonce($username, $nonce, $u2SAPass);
            },
            'logout' => function ($root, $args) {
                $authorize = App::make(\Helpers\Authorize::class);
                return $authorize->logout();
            },
            'forgotPassword' => function ($root, $args) {
                $username = (string) $args['username'];
                $changePasswordUrl = (string) $args['changePasswordUrl'];

                $authenticate = App::make(\Helpers\Authenticate::class);
                return $authenticate->forgotPassword($username, $changePasswordUrl);
            },
            'changePassword' => function ($root, $args) {
                $password = (string) $args['password'];
                $passwordConfirm = (string) $args['passwordConfirm'];
                $token = (string) $args['token'];

                $authenticate = App::make(\Helpers\Authenticate::class);
                return $authenticate->changePassword($password, $passwordConfirm, $token);
            },
        ];

        $subscriptionType = [];

        return [
            'Query'    => $queryType,
            'Mutation' => $mutationType,
            'Subscription' => $subscriptionType,
        ];
    }
}
