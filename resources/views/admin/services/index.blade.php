@extends('layouts.admin')

@section('header', 'Services Management')
<link rel="stylesheet" href="{{ asset('css/admin/services/index.css') }}">
@section('content')

<div class="svc-wrap">

    <div class="svc-header">
        <div>
            <div class="svc-eyebrow">Management</div>
            <h1 class="svc-title">Featured <em>Services</em></h1>
        </div>
        <a href="{{ route('admin.services.create') }}" class="svc-add-btn">
            <span><i class="fas fa-plus" style="margin-right:4px;"></i> Add Service</span>
        </a>
    </div>

    <div class="svc-table-wrap">
        <table class="svc-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Price Range</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($services as $service)
                <tr>
                    <td>
                        <div class="svc-td-title">{{ $service->title }}</div>
                        <div class="svc-td-slug">{{ $service->slug }}</div>
                    </td>
                    <td>
                        @if($service->is_active)
                            <span class="svc-badge svc-badge-active">Active</span>
                        @else
                            <span class="svc-badge svc-badge-inactive">Inactive</span>
                        @endif
                    </td>
                    <td class="svc-price">{{ $service->price_range ?? '—' }}</td>
                    <td class="svc-date">{{ $service->created_at->format('M d, Y') }}</td>
                    <td>
                        <div class="svc-actions">
                            <a href="{{ route('admin.services.edit', $service) }}" class="svc-btn-edit">
                                <i class="fas fa-pen"></i> Edit
                            </a>
                            <form method="POST" action="{{ route('admin.services.destroy', $service) }}" style="display:inline;" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="svc-btn-delete">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding: 0; border-bottom: none;">
                        <div class="svc-empty">
                            <i class="fas fa-concierge-bell"></i>
                            No services yet. Create one to get started!
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="svc-pagination">
        {{ $services->links() }}
    </div>

</div>
@endsection