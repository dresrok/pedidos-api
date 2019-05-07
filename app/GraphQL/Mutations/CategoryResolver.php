<?php

namespace App\GraphQL\Mutations;

use App\Models\Office;
use App\Models\Category;
use App\Facades\ImageManager;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class CategoryResolver
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
    public function create($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $name = null;
        $company = Office::find($args['office_id'])->company;
        if ($args['category_image']) {
            $image = $args['category_image'];
            $hash = md5($company->company_slug . microtime());
            $name = $hash . '.' . $image->getClientOriginalExtension();
            ImageManager::processImage(Category::IMAGES_PATH, $image, $name);
        }
        return Category::Create([
            'category_name' => $args['category_name'],
            'category_image_name' => $name,
            'category_order' => Category::getNextOrder($args['office_id']),
            'office_id' => $args['office_id']
        ]);
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
    public function update($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $category = Category::findOrFail($args['id']);
        $company = Office::find($category->office_id)->company;
        if ($args['category_image']) {
            $image = $args['category_image'];
            $hash = md5($company->company_slug . microtime());
            $name = $hash . '.' . $image->getClientOriginalExtension();
            ImageManager::deleteImages(Category::IMAGES_PATH, $category->category_image_name);
            ImageManager::processImage(Category::IMAGES_PATH, $image, $name);
            $category->category_image_name = $name;
        }
        $category->category_name = $args['category_name'];
        $category->save();
        return $category;
    }
}
