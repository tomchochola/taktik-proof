<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Article;

use App\Http\Controllers\AbstractBaseController;
use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Response;
use Illuminate\Support\ValidatedInput;
use Premierstacks\LaravelStack\Validation\Validity\Validity;
use Premierstacks\PhpStack\Mixed\Filter;

class ArticleUpdateController extends AbstractBaseController
{
    public function getId(ValidatedInput $validated): int
    {
        return Filter::int($validated->input('id'));
    }

    public function getValidated(): ValidatedInput
    {
        return new ValidatedInput($this->createValidator([
            '' => '',
            'id' => Validity::integer()->positive()->required()->compile(),
            'title' => Validity::string()->varchar()->filled()->compile(),
            'content' => Validity::string()->text()->filled()->compile(),
        ])->validate());
    }

    #[\Override]
    public function handle(): Response
    {
        $user = $this->retrieveUser();

        $validated = $this->getValidated();

        $article = (new Article())->mustRetrieveByKey($this->getId($validated));

        $this->authorize($user, $article);

        $article->mustUpdate($validated->only(['title', 'content']));

        return $this->getJsonApiResponseFactory()->responseFactory->noContent();
    }

    protected function authorize(User $user, Article $article): void
    {
        if ($user->getKey() !== $article->getUserId()) {
            throw new AuthenticationException();
        }
    }
}
