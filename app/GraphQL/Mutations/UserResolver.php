<?php

namespace App\GraphQL\Mutations;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use GraphQL\Type\Definition\ResolveInfo;
use App\Exceptions\ChangePasswordException;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class UserResolver
{
    /**
     * Return a value for the field.
     *
     * @param  null  $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param  mixed[]  $args The arguments that were passed into the field.
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context Arbitrary data that is shared between all fields of a single query.
     * @param  \GraphQL\Type\Definition\ResolveInfo  $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     * @return mixed
     */
    public function changePassword($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = Auth::guard('api')->user();
        if (!(Hash::check($args['current_password'], $user->password))) {
            throw new ChangePasswordException(
                'Contraseña actual incorrrecta.',
                'Su contraseña actual no coincide con la contraseña que proporcionó.'
            );
        }
        $user->password = bcrypt($args['new_password']);
        $user->save();
        return $user;
    }
}
