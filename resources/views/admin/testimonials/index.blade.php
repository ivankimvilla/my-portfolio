@extends('layouts.admin')

@section('header', 'Testimonials Management')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin/testimonials/index.css') }}">
<div class="test-wrap">
    <div class="test-header">
        <div>
            <div class="test-eyebrow">Management</div>
            <h1 class="test-title">Client <em>Testimonials</em></h1>
        </div>
    </div>

    {{-- ══ PENDING TESTIMONIALS ══ --}}
    @if($pending->count() > 0)
    <div class="test-section">
        <h2 class="test-section-title">
            <span class="test-pending-badge">● Pending Review</span>
            ({{ $pending->total() }})
        </h2>

        <div class="test-table-wrap">
            <table class="test-table">
                <thead>
                    <tr>
                        <th>Client</th>
                        <th>Rating</th>
                        <th>Submitted</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pending as $testimonial)
                    <tr>
                        <td>
                            <div class="test-name">{{ $testimonial->client_name }}</div>
                            <div class="test-subtext">{{ $testimonial->client_title }}{{ $testimonial->client_title && $testimonial->client_company ? ' at ' : '' }}{{ $testimonial->client_company }}</div>
                            <div class="test-subtext" style="margin-top: 4px; max-width: 400px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">"{{ $testimonial->content }}"</div>
                        </td>
                        <td>{{ $testimonial->rating }} / 5</td>
                        <td style="font-size: 12px; color: var(--muted2);">{{ $testimonial->created_at->diffForHumans() }}</td>
                        <td>
                            <div class="test-actions">
                                <form method="POST" action="{{ route('admin.testimonials.approve', $testimonial) }}" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="test-btn test-btn-approve" title="Approve and activate">
                                        <i class="fas fa-check"></i> Approve
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.testimonials.reject', $testimonial) }}" style="display:inline;" onsubmit="return confirm('Reject this testimonial?')">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="test-btn test-btn-reject">
                                        <i class="fas fa-times"></i> Reject
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="test-pagination">
            {{ $pending->appends(request()->query())->links() }}
        </div>
    </div>
    @endif

    {{-- ══ APPROVED TESTIMONIALS ══ --}}
    <div class="test-section">
        <h2 class="test-section-title">
            <span class="test-approved-badge">✓ Approved</span>
            ({{ $approved->total() }})
            <a href="{{ route('admin.testimonials.create') }}" class="test-add-btn" style="margin-left: auto;">
                <i class="fas fa-plus"></i> Add Manually
            </a>
        </h2>

        <div class="test-table-wrap">
            <table class="test-table">
                <thead>
                    <tr>
                        <th>Client</th>
                        <th>Rating</th>
                        <th>Featured</th>
                        <th>Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($approved as $testimonial)
                    <tr>
                        <td>
                            <div class="test-name">{{ $testimonial->client_name }}</div>
                            <div class="test-subtext">{{ $testimonial->client_title }}{{ $testimonial->client_title && $testimonial->client_company ? ' at ' : '' }}{{ $testimonial->client_company }}</div>
                        </td>
                        <td>{{ $testimonial->rating }} / 5</td>
                        <td>
                            @if($testimonial->is_featured)
                                <span class="test-badge test-badge-featured">Featured</span>
                            @else
                                <span class="test-badge test-badge-inactive">Normal</span>
                            @endif
                        </td>
                        <td>
                            @if($testimonial->is_active)
                                <span class="test-badge test-badge-active">Active</span>
                            @else
                                <span class="test-badge test-badge-inactive">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="test-actions">
                                <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="test-btn test-btn-edit">
                                    <i class="fas fa-pen"></i> Edit
                                </a>
                                <form method="POST" action="{{ route('admin.testimonials.destroy', $testimonial) }}" style="display:inline;" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="test-btn test-btn-delete">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <div class="test-empty">
                                No approved testimonials yet. Add one manually or approve a pending submission.
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="test-pagination">
            {{ $approved->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection