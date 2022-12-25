@extends('authenticated')

@push('styles')
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css">
    <!--end::Vendor Stylesheets-->

    <link href="/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    <div class="row p-0 mb-5 px-9">
        <!--begin::Col-->
        <div class="col">
            <div class="border border-dashed border-gray-300 text-center min-w-125px rounded pt-4 pb-2 my-3">
                <span class="fs-4 fw-semibold text-success d-block">Number of unique visitors</span>
                <span class="fs-2hx fw-bold text-gray-900" data-kt-countup="true"
                    data-kt-countup-value="{{ $unique }}">{{ $unique }}</span>
            </div>
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col">
            <div class="border border-dashed border-gray-300 text-center min-w-125px rounded pt-4 pb-2 my-3">
                <span class="fs-4 fw-semibold text-primary d-block">Number of total views</span>
                <span class="fs-2hx fw-bold text-gray-900" data-kt-countup="true"
                    data-kt-countup-value="{{ $total }}">{{ $total }}</span>
            </div>
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col">
            <div class="border border-dashed border-gray-300 text-center min-w-125px rounded pt-4 pb-2 my-3">
                <span class="fs-4 fw-semibold text-danger d-block">Total points</span>
                <span class="fs-2hx fw-bold text-gray-900" data-kt-countup="true"
                    data-kt-countup-value="{{ $referals['total'] }}">{{ $referals['total'] }}</span>
            </div>
        </div>
        <!--end::Col-->
    </div>

    <div class="row p-0 mb-5 px-9">
        <!--begin::Alert-->
        <div class="alert alert-primary d-flex align-items-center p-5">
            <!--begin::Icon-->

            <!--begin::Wrapper-->
            <div class="d-flex flex-column">
                <!--begin::Title-->
                <h4 class="mb-1 text-mute">Your reference link</h4>
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
    </div>


    <div class="card card-bordered">
        <div class="card-body">
            <div id="kt_apexcharts_1" style="height: 350px;"></div>
        </div>
    </div>


    @push('scripts')
        <script src="js/app.js"></script>
        <script>
            // Select elements
            const target = document.getElementById('kt_clipboard_1');
            const button = target.nextElementSibling;

            // Init clipboard -- for more info, please read the offical documentation: https://clipboardjs.com/
            var clipboard = new ClipboardJS(button, {
                target: target,
                text: function() {
                    return target.value;
                }
            });

            // Success action handler
            clipboard.on('success', function(e) {
                const currentLabel = button.innerHTML;

                // Exit label update when already in progress
                if (button.innerHTML === 'Copied!') {
                    return;
                }

                // Update button label
                button.innerHTML = 'Copied!';

                // Revert button label after 3 seconds
                setTimeout(function() {
                    button.innerHTML = currentLabel;
                }, 3000)
            });
        </script>

        <script>
            var element = document.getElementById('kt_apexcharts_1');

            var height = parseInt(KTUtil.css(element, 'height'));
            var labelColor = KTUtil.getCssVariableValue('--kt-gray-500');
            var borderColor = KTUtil.getCssVariableValue('--kt-gray-200');
            var baseColor = KTUtil.getCssVariableValue('--kt-primary');
            var secondaryColor = KTUtil.getCssVariableValue('--kt-gray-300');

            var options = {
                series: [{
                    name: 'Total Points',
                    data: @json($referals['values'])
                }],
                chart: {
                    fontFamily: 'inherit',
                    type: 'bar',
                    height: height,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: ['30%'],
                        endingShape: 'rounded'
                    },
                },
                legend: {
                    show: false
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: @json($referals['keys']),
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    }
                },
                fill: {
                    opacity: 1
                },
                states: {
                    normal: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    hover: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    active: {
                        allowMultipleDataPointsSelection: false,
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    }
                },
                tooltip: {
                    style: {
                        fontSize: '12px'
                    },
                    y: {
                        formatter: function(val) {
                            return val + ' points'
                        }
                    }
                },
                colors: [baseColor, secondaryColor],
                grid: {
                    borderColor: borderColor,
                    strokeDashArray: 4,
                    yaxis: {
                        lines: {
                            show: true
                        }
                    }
                }
            };

            var chart = new ApexCharts(element, options);
            chart.render();
        </script>
    @endpush
@endsection
