@if (session('danger'))

    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="material-icons mr-1">error</i> {{ session('danger') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

@elseif (session('success'))

	<div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="material-icons mr-1">info</i> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

@elseif (session('status'))

	<div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="material-icons mr-1">info</i> {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

@endif