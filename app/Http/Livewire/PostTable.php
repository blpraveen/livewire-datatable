<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Post;

class PostTable extends DataTableComponent
{
    protected $model = Post::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function filters(): array
    {
        return [
            TextFilter::make('Name')
                ->config([
                    'maxlength' => 5,
                    'placeholder' => 'Search Name',
                ])
                ->filter(function(Builder $builder, string $value) {
                    $builder->where('posts.name', 'like', '%'.$value.'%');
                }),
            TextFilter::make('catname')
            ->config([
                'maxlength' => 50,
                'placeholder' => 'Search Name',
            ])
            ->filter(function(Builder $builder, string $value) {
                $builder->withWhereHas('category', function ($query) use ($value) {
                    $query->where('categories.name', 'like', '%' . $value . '%');
                });
            })

        ];
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Name", "name")
                ->sortable()
                ->searchable()
                ->secondaryHeaderFilter('name'),
            Column::make("Category id", "category.name")
                ->sortable()
                ->secondaryHeaderFilter('catname'),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }

    public function builder(): Builder
    {
        return Post::query();
        //   return Team::visible(Team::class, $this->selectedteams);
    }
}
