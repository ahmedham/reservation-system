@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'all services')
@section('content_header_title', 'Services')
@section('content_header_subtitle', 'all available services')

{{-- Content body: main page content --}}

@section('content_body')


<x-adminlte-modal id="modalDelete" title="Confirm Delete" size="md" theme="danger" icon="fas fa-exclamation-triangle"
    v-centered static-backdrop>
    <p>Are you sure you want to delete this service?
        This action cannot be undone.</p>

    <x-slot name="footerSlot">
        <x-adminlte-button class="mr-auto" theme="secondary" label="Cancel" data-dismiss="modal" />
        <x-adminlte-button theme="danger" label="Delete" id="confirmDeleteBtn" />
    </x-slot>
</x-adminlte-modal>
<form id="deleteForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>


<p>Welcome to Reservation System Dashboard.</p>

<div class="text-right mb-3">
    <a href="{{ route('services.create') }}">
        <x-adminlte-button label="Add new service" theme="primary" icon="fa fa-plus" />
    </a>
</div>


@php
$heads = [
['label' => 'Name', 'width' => 80],
['label' => 'Price', 'width' => 20],
['label' => 'Actions', 'no-export' => false, 'width' => 5],
];
$data = $services;
$config = [
'paging' => true,
'lengthMenu' => [5, 10, 50, 100, 500],
'columns' => [null, null, ['orderable' => false]],

];
@endphp

{{-- Minimal example / fill data using the component slot --}}
<x-adminlte-datatable id="services-table" :heads="$heads" :config="$config" hoverable>
    @foreach($data as $service)
    <tr>
        <td>{{ $service->name }}</td>
        <td>{{ $service->price }}</td>
        <td style="display: flex">
            <a class="btn btn-xs text-primary mx-1" title="Edit" href="{{ route('services.edit',$service->id) }}">
                <i class="fa fa-lg fa-fw fa-pen"></i>
            </a>
            <button class="btn btn-xs text-danger mx-1 open-delete-modal" title="Delete" data-toggle="modal" data-target="#modalDelete"
                data-url="{{ route('services.destroy', $service->id) }}">
                <i class="fa fa-lg fa-fw fa-trash"></i>
            </button>
        </td>
    </tr>
    @endforeach
</x-adminlte-datatable>
@stop

{{-- Push extra CSS --}}

@push('css')
{{-- Add here extra stylesheets --}}
{{--
<link rel="stylesheet" href="/css/admin_custom.css"> --}}
@endpush

{{-- Push extra scripts --}}

@push('js')
<script>
    let deleteUrl = '';

    // When the modal is triggered
    $('.open-delete-modal').on('click', function () {
        deleteUrl = $(this).data('url'); // capture route from button
    });

    // When clicking delete button inside the modal
    $('#confirmDeleteBtn').on('click', function () {
        if (deleteUrl) {
            let form = $('#deleteForm');
            form.attr('action', deleteUrl);
            form.submit();
        }
    });

</script>
@endpush
