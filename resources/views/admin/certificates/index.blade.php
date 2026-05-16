@extends('layouts.admin')



@section('header', 'Certificates Management')


<link rel="stylesheet" href="{{ asset('css/admin/certificates/index.css') }}">

@section('content')


<div class="cert-wrap">



    <div class="cert-header">

        <div>

            <div class="cert-eyebrow">Management</div>

            <h1 class="cert-title">Professional <em>Certificates</em></h1>

        </div>

        <a href="{{ route('admin.certificates.create') }}" class="cert-add-btn">

            <span><i class="fas fa-plus" style="margin-right:4px;"></i> Add Certificate</span>

        </a>

    </div>



    <div class="cert-table-wrap">

        <table class="cert-table">

            <thead>

                <tr>

                    <th>Title</th>

                    <th>Issuer</th>

                    <th>Status</th>

                    <th>Issue Date</th>

                    <th>Actions</th>

                </tr>

            </thead>

            <tbody>

                @forelse($certificates as $certificate)

                <tr>

                    <td>

                        <div class="cert-td-title">{{ $certificate->title }}</div>

                        <div class="cert-td-issuer">{{ $certificate->issuer }}</div>

                    </td>

                    <td>{{ $certificate->issuer }}</td>

                    <td>

                        @if($certificate->is_active)

                            <span class="cert-badge cert-badge-active">Active</span>

                        @else

                            <span class="cert-badge cert-badge-inactive">Inactive</span>

                        @endif

                    </td>

                    <td class="cert-date">{{ $certificate->issue_date->format('M d, Y') }}</td>

                    <td>

                        <div class="cert-actions">

                            <a href="{{ route('admin.certificates.edit', $certificate) }}" class="cert-btn-edit">

                                <i class="fas fa-pen"></i> Edit

                            </a>

                            <form method="POST" action="{{ route('admin.certificates.destroy', $certificate) }}" style="display:inline;" onsubmit="return confirm('Are you sure?')">

                                @csrf

                                @method('DELETE')

                                <button type="submit" class="cert-btn-delete">

                                    <i class="fas fa-trash"></i> Delete

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="5" style="padding: 0; border-bottom: none;">

                        <div class="cert-empty">

                            <i class="fas fa-certificate"></i>

                            No certificates yet. Create one to get started!

                        </div>

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>



    <div class="cert-pagination">

        {{ $certificates->links() }}

    </div>



</div>

@endsection