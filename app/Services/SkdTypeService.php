<?php

namespace App\Services;

use App\Repository\SkdTypeRepository;

class SkdTypeService
{
    public function __construct(protected SkdTypeRepository $skdTypeRepository) {}

    public function list()
    {
        return $this->skdTypeRepository->list();
    }

    public function add($skd_type_data)
    {
            !empty($skd_type_data['barcode_prefix']) ?
                $skd_type_data['barcode_status'] = 1 : $skd_type_data['barcode_status'] = 0;
            
            $skd_type_data['name'] = $skd_type_data['skd_type_name'];

        return $this->skdTypeRepository->add($skd_type_data);
    }
}
