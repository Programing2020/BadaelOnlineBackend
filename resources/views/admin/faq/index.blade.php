@extends('layouts.admin')

@section('styles')

<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@endsection

@section('content')

<!-- Page Heading -->

<h1 class="h3 mb-2 text-gray-800">{{ __('faq.faq') }}</h1>

@if (session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<!-- DataTales Example -->

<div class="card shadow mb-4">

    <div class="card-header py-3">

        <a href="{{ route('admin.faq.create') }}" class="btn btn-success">{{ __('faq.Cfaq') }}</a>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <thead>

                    <tr>

                        <th>{{ __('faq.no') }}</th>

                        <th>{{ __('faq.ques') }}</th>

                        <th>{{ __('faq.Answ') }}</th>

                        <th>{{ __('faq.option') }}</th>

                    </tr>

                </thead>

                <tbody>

                @php

                $no=0;

                @endphp

                @foreach ($faq as $faq)

                    <tr class="col-sm-12">

                        <td class="col-sm-1">{{ ++$no }}</td>

                        <td class="col-sm-4">{{ $faq->question }}</td>

                        <td class="col-sm-4">{{ substr($faq->answer,0,100) }}...</td>

                        <td class="col-sm-3">

                            <a href="{{route('admin.faq.edit', [$faq->id])}}" class="btn btn-info btn-sm"> {{ __('faq.edit') }} </a>

                            <form method="POST" action="{{route('admin.faq.destroy', [$faq->id])}}" class="d-inline" onsubmit="return confirm('Delete this faq permanently?')">

                                @csrf

                                <input type="hidden" name="_method" value="DELETE">

                                <input type="submit" value="{{ __('faq.del') }}" class="btn btn-danger btn-sm">

                            </form>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection

@push('scripts')

<script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>

<script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{ asset('admin/js/demo/datatables-demo.js') }}"></script>

@endpush
