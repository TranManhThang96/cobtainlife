<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\DBConstant;
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
        $keysExcept = ['client_say', 'client_name', 'client_job', 'comment_enable', 'comment_auto_hide'];
        foreach ($configs as $key => $config) {
            if (!in_array($key, $keysExcept)) {
                $data = [
                    'code' => $code,
                    'key' => $key,
                    'value' => $config
                ];
                $this->configRepository->updateOrCreate($data);
            }
        }

        if (isset($configs['client_say'])) {
            $says = [];
            foreach ($configs['client_say'] as $k => $say) {
                $says[] = [
                    'client_say' => $say,
                    'client_name' => $configs['client_name'][$k] ?? '',
                    'client_job' => $configs['client_job'][$k] ?? '',
                ];
            }
            if (count($says) > 0) {
                $data = [
                    'code' => $code,
                    'key' => 'client_says',
                    'value' => json_encode($says)
                ];
                $this->configRepository->updateOrCreate($data);
            }
        }

        if ($code == 'comment') {
            $enableComment = [
                'code' => $code,
                'key' => 'comment_enable',  
            ];

            $autoHideComment = [
                'code' => $code,
                'key' => 'comment_auto_hide',  
            ];
            if (!isset($configs['comment_enable'])) {
                $enableComment['value'] = DBConstant::HIDDEN_COMMENT;
            } else {
                $enableComment['value'] = DBConstant::SHOW_COMMENT;
            }

            if (!isset($configs['comment_auto_hide'])) {
                $autoHideComment['value'] = DBConstant::HIDDEN_COMMENT;
            } else {
                $autoHideComment['value'] = DBConstant::SHOW_COMMENT;
            }
            $this->configRepository->updateOrCreate($enableComment);
            $this->configRepository->updateOrCreate($autoHideComment);
        }
    }
}
