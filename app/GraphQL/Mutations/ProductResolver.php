<?php

namespace App\GraphQL\Mutations;

use App\Models\Product;
use App\Models\Office;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class ProductResolver
{
    private $sizes = [
        'big' => '500x400',
        'medium' => '400x300',
        'small' => '300x200',
        'mini' => '128x128'
    ];

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
            $this->processImage($image, $name);
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
            $this->deleteImages($product->product_image_name);
            $this->processImage($image, $name);
            $product->product_image_name = $name;
        }
        $product->product_name = $args['product_name'];
        $product->product_description = $args['product_description'];
        $product->category_id = $args['category_id'];
        $product->save();
        return $product;
    }

    private function processImage($image, $name)
    {
        foreach ($this->sizes as $key => $value) {
            $size = $key;
            $dimens = explode('x', $value);
            $file = Image::make($image)->fit($dimens[0], $dimens[1], function ($constraint) {
                $constraint->upsize();
            });
            $this->saveImage($size, $name, $file);
        }
    }

    private function saveImage($size, $name, $file)
    {
        return Storage::disk('public')->put(Product::IMAGES_PATH . "{$size}/{$name}", $file->encode());
    }

    private function deleteImages($name)
    {
        foreach ($this->sizes as $key => $value) {
            $size = $key;
            Storage::disk('public')->delete(Product::IMAGES_PATH . "{$size}/{$name}");
        }
    }
}
