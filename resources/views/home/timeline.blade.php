@extends('templates.default')

@section('content')

    <!--Posting Status-->
    <div class="row">
        <!--Col-->
        <div class="col-lg-6 col-lg-offset-3">
            <a href="/feedback" class="link">
                <div class="alert alert-warning">Bir terslik bi farkettin. Hemen tıkla ve geri bildirim yolla.</div>
            </a>
            <section class="posting">
                @include('users.header.partials.posting')
            </section>
            <!-- Change Sharing Platform -->
            @include('home.partials.shareAt')

        </div>
        <!--/ Col-->
    </div>
    <!--Ending of Posting Status-->

    <br>

    <!--Statuses-->
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            <section class="results">
                @include('statuses.load')
            </section>
        </div>
    </div>
    <!--Ending of Statuses-->

@endsection
