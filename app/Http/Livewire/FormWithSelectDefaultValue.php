<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;

class FormWithSelectDefaultValue extends Component implements HasForms
{
    use InteractsWithForms;

    public Post $post;

    public $data;

    public function render()
    {
        return view('livewire.form-with-select-default-value');
    }

    protected function getFormModel(): Post
    {
        return $this->post;
    }

    public function mount(): void
    {
        $this->post = new Post([
            'selector' => 's3',
        ]);

        $this->form->fill([
            'selector' => $this->post->selector,
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            Select::make('selector')
                ->options([
                    's1' => 'Selection 1',
                    's2' => 'Selection 2',
                    's3' => 'Selection 3',
                ])
                ->afterStateHydrated(function (Select $component, $state) {
                    $component->state('s2');
                }),
        ];
    }

    protected function getFormStatePath(): string
    {
        return 'data';
    }

}
