<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Spec;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\File;

class OpenApiController extends Controller
{
    public function spec(): string
    {
        return File::get(base_path('spec/v1/openapi.yaml'));
    }

    public function docs(): View
    {
        return view('swagger.spec');
    }
}
