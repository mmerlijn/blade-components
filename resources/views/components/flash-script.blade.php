<script>
    {{--Aanroepen door: session()->flash('succes','bericht');--}}
            @if(session('success'))
        window.onload = function () {
        flashSuccess('{{session('success')}}');
    }
    @endif
            @if(session('danger'))
        window.onload = function () {
        flashDanger('{{session('danger')}}');
    }
    @endif
            @if(session('warning'))
        window.onload = function () {
        flashWarning('{{session('warning')}}');
    }
    @endif
            @if(session('notice'))
        window.onload = function () {
        flashNotice('{{session('notice')}}');
    }
    @endif
</script>