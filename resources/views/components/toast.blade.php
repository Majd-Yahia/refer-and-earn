@isset($message)
    <!--begin::Toast-->
    <div class="position-fixed top-0 end-0 p-3 z-index-9" style="z-index: 99999">
        <div id="kt_docs_toast_toggle" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <span class="svg-icon svg-icon-2 svg-icon-primary me-3">...</span>
                <strong class="me-auto">System</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ $message }}
            </div>
        </div>
    </div>
    <!--end::Toast-->
@endisset
