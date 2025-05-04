@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'all reservations')
@section('content_header_title', 'Reservations')
@section('content_header_subtitle', 'all reservations')

{{-- Content body: main page content --}}

@section('content_body')


<x-adminlte-modal id="modalCancel" title="Confirm Cancellation of Reservation" size="md" theme="danger"
    icon="fas fa-exclamation-triangle" v-centered static-backdrop>
    <p>Are you sure you want to cancel this reservations?</p>
    <p>This action cannot be undone.</p>

    <x-slot name="footerSlot">
        <x-adminlte-button class="mr-auto" theme="secondary" label="No" data-dismiss="modal" />
        <x-adminlte-button theme="danger" label="Cancel Reservation" id="cancelReservation" />
    </x-slot>
</x-adminlte-modal>

<form id="deleteForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

@php
$heads = [
['label' => 'Reserved service', 'width' => 40],
['label' => 'status', 'width' => 20],
['label' => 'Reservation Date', 'width' => 20],
['label' => 'Reservation Time', 'width' => 20],
['label' => 'Actions', 'no-export' => false, 'width' => 5],
];
$data = $reservations;
$config = [
'paging' => true,
'lengthMenu' => [5, 10, 50, 100, 500],
'columns' => [null, null,null,null, ['orderable' => false]],
];

@endphp

{{-- Minimal example / fill data using the component slot --}}
<x-adminlte-datatable id="reserations-table" :heads="$heads" :config="$config" hoverable>
    @foreach($data as $reservation)
    <tr>
        <td>{{ $reservation->serviceName }}</td>
        <td>{{ $reservation->status }}</td>
        <td>{{ $reservation->date }}</td>
        <td>{{ $reservation->time }}</td>
        <td style="display: flex">

            @if($reservation->status != "cancelled")
            <button class="btn btn-xs text-danger mx-1 open-cancel-modal" title="Cancel" data-toggle="modal"
                data-target="#modalCancel" data-url="{{ route('reservations.destroy', $reservation->id) }}">
                <i class="fa fa-lg fa-fw fa-times"></i>
            </button>
            @endif
        </td>
    </tr>
    @endforeach
</x-adminlte-datatable>

<form id="reserveForm" method="POST" style="display: none;">
    @csrf
    @method('DELELTE')
</form>


@stop


@push('js')
<script>
    let deleteUrl = '';

    $('.open-cancel-modal').on('click', function () {
        cancelUrl = $(this).data('url');
    });

    $('#cancelReservation').on('click', function () {
        if (cancelUrl) {
            let form = $('#deleteForm');
            form.attr('action', cancelUrl);
            form.submit();
        }
    });

    $('.service-reserve').on('click', function (e) {
        e.preventDefault();
        reserveUrl = $(this).data('url');
        if (reserveUrl) {
            let form = $('#reserveForm');
            form.attr('action', reserveUrl);
            form.submit();
        }
    });


</script>
@endpush
