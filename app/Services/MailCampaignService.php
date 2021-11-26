<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\MailCampaign\MailCampaignRepositoryInterface;
use App\Services\BaseService;

class MailCampaignService extends BaseService
{
    protected $mailCampaignRepository;

    public function __construct(MailCampaignRepositoryInterface $mailCampaignRepository)
    {
        $this->mailCampaignRepository = $mailCampaignRepository;
    }

    public function index($request)
    {
        return $this->mailCampaignRepository->index($request);
    }

    public function all($request = null)
    {
        return $this->mailCampaignRepository->all($request);
    }

    public function getAll()
    {
        return $this->mailCampaignRepository->getAll();
    }

    public function store($attributes)
    {
        return $this->mailCampaignRepository->create($attributes);
    }

    public function find($id)
    {
        return $this->mailCampaignRepository->find($id);
    }

    public function update($id, $attributes)
    {
        return $this->mailCampaignRepository->update($id, $attributes);
    }

    public function delete($id)
    {
        return $this->mailCampaignRepository->delete($id);
    }
}
