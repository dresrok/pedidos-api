<?php

namespace App\GraphQL\Queries;

use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class Validation
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
    public function validateCompanyIdentification($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $except = '';
        $field = 'company_identification';
        if (isset($args['company_id'])) {
            $except = ",{$args['company_id']},company_id";
        }
        $inputs = [
            $field => $args[$field]
        ];
        $rules = [
            $field => "required|unique:b_companies,{$field}{$except}"
        ];
        return $this->makeValidation($inputs, $rules, $field);
    }

    /**
     * Return a value for the field.
     *
     * @param  null  $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param  mixed[]  $args The arguments that were passed into the field.
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context Arbitrary data that is shared between all fields of a single query.
     * @param  \GraphQL\Type\Definition\ResolveInfo  $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     * @return mixed
     */
    public function validateOfficeEmail($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $except = '';
        $field = 'office_email';
        if (isset($args['office_id'])) {
            $except = ",{$args['office_id']},office_id";
        }
        $inputs = [
            $field => $args[$field]
        ];
        $rules = [
            $field => "required|unique:b_offices,{$field}{$except}"
        ];
        return $this->makeValidation($inputs, $rules, $field);
    }

    /**
     * Return a value for the field.
     *
     * @param  null  $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param  mixed[]  $args The arguments that were passed into the field.
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context Arbitrary data that is shared between all fields of a single query.
     * @param  \GraphQL\Type\Definition\ResolveInfo  $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     * @return mixed
     */
    public function validatePersonIdentification($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $except = '';
        $field = 'person_identification';
        if (isset($args['person_id'])) {
            $except = ",{$args['person_id']},person_id";
        }
        $inputs = [
            $field => $args[$field]
        ];
        $rules = [
            $field => "required|unique:c_people,{$field}{$except}"
        ];
        return $this->makeValidation($inputs, $rules, $field);
    }

    /**
     * Return a value for the field.
     *
     * @param  null  $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param  mixed[]  $args The arguments that were passed into the field.
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context Arbitrary data that is shared between all fields of a single query.
     * @param  \GraphQL\Type\Definition\ResolveInfo  $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     * @return mixed
     */
    public function validateUserEmail($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $except = '';
        $field = 'email';
        if (isset($args['user_id'])) {
            $except = ",{$args['user_id']},user_id";
        }
        $inputs = [
            $field => $args[$field]
        ];
        $rules = [
            $field => "required|unique:c_users,{$field}{$except}"
        ];
        return $this->makeValidation($inputs, $rules, $field);
    }

    private function makeValidation($inputs, $rules, $field)
    {
        $validator = Validator::make($inputs, $rules);
        try {
            $validator->validate();
            return [
                'valid' => true,
                'message' => ''
            ];
        } catch (Exception $exception) {
            if ($exception instanceof ValidationException) {
                return [
                    'valid' => false,
                    'message' => $validator->errors()->first($field)
                ];
            }
        }
    }
}
