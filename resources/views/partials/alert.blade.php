@if (session('deny'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('deny') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif