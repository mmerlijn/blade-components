@props(['nonce'=>''])
<div x-data="flashesHandler()" @toast.window="add($event.detail)">

    <div class="fixed right-0 bottom-0 mb-5 mr-6 md:w-1/2">
        <template x-for="flash of flashes" :key="flash.id">
            <div
                    x-show="visible.includes(flash)"
                    x-transition:enter="transition ease-in duration-200"
                    x-transition:enter-start="transform opacity-0 translate-y-2"
                    x-transition:enter-end="transform opacity-100"
                    x-transition:leave="transition ease-out duration-500"
                    x-transition:leave-start="transform translate-x-0 opacity-100"
                    x-transition:leave-end="transform translate-x-full opacity-0"
                    @click="remove(flash.id)"

                    style="pointer-events:all"
                    class="flex items-center text-white font-bold rounded-t py-2 px-3 shadow-md mb-2 border-l-4"
                    :class="{
                    'bg-green-500 border-green-700': flash.type === 'success',
                    'bg-blue-500 border-blue-700': flash.type === 'notice',
                    'bg-orange-400 border-orange-700': flash.type === 'warning',
                    'bg-red-500 border-red-700': flash.type === 'danger',
                    }"
            >
                <div class="rounded-full bg-white mr-3"
                     :class="{
                    'text-green-500 ': flash.type === 'success',
                    'text-blue-500': flash.type === 'notice',
                    'text-orange-400': flash.type === 'warning',
                    'text-red-500': flash.type === 'danger',
                    }"
                >
                    <span x-html="getIcon(flash)"></span>
                </div>
                <div class="text-white max-w-xs " x-text="flash.text">
                </div>
            </div>
        </template>
    </div>
</div>
<script {{$nonce?"nonce='$nonce'":''}}>
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
