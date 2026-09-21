@extends('layouts.app')

@section('title', 'Works - Ivan Kim Almadin')

@section('content')


<link rel="stylesheet" href="{{ asset('css/pages/portfolio.css') }}">

<div class="pf-port">
<div class="pf-container">

    {{-- ══ PROJECTS GRID ══ --}}
    <section class="port-projects">

        <div class="pf-divider">
            <div class="pf-divider-line"></div>
            <div class="pf-divider-dot"></div>
            <div class="pf-divider-line"></div>
        </div>

        <div class="port-projects-grid">
            @forelse($projects as $project)
                <x-project-card :project="$project" />
            @empty
                <div class="port-empty">
                    <div class="port-empty-icon">
                        <i class="fas fa-rocket"></i>
                    </div>
                    <p>No projects yet. Check back soon!</p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="port-pagination">
            {{ $projects->links() }}
        </div>
    </section>

</div>
</div>

<script>
    // Filter button active state toggle
    document.querySelectorAll('.port-filter-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.port-filter-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        });
    });
</script>

@endsection