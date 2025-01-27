<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Article;

use App\Http\Controllers\AbstractBaseController;
use App\Models\Article;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\ValidatedInput;
use Premierstacks\LaravelStack\Container\Resolve;
use Premierstacks\LaravelStack\Validation\Validity\Validity;
use Premierstacks\PhpStack\JsonApi\JsonApiDocument;
use Premierstacks\PhpStack\JsonApi\JsonApiResource;
use Premierstacks\PhpStack\JsonApi\JsonApiResourceInterface;
use Premierstacks\PhpStack\Mixed\Filter;

class ArticleShowController extends AbstractBaseController
{
    public function createArticleJsonApiResource(Article $article): JsonApiResourceInterface
    {
        return new JsonApiResource(
            (string) $article->getKey(),
            $article->getRouteKey(),
            $article->getTable(),
            [
                'user_id' => $article->getAttribute('user_id'),
                'title' => $article->getAttribute('title'),
                'content' => $article->getAttribute('content'),
                'created_at' => $article->getCreatedAt()?->toJSON(),
                'updated_at' => $article->getUpdatedAt()?->toJSON(),
            ],
        );
    }

    public function getCacheRepository(): Repository
    {
        return Resolve::cacheRepositoryContract();
    }

    public function getId(ValidatedInput $validated): int
    {
        return Filter::int($validated->input('id'));
    }

    public function getValidated(): ValidatedInput
    {
        return new ValidatedInput($this->createValidator([
            '' => '',
            'id' => Validity::integer()->positive()->required()->compile(),
        ])->validate());
    }

    #[\Override]
    public function handle(): JsonResponse
    {
        $request = $this->getRequest();

        $id = $this->getId($this->getValidated());

        $closure = function () use ($id): JsonResponse {
            $article = (new Article())->retrieveByKey($id);

            if ($article === null) {
                $this->getThrower()->failure('id', 'Exists')->throw();
            }

            return $this->getJsonApiResponseFactory()->json(new JsonApiDocument($this->createArticleJsonApiResource($article)));
        };

        if ($request->isNoCache()) {
            return $closure();
        }

        return $this->getCacheRepository()->remember(static::class . ':' . $id, 60, $closure);
    }
}
