<?php

namespace App\Common;

use App\Infrastructure\routes\http\AbstractRequest;

interface UseCaseInterface
{
    public function execute(AbstractRequest $request);
}
