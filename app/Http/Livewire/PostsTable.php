<?php

namespace App\Http\Livewire;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;
use App\Exports\UsersExport;
use App\Models\Post;
use Maatwebsite\Excel\Facades\Excel;

class PostsTable extends DataTableComponent
{
    public $myParam = 'Default';
    public string $tableName = 'posts';
    public array $users1 = [];
    
    public $columnSearch = [
        'name' => null,
        'category_id' => null,
    ];

    public function configure(): void
    {
        
    }

    public function columns(): array
    {
        return [
          
            Column::make('Name', 'name')
                ->sortable()
                ->collapseOnMobile()
                ->excludeFromColumnSelect()
        ];
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
                    $builder->where('users.name', 'like', '%'.$value.'%');
                })
        ];
    }

    public function builder(): Builder
    {
        return Post::query()
            ->when($this->columnSearch['name'] ?? null, fn ($query, $name) => $query->where('posts.name', 'like', '%' . $name . '%'));
    }

    public function bulkActions(): array
    {
        return [
            'activate' => 'Activate',
            'deactivate' => 'Deactivate',
            'export' => 'Export',
        ];
    }

    public function export()
    {
        $users = $this->getSelected();

        $this->clearSelected();

        return Excel::download(new UsersExport($users), 'users.xlsx');
    }

    public function activate()
    {
        Post::whereIn('id', $this->getSelected())->update(['active' => true]);

        $this->clearSelected();
    }

    public function deactivate()
    {
        Post::whereIn('id', $this->getSelected())->update(['active' => false]);

        $this->clearSelected();
    }

    public function reorder($items): void
    {
        foreach ($items as $item) {
            Post::find((int)$item['value'])->update(['sort' => (int)$item['order']]);
        }
    }
}