@foreach ($companies as $company)
    <div class="company">
        <h3>{{ $company->name }}</h3>

        @if ($company->projects->count())
            <ul>
                @foreach ($company->projects as $project)
                    <li>{{ $project->name }}</li>
                @endforeach
            </ul>
        @endif
    </div>
@endforeach
