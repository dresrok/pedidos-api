<?php

namespace App\GraphQL\Mutations;

use App\Models\Category;
use App\Models\Office;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class CategoryResolver
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
        if ($args['category_image']) {
            $image = $args['category_image'];
            $hash = md5($company->company_slug . microtime());
            $name = $hash . '.' . $image->getClientOriginalExtension();
            $this->processImage($image, $name);
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
            $this->deleteImages($category->category_image_name);
            $this->processImage($image, $name);
            $category->category_image_name = $name;
        }
        $category->category_name = $args['category_name'];
        $category->save();
        return $category;
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
        return Storage::disk('public')->put(Category::IMAGES_PATH . "{$size}/{$name}", $file->encode());
    }

    private function deleteImages($name)
    {
        foreach ($this->sizes as $key => $value) {
            $size = $key;
            Storage::disk('public')->delete(Category::IMAGES_PATH . "{$size}/{$name}");
        }
    }
}
