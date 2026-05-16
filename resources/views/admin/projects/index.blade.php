@extends('layouts.admin')

@section('header', 'Projects Management')
<link rel="stylesheet" href="{{ asset('css/admin/projects/index.css') }}">
@section('content')

<div class="proj-wrap">

    <div class="proj-header">
        <div>
            <div class="proj-eyebrow">Management</div>
            <h1 class="proj-title">Featured <em>Projects</em></h1>
        </div>
        <a href="{{ route('admin.projects.create') }}" class="proj-add-btn">
            <span><i class="fas fa-plus" style="margin-right:4px;"></i> Add Project</span>
        </a>
    </div>

    <div class="proj-table-wrap">
        <table class="proj-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Featured</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $project)
                <tr>
                    <td>
                        <div class="proj-td-title">{{ $project->title }}</div>
                        <div class="proj-td-slug">{{ $project->slug }}</div>
                    </td>
                    <td>
                        @if($project->is_active)
                            <span class="proj-badge proj-badge-active">Active</span>
                        @else
                            <span class="proj-badge proj-badge-inactive">Inactive</span>
                        @endif
                    </td>
                    <td>
                        @if($project->is_featured)
                            <span class="proj-featured-yes"><i class="fas fa-star" style="margin-right:5px;"></i>Yes</span>
                        @else
                            <span class="proj-featured-no"><i class="fas fa-times" style="margin-right:5px;"></i>No</span>
                        @endif
                    </td>
                    <td class="proj-date">{{ $project->created_at->format('M d, Y') }}</td>
                    <td>
                        <div class="proj-actions">
                            <a href="{{ route('admin.projects.show', $project) }}" class="proj-btn-edit" style="background: rgba(59,130,246,.08); border-color: rgba(59,130,246,.25); color: #93c5fd;">
                                <i class="fas fa-eye"></i> View
                            </a>
                            <a href="{{ route('admin.projects.edit', $project) }}" class="proj-btn-edit">
                                <i class="fas fa-pen"></i> Edit
                            </a>
                            <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" style="display:inline;" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="proj-btn-delete">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="padding: 0; border-bottom: none;">
                        <div class="proj-empty">
                            <i class="fas fa-folder-open"></i>
                            No projects yet. Create one to get started!
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="proj-pagination">
        {{ $projects->links() }}
    </div>

</div>
@endsection