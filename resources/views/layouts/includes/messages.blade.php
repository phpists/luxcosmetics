<style>
    .alert {
        display: block;
        padding: 0.5rem 1rem;
        border: 1px solid transparent;
        font-size: 85%;
        line-height: 1.5;
        max-width: 1300px;
        margin: 30px auto 20px auto;
        border-radius: .5rem;
    }

    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
    }

    .alert-danger {
        color: #571515;
        background-color: #edd4d4;
        border-color: #e6c3c3;
    }

    .rounded-0 {
        border-radius: 0;
    }

    .small {
        font-size: 85%;
    }

    .py-2 {
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
    }

</style>
<div class="validation_messages">
    @if(session()->get('success'))
        <div class="alert alert-success mb-0 small py-2">
            {{ session()->get('success') }}
        </div>
    @endif
    @if(session()->get('error'))
        <div class="alert alert-danger mb-0 small py-2">
            {{ session()->get('error') }}
        </div>
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
        @endforeach
    @endif
</div>
{{--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">--}}
{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>--}}





