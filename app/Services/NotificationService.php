<?php

namespace App\Services;

use App\Repository\NotificationRepository;

class NotificationService
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected NotificationRepository $notificationRepository)
    {
        //
    }

    public function list($data)
    {
        return $this->notificationRepository->list($data);
    }

    public function mark_as_read()
    {
        return $this->notificationRepository->mark_as_read();
    }
}
