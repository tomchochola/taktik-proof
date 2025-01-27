<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Article;

use App\Http\Controllers\AbstractBaseController;
use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\ValidatedInput;
use Premierstacks\LaravelStack\Validation\Validity\Validity;
use Premierstacks\PhpStack\JsonApi\JsonApiDocument;
use Premierstacks\PhpStack\JsonApi\JsonApiResourceIdentifier;
use Premierstacks\PhpStack\JsonApi\JsonApiResourceIdentifierInterface;

class ArticleStoreController extends AbstractBaseController
{
    public function createArticleJsonApiResource(Article $article): JsonApiResourceIdentifierInterface
    {
        return new JsonApiResourceIdentifier(
            (string) $article->getKey(),
            $article->getRouteKey(),
            $article->getTable(),
        );
    }

    public function getValidated(): ValidatedInput
    {
        return new ValidatedInput($this->createValidator([
            '' => '',
            'title' => Validity::string()->varchar()->required()->compile(),
            'content' => Validity::string()->text()->required()->compile(),
        ])->validate());
    }

    #[\Override]
    public function handle(): JsonResponse
    {
        $user = $this->retrieveUser();

        $validated = $this->getValidated();

        $article = new Article();

        $article->fill($validated->only(['title', 'content']));
        $article->fill(['user_id' => $user->getKey()]);

        $article->mustSave();

        return $this->getJsonApiResponseFactory()->json(new JsonApiDocument($this->createArticleJsonApiResource($article)));
    }
}
