<div class="container my-3">
    @if (session()->has("success"))
        <div class="col-xl-6 m-auto alert-success text-center">{{ session()->get("success") }}</div>
    @elseif(session()->has("error"))
        <div class="col-xl-6 m-auto alert-danger text-center">{{ session()->get("error") }}</div>
    @endif
</div>
