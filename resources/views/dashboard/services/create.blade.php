@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'add service')
@section('content_header_title', 'Services')
@section('content_header_subtitle', 'add new Service')

{{-- Content body: main page content --}}

@section('content_body')
<form action="{{ route('services.store') }}" method="POST">
    @csrf
    <x-adminlte-input name="name" label="Name" :value="old('name')" placeholder="Enter Service Name" error-key="name" />

    <x-adminlte-textarea name="description" label="Description" type="textarea"
        error-key="description" placeholder="Enter Service Description">
        {{ old('description') }}
    </x-adminlte-textarea>

    <x-adminlte-input type="number" name="price" label="price" :value="old('price')"
        placeholder="Enter Service Price" />

    <div class="form-check">
        <input type="hidden" name="is_available" value="0">
        <input class="form-check-input" type="checkbox" name="is_available" value="1" {{ old('is_available', '1' )=='1'
            ? 'checked' : '' }}>

        <label class="form-check-label">Is Available</label>
    </div>

    <div class="text-right">
        <x-adminlte-button label="save" theme="primary" type="submit" icon="fa fa-save" />
    </div>

</form>
@stop


@push('css')
@endpush


@push('js')
@endpush
