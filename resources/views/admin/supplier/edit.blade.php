@extends('layouts.admin')
@section('title', $viewData["title"])
@section('content')
<div class="card mb-4">
  <div class="card-header">
    {{__('messages.admin.suppliers.edit.title')}}
  </div>
  <div class="card-body">
    @if($errors->any())
    <ul class="alert alert-danger list-unstyled">
      @foreach($errors->all() as $error)
      <li>- {{ $error }}</li>
      @endforeach
    </ul>
    @endif

    <form method="POST" action="{{ route('admin.supplier.update', ['id'=> $viewData['supplier']->id]) }}" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="row">
        <div class="col">
          <div class="mb-3 row">
            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">{{__('messages.admin.suppliers.edit.raison_social')}}:</label>
            <div class="col-lg-10 col-md-6 col-sm-12">
              <input name="raison_sociale" value="{{ $viewData['supplier']->raison_sociale }}" type="text" class="form-control">
            </div>
          </div>
          <div class="mb-3 row">
            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">{{__('messages.admin.suppliers.edit.address')}}:</label>
            <div class="col-lg-10 col-md-6 col-sm-12">
              <input name="adresse" value="{{ $viewData['supplier']->adresse }}" type="text" class="form-control">
            </div>
          </div>
          <div class="mb-3 row">
            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">{{__('messages.admin.suppliers.edit.telephone')}}:</label>
            <div class="col-lg-10 col-md-6 col-sm-12">
              <input name="tele" value="{{ $viewData['supplier']->tele }}" type="text" class="form-control">
            </div>
          </div>
          <div class="mb-3 row">
            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">{{__('messages.admin.suppliers.edit.email')}}:</label>
            <div class="col-lg-10 col-md-6 col-sm-12">
              <input name="email" value="{{ $viewData['supplier']->email }}" type="email" class="form-control">
            </div>
          </div>
        </div>
      </div>
      <div class="mb-3">
        <label class="form-label">{{__('messages.admin.suppliers.edit.description')}}</label>
        <textarea class="form-control" name="description" rows="3">{{ $viewData['supplier']->description }}</textarea>
      </div>
      <button type="submit" class="btn btn-primary">{{__('messages.admin.suppliers.edit.btn')}}</button>
    </form>
  </div>
</div>
@endsection