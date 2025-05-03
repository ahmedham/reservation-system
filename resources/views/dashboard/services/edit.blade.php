@extends('layouts.app')

@section('subtitle', 'edit service')
@section('content_header_title', 'Services')
@section('content_header_subtitle', "Edit {$service->name} Service")


@section('content_body')
<form action="{{ route('services.update',$service->id) }}" method="POST">
    @csrf
    @method('PUT')



    <x-adminlte-input name="name" label="Name" :value="$service->name" placeholder="Enter Service Name"
        error-key="name" />

    <x-adminlte-textarea name="description" label="Description" error-key="description"
        placeholder="Enter Service Description">
        {{ $service->description }}
    </x-adminlte-textarea>


    <x-adminlte-input type="number" name="price" label="price" :value="$service->price"
        placeholder="Enter Service Price" />


    <div class="form-check">
        <input type="hidden" name="is_available" value="0">
        <input class="form-check-input" type="checkbox" name="is_available" value="1" {{ $service->isAvailable == '1'
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
