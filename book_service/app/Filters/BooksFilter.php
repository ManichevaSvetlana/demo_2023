<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class BooksFilter extends QueryFilter
{
    /**
     * Filter by title.
     *
     * @param string $value
     * @return Builder
     */
    public function title(string $value): Builder
    {
        return $this->builder->whereRaw('UPPER(title) LIKE ?', [strtoupper("%$value%")]);
    }

    /**
     * Filter by author.
     *
     * @param string $value
     * @return Builder
     */
    public function author(string $value): Builder
    {
        return $this->builder->whereRaw('UPPER(author) LIKE ?', [strtoupper("%$value%")]);
    }

    /**
     * Filter by ISBN.
     *
     * @param string $value
     * @return Builder
     */
    public function isbn(string $value): Builder
    {
        return $this->builder->where('isbn', $value);
    }

    /**
     * Filter by description.
     *
     * @param string $value
     * @return Builder
     */
    public function description(string $value): Builder
    {
        return $this->builder->where('description', 'like', "%$value%");
    }

    /**
     * Filter by any string.
     *
     * @param ?string $value
     * @return Builder
     */
    public function string(?string $value = null): Builder
    {
        if(!$value) return $this->builder;

        return $this->builder
            ->where('description', 'like', "%$value%")
            ->orWhere('isbn', $value)
            ->orWhereRaw('UPPER(title) LIKE ?', [strtoupper("%$value%")])
            ->orWhereRaw('UPPER(author) LIKE ?', [strtoupper("%$value%")]);
    }

    /**
     * Filter by number of pages: max.
     *
     * @param ?int $value
     * @return Builder
     */
    public function pagesMax(?int $value = null): Builder
    {
        if(!$value) return $this->builder;

        return $this->builder->where('pages', '<', $value);
    }

    /**
     * Filter by number of pages: min.
     *
     * @param ?int $value
     * @return Builder
     */
    public function pagesMin(?int $value = null): Builder
    {
        if(!$value) return $this->builder;

        return $this->builder->where('pages', '>', $value);
    }
}
