<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Article;

use App\Http\Controllers\AbstractBaseController;
use App\Models\Article;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\ValidatedInput;
use Premierstacks\LaravelStack\Validation\Validity\Validity;
use Premierstacks\PhpStack\JsonApi\JsonApiDocument;
use Premierstacks\PhpStack\JsonApi\JsonApiResource;
use Premierstacks\PhpStack\JsonApi\JsonApiResourceInterface;
use Premierstacks\PhpStack\Mixed\Assert;
use Premierstacks\PhpStack\Mixed\Filter;

class ArticleIndexController extends AbstractBaseController
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

    /**
     * @return list<int>
     */
    public function getFilterId(ValidatedInput $validated): array
    {
        return Filter::listOf($validated->input('filter.id'), static fn(int $key, mixed $id): int => Filter::int($id), []);
    }

    /**
     * @return list<int>
     */
    public function getFilterUserId(ValidatedInput $validated): array
    {
        return Filter::listOf($validated->input('filter.user_id'), static fn(int $key, mixed $id): int => Filter::int($id), []);
    }

    public function getPage(ValidatedInput $validated): int
    {
        return Filter::int($validated->input('page'), 1);
    }

    /**
     * @return list<string>
     */
    public function getSort(ValidatedInput $validated): array
    {
        return Filter::listOf($validated->input('sort'), static fn(int $key, mixed $sort): string => Filter::string($sort), []);
    }

    public function getValidated(): ValidatedInput
    {
        $qualifier = new Article();

        $key = $qualifier->getKeyName();
        $createdAt = $qualifier->getCreatedAtColumn() ?? 'created_at';
        $updatedAt = $qualifier->getUpdatedAtColumn() ?? 'updated_at';

        return new ValidatedInput($this->createValidator([
            'sort' => Validity::list()->max(3)->nullable()->filled()->compile(),
            'sort.*' => Validity::string()->in([$key, '-' . $key, $createdAt, '-' . $createdAt, $updatedAt, '-' . $updatedAt])->required()->distinct()->compile(),
            'page' => Validity::integer()->positive()->nullable()->filled()->compile(),
            'filter.id' => Validity::list()->max(1_024)->nullable()->filled()->compile(),
            'filter.id.*' => Validity::integer()->positive()->required()->compile(),
            'filter.user_id' => Validity::list()->max(1_024)->nullable()->filled()->compile(),
            'filter.user_id.*' => Validity::integer()->positive()->required()->compile(),
        ])->validate());
    }

    #[\Override]
    public function handle(): JsonResponse
    {
        $validated = $this->getValidated();

        $articles = Article::query();

        $this->select($articles);

        $this->filterId($articles, $validated);
        $this->filterUserId($articles, $validated);

        $this->sort($articles, $validated);

        $paginator = $articles->paginate(page: $this->getPage($validated));

        $data = [];

        foreach ($paginator->items() as $article) {
            $data[] = $this->createArticleJsonApiResource(Assert::instance($article, Article::class));
        }

        $meta = [
            'last_page' => $paginator->lastPage(),
        ];

        return $this->getJsonApiResponseFactory()->json(new JsonApiDocument($data, null, $meta));
    }

    /**
     * @param Builder<Article> $builder
     */
    protected function filterId(Builder $builder, ValidatedInput $validated): void
    {
        if ($validated->missing('filter.id')) {
            return;
        }

        $builder->getQuery()->whereIn((new Article())->getQualifiedKeyName(), $this->getFilterId($validated));
    }

    /**
     * @param Builder<Article> $builder
     */
    protected function filterUserId(Builder $builder, ValidatedInput $validated): void
    {
        if ($validated->missing('filter.user_id')) {
            return;
        }

        $builder->getQuery()->whereIn((new Article())->user()->getQualifiedForeignKeyName(), $this->getFilterUserId($validated));
    }

    /**
     * @param Builder<Article> $builder
     */
    protected function select(Builder $builder): void
    {
        $builder->getQuery()->select($builder->qualifyColumn('*'));
    }

    /**
     * @param Builder<Article> $builder
     */
    protected function sort(Builder $builder, ValidatedInput $validated): void
    {
        $sorts = $this->getSort($validated);

        foreach ($sorts as $sort) {
            if (\str_starts_with($sort, '-')) {
                $builder->getQuery()->orderByDesc($builder->qualifyColumn(\mb_substr($sort, 1)));
            } else {
                $builder->getQuery()->orderBy($builder->qualifyColumn($sort));
            }
        }

        $builder->getQuery()->orderBy((new Article())->getQualifiedKeyName());
    }
}
