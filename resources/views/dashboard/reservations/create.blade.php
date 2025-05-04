@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'add new reservation')
@section('content_header_title', 'Reservations')
@section('content_header_subtitle', "reserve new \"$service->name\" service")

{{-- Content body: main page content --}}

@section('content_body')
<form action="{{ route('services.reservations.store',$service->id) }}" method="POST">
    @csrf
    <x-adminlte-input type="datetime-local" name="reservation_date" label="Reservation Date" :value="old('reservation_date')" placeholder="Enter Reservation date" error-key="reservation_date" />

    <div class="text-right">
        <x-adminlte-button label="save" theme="primary" type="submit" icon="fa fa-save" />
    </div>

</form>
@stop


@push('css')
@endpush


@push('js')
@endpush
