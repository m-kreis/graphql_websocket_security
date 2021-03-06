<?php

namespace GraphQl;

use Concrete\Core\Support\Facade\Application as App;

use C5GraphQl\UserManagement\UserResolverHandler;

class UserManagementResolver
{
    public static function get()
    {
        $queryType = [];

        $mutationType = [
            'createUser' => function ($root, $args, $context) {
                $urh = App::make(UserResolverHandler::class);
                return $urh->createUser($root, $args, $context);
            },
            'updateUser' => function ($root, $args, $context) {
                $urh = App::make(UserResolverHandler::class);
                return $urh->updateUser($root, $args, $context);
            },
            'sendValidationEmail' => function ($root, $args, $context) {
                $urh = App::make(UserResolverHandler::class);
                return $urh->sendValidationEmail($root, $args, $context);
            },
            'validateEmail' => function ($root, $args, $context) {
                $urh = App::make(UserResolverHandler::class);
                return $urh->validateEmail($root, $args, $context);
            }
        ];

        $subscriptionType = [];

        return [
            'Query'    => $queryType,
            'Mutation' => $mutationType,
            'Subscription' => $subscriptionType,
        ];
    }
}
