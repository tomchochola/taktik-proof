<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Like;

use App\Http\Controllers\AbstractBaseController;
use Illuminate\Http\Response;
use Illuminate\Support\ValidatedInput;
use Premierstacks\LaravelStack\Validation\Validity\Validity;
use Premierstacks\PhpStack\Mixed\Filter;

class UserLikeDetachController extends AbstractBaseController
{
    public function getTargetUserId(ValidatedInput $validated): int
    {
        return Filter::int($validated->input('target_user_id'));
    }

    public function getValidated(): ValidatedInput
    {
        return new ValidatedInput($this->createValidator([
            '' => '',
            'target_user_id' => Validity::integer()->positive()->required()->compile(),
        ])->validate());
    }

    #[\Override]
    public function handle(): Response
    {
        $authenticatable = $this->retrieveUser();

        $validated = $this->getValidated();

        $targetUserId = $this->getTargetUserId($validated);

        if ($authenticatable->likedUsers()->getQuery()->whereKey($targetUserId)->toBase()->exists()) {
            $authenticatable->likedUsers()->detach($targetUserId);
        }

        return $this->getJsonApiResponseFactory()->responseFactory->noContent();
    }
}
