@if (session('message'))
    <div class="bs-toast toast toast-ex animate__animated my-2 fade {{ session('message')['status'] == true ? 'animate__pulse' : 'animate__shakeX' }}  show"
        role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="mdi mdi-home me-2 {{ session('message')['status'] == true ? 'text-primary' : 'text-danger' }}"></i>
            <div class="me-auto fw-medium">{{ session('message')['status'] == true ? 'Success' : 'Error' }}</div>
            <small class="text-muted">{{ now() }}</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">{{ session('message')['content'] }}</div>
    </div>
@endif
