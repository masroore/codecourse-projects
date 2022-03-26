<div>
    <div class="d-flex justify-content-between align-content-center mb-4">
        <div class="flex-fill">
            <input type="search" name="query" id="query" class="form-control" placeholder="Search" wire:model="query">
        </div>

        <div class="d-flex">
            <div>
                <div class="d-flex align-items-center ml-4">
                    <label for="paginate" class="text-nowrap mr-2 mb-0">Per page</label>
                    <select name="paginate" id="paginate" class="form-control" wire:model="paginate">
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>
            <div>
                @if (count($checked))
                    <div class="dropdown ml-4">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                            With checked ({{ count($checked) }})
                        </button>

                        <div class="dropdown-menu">
                            <a href="#" class="dropdown-item" wire:click="deleteChecked">Delete</a>
                        </div>
                    </div>
                @endif  
            </div>
        </div>
    </div>

    <table class="table table-striped table-responsive">
        <thead>
            <tr>
                @foreach ($columns as $column)
                    <th>
                        {{ $column }}
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($this->records() as $record)
                <tr class="@if ($this->isChecked($record)) table-primary @endif">
                    <td>
                        <input type="checkbox" value="{{ $record->id }}" wire:model="checked">
                    </td>
                    @foreach ($columns as $column)
                        <td>
                            {{ $record->{$column} }}
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $this->records()->links() }}
</div>
