<?php

namespace App\GraphQL\Mutations;

use App\Models\Company;
use App\Models\Office;
use App\Facades\ImageManager;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class CompanyResolver
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
    public function update($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $company = Company::findOrFail($args['id']);
        if ($args['company_image']) {
            $image = $args['company_image'];
            $hash = md5($company->company_slug . microtime());
            $name = $hash . '.' . $image->getClientOriginalExtension();
            ImageManager::deleteImages(Company::IMAGES_PATH, $company->company_image_name);
            ImageManager::processImage(Company::IMAGES_PATH, $image, $name);
            $company->company_image_name = $name;
        }
        $company->company_legal_name = $args['company_legal_name'];
        $company->company_commercial_name = $args['company_commercial_name'];
        $company->company_identification = $args['company_identification'];
        $company->city = $args['city'];
        $company->save();

        $office = Office::findOrFail($args['office_id']);
        $office->office_name = $args['company_legal_name'];
        $office->office_email = $args['office_email'];
        $office->office_open_from = $args['office_open_from'];
        $office->office_open_to = $args['office_open_to'];
        $office->office_delivery_time = $args['office_delivery_time'];
        $office->office_minimum_order_price = $args['office_minimum_order_price'];
        $office->city = $args['city'];
        $office->save();

        $office->businessTypes()->sync($args['business_types']);

        return $company;
    }
}
