<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\ShopConfig\ShopConfigRepositoryInterface;
use App\Services\BaseService;

class ShopConfigService extends BaseService
{
    protected $configRepository;

    public function __construct(ShopConfigRepositoryInterface $configRepository)
    {
        $this->configRepository = $configRepository;
    }

    public function all()
    {
        return $this->configRepository->all();
    }

    public function save($configs)
    {
        $configs = $configs;
        $code = $configs['code'];
        unset($configs['code']);
        unset($configs['_token']);
        foreach($configs as $key=>$config) {
            $data = [
                'code' => $code,
                'key' => $key,
                'value' => $config
            ];
            $this->configRepository->updateOrCreate($data);
        }
    }
}
