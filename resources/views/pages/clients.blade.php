@extends('authenticated')

@push('styles')
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css">
    <!--end::Vendor Stylesheets-->

    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    @if (count($paginator->items()) > 0)
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800">
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($paginator->items() as $user)
                        <tr>
                            <td> {{ $user->name }}</td>
                            <td>{{ $user->email}}</td>
                            <td>{{ $user->phone_number}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <x-paginator :paginator="$paginator"> </x-paginator>
    @else
        <!--begin::Alert-->
        <div class="alert alert-danger d-flex align-items-center p-5">
            <!--begin::Icon-->

            <!--begin::Wrapper-->
            <div class="d-flex flex-column">
                <!--begin::Title-->
                <h4 class="mb-1 text-mute">There are no referrers</h4>
                <!--end::Title-->
                <!--begin::Content-->
                <div class="row p-0 mb-5 px-9">
                    <p class="fs-6 fw-semibold text-gray-600 py-4 m-0">Copy and start sharing to <span class="text-danger"> earn </span>
                        more points!</p>
                    <div class="d-flex">
                        <input readonly id="kt_clipboard_1" type="text" class="form-control form-control-solid me-3"
                            style="width: 100% !important" value="{{ route('register', ['referal_code' => Auth::user()->code]) }}">
                        <button id="kt_referral_program_link_copy_btn"
                            class="btn btn-light btn-active-light-primary fw-bold flex-shrink-0"
                            data-clipboard-target="#kt_clipboard_1">Copy Link</button>
                    </div>
                </div>
                <!--end::Content-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Alert-->
    @endif
@endsection
