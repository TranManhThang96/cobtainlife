<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\ShopProductAttribute\ShopProductAttributeRepositoryInterface;
use App\Services\BaseService;
use Illuminate\Support\Str;

class ShopProductAttributeService extends BaseService
{
    protected $productAttributeRepository;

    public function __construct(ShopProductAttributeRepositoryInterface $productAttributeRepository)
    {
        $this->productAttributeRepository = $productAttributeRepository;
    }

    public function index($request)
    {
        return $this->productAttributeRepository->index($request);
    }

    public function all($request = null)
    {
        return $this->productAttributeRepository->all($request);
    }

    public function getAll()
    {
        return $this->productAttributeRepository->getAll();
    }

    public function store($attributes)
    {
        return $this->productAttributeRepository->create($attributes);
    }

    public function find($id)
    {
        return $this->productAttributeRepository->find($id);
    }

    public function update($id, $attributes)
    {
        return $this->productAttributeRepository->update($id, $attributes);
    }

    public function delete($id)
    {
        return $this->productAttributeRepository->delete($id);
    }

    public function insertMultiple($productAttributes, $productId, $createdBy)
    {
        if (is_array($productAttributes)) {
            $productAttributesInsert = [];
            foreach ($productAttributes as $attributeGroupId=>$productAttribute) {
                $arrCheck = [];
                $arrName = $productAttribute['name'];
                $arrAddPrice = $productAttribute['add_price'];
                foreach($arrName as $k=>$name) {
                    if (!empty($name) && !in_array($name, $arrCheck)) {
                        $arrCheck[] = ucwords(strtolower($name));
                        $productAttributesInsert[] = [
                            'name' => $name,
                            'code' => Str::slug($name, '-'),
                            'attribute_group_id' => $attributeGroupId,
                            'product_id' => $productId,
                            'add_price' =>$arrAddPrice[$k] ?? 0,
                            'status' => 1,
                            'sort' => 1,
                            'created_by' => $createdBy,
                            'updated_by' => $createdBy,
                            'created_at' => new \DateTime(),
                            'updated_at' => new \DateTime(),
                        ];
                    }
                }
            }
            if (count($productAttributesInsert) > 0) {
                return $this->productAttributeRepository->insertMultiple($productAttributesInsert);
            }
        }
    }

    public function deleteAttributesByProduct($productId)
    {
        return $this->productAttributeRepository->deleteAttributesByProduct($productId);
    }

    public function updateMultiple($productAttributes, $productId, $createdBy)
    {
        // delete before insert
        $this->deleteAttributesByProduct($productId);

        // after insert multiple
        return $this->insertMultiple($productAttributes, $productId, $createdBy);
    }
}
