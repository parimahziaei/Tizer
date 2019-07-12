<?php

namespace Webkul\API\Http\Controllers\Shop;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Webkul\API\Http\Resources\Customer\CustomerAddress as CustomerAddressResource;
use Webkul\Product\Repositories\ProductRepository;
use Webkul\API\Http\Resources\Catalog\Product as ProductResource;

/**
 * Product controller
 *
 * @author    Jitendra Singh <jitendra@webkul.com>
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class ProductController extends Controller
{
    /**
     * ProductRepository object
     *
     * @var array
     */
    protected $productRepository;

    /**
     * Create a new controller instance.
     *
     * @param  Webkul\Product\Repositories\ProductRepository $productRepository
     * @return void
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }



    //parimah create product
    public function create()
    {
//        request()->customer_id=auth()->guard('customer')->user()->id;
//        if (!request()->get('family') && request()->input('type') == 'configurable' && request()->input('sku') != '') {
//            return redirect(url()->current() . '?family=' . request()->input('attribute_family_id') . '&sku=' . request()->input('sku'));
//        }
//
//        if (request()->input('type') == 'configurable' && (! request()->has('super_attributes') || ! count(request()->get('super_attributes')))) {
//            session()->flash('error', trans('admin::app.catalog.products.configurable-error'));
//
//            return back();
//        }

        $this->validate(request(), [
            'type' => 'required',
            'attribute_family_id' => 'required',
            'sku' => ['required', 'unique:products,sku', new \Webkul\Core\Contracts\Validations\Slug],

        ]);

        $product = $this->productRepository->create(request()->all());

        return response()->json([
            'message' => 'Your product has been created successfully.',
            'data' => new ProductResource($product)
        ]);

    }
    /**
     * Returns a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductResource::collection($this->productRepository->getAll(request()->input('category_id')));
    }

    /**
     * Returns a individual resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get($id)
    {
        return new ProductResource(
                $this->productRepository->findOrFail($id)
            );
    }

    /**
     * Returns product's additional information.
     *
     * @return \Illuminate\Http\Response
     */
    public function additionalInformation($id)
    {
        return response()->json([
                'data' => app('Webkul\Product\Helpers\View')->getAdditionalData($this->productRepository->findOrFail($id))
            ]);
    }

    /**
     * Returns product's additional information.
     *
     * @return \Illuminate\Http\Response
     */
    public function configurableConfig($id)
    {
        return response()->json([
                'data' => app('Webkul\Product\Helpers\ConfigurableOption')->getConfigurationConfig($this->productRepository->findOrFail($id))
            ]);
    }
}
