@extends('admin.admin')

@section('title')
    Invoice Lists
@endsection

@section('content')
    <div class="content">
        <div class="block block-fx-pop">
            <div class="block-header">
                <h3 class="block-title">Unsettled Invoices</h3>

            </div>
            <div class="block-content block-content-full">
                @include('admin.payment.includes.invoices')
            </div>
        </div>
    </div>
@endsection
