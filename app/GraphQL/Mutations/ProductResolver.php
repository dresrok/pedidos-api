<?php

namespace App\GraphQL\Mutations;

use App\Models\Office;
use App\Models\Product;
use App\Facades\ImageManager;

use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class ProductResolver
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
        if ($args['product_image']) {
            $image = $args['product_image'];
            $hash = md5($company->company_slug . microtime());
            $name = $hash . '.' . $image->getClientOriginalExtension();
            ImageManager::processImage(Product::IMAGES_PATH, $image, $name);
        }
        $product = Product::Create([
            'product_name' => $args['product_name'],
            'product_description' => $args['product_description'],
            'product_image_name' => $name,
            'category_id' => $args['category_id'],
            'office_id' => $args['office_id']
        ]);
        $product->prices()->create([
            'product_price_amount' => $args['product_price']
        ]);
        return $product;
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
        $product = Product::findOrFail($args['id']);
        $company = Office::find($product->office_id)->company;
        if ($args['product_image']) {
            $image = $args['product_image'];
            $hash = md5($company->company_slug . microtime());
            $name = $hash . '.' . $image->getClientOriginalExtension();
            ImageManager::deleteImages(Product::IMAGES_PATH, $product->product_image_name);
            ImageManager::processImage(Product::IMAGES_PATH, $image, $name);
            $product->product_image_name = $name;
        }
        $product->product_name = $args['product_name'];
        $product->product_description = $args['product_description'];
        $product->category_id = $args['category_id'];
        $product->save();
        return $product;
    }
}
