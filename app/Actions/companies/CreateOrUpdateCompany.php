<?php

namespace App\Actions\Companies;

use App\Models\Company;

class CreateOrUpdateCompany {
    public function __invoke(array $company): Company {
        return Company::updateOrCreate(['id' => $company['id']], $company);
    }
}