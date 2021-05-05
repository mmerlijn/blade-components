{{--
<div class="flex items-center justify-center h-screen w-screen">
    <button x-data="{}"
            @click="$dispatch('notice', {type: 'success', text: '🔥 Success!'})"
            class="m-4 bg-green-500 text-lg font-bold p-6 py-2 text-white shadow-md rounded">
        Success
    </button>
    <button x-data="{}"
            @click="$dispatch('notice', {type: 'info', text: 'ᕦ(ò_óˇ)ᕤ'})"
            class="m-4 bg-blue-500 text-lg font-bold p-6 py-2 text-white shadow-md rounded">
        Info
    </button>
    <button x-data="{}"
            @click="$dispatch('notice', {type: 'warning', text: '⚡ Warning'})"
            class="m-4 bg-orange-500 text-lg font-bold p-6 py-2 text-white shadow-md rounded">
        Warning
    </button>
    <button x-data="{}"
            x-on:click="$dispatch('notice', {type: 'error', text: '😵 Error!'})"
            class="m-4 bg-red-500 text-lg font-bold p-6 py-2 text-white shadow-md rounded">
        Error
    </button>
</div>
--}}
{{--
<div
    x-data="noticesHandler()"
    class="fixed inset-0 flex flex-col-reverse items-end justify-start h-screen w-screen"
    @notice.window="add($event.detail)"
    style="pointer-events:none">
    <template x-for="notice of notices" :key="notice.id">
        <div
            x-show="visible.includes(notice)"
            x-transition:enter="transition ease-in duration-200"
            x-transition:enter-start="transform opacity-0 translate-y-2"
            x-transition:enter-end="transform opacity-100"
            x-transition:leave="transition ease-out duration-500"
            x-transition:leave-start="transform translate-x-0 opacity-100"
            x-transition:leave-end="transform translate-x-full opacity-0"
            @click="remove(notice.id)"
            class="rounded mb-4 mr-6 w-56  h-16 flex items-center justify-center text-white shadow-lg font-bold text-lg cursor-pointer"
            :class="{
				'bg-green-500': notice.type === 'success',
				'bg-blue-500': notice.type === 'info',
				'bg-orange-500': notice.type === 'warning',
				'bg-red-500': notice.type === 'error',
			 }"
            style="pointer-events:all"
            x-text="notice.text">
        </div>
    </template>
</div>
--}}

{{-- window.toast = message => window.dispatchEvent(new CustomEvent('notice', {detail: message,type:'success'})) --}}
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
                    <span  x-html="getIcon(flash)"></span>
                </div>
                <div class="text-white max-w-xs " x-text="flash.text">
                </div>
            </div>
        </template>
    </div>
</div>

{{--
<script>
    window.toast = message => window.dispatchEvent(new CustomEvent('toast', {detail: {message}}))


</script>
--}}
