<?php

namespace App\Services;

use App\Repository\NotificationRepository;
use App\Repository\VerifyRepository;

class VerifyService
{
    public function __construct(
        protected VerifyRepository $verifyRepository,
        protected NotificationRepository $notificationRepository
    ) {}

    public function add(string $slug = '', int $item_id)
    {
        $module = $this->verifyRepository->findModuleBySlug($slug);
        $this->verifyRepository->add($module, $item_id);
        $this->notificationRepository->add($module);

        return successResponse("Verification history added successfully");
    }

    public function verify_module($data)
    {
        return $this->verifyRepository->verify_module($data);
    }

    public function history($data)
    {
        return  $this->verifyRepository->history($data);
    }
}
