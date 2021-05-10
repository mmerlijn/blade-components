{{-- https://github.com/livewire/livewire/issues/180 --}}
@props(['name'=>'foo','color'=>'gray'])
<div>
    {{ $trigger??''}}

    <div id="modal-{{ $name }}" class="fixed inset-0 z-50 flex justify-center items-center">
        <a href="#" class="cursor-default absolute bg-gray-800 inset-0 opacity-50 z-60"></a>
        <div class="fixed bg-{{$color}}-100 border border-gray-700 p-8 rounded shadow z-70 overflow-y-auto overflow-x-auto max-h-screen">
            <a href="#" class="absolute hover:text-gray-300 p-1 right-0 text-gray-500 top-0">
                <svg class="w-8" viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </a>

            {{ $slot }}
        </div>
    </div>

    @push('styles')
        <style>
            #modal-{{ $name }} {
                opacity: 0;
                visibility: hidden;
                transition: opacity .15s ease-in-out;
            }
            #modal-{{ $name }}:target {
                opacity: 1;
                visibility: visible;
            }
        </style>
    @endpush


    @push('scripts')
        <script>
            var modal{{ Illuminate\Support\Str::studly($name) }} = {
                init: function () {
                    // Call onOpen and onClose hooks when hash in URL is changed.
                    window.addEventListener('hashchange', e => {
                        if (this.urlIsOnModal(e.newURL)) {
                            this.onOpen()
                        } else if (this.urlIsOnModal(e.oldURL)) {
                            this.onClose()
                        }
                    })

                    // Call onOpen hook if the model is shown on page load.
                    document.addEventListener('DOMContentLoaded', () => {
                        if (window.location.hash === '#modal-{{ $name }}') {
                            setTimeout(this.onOpen.bind(this), 500)
                        }
                    })
                },

                onOpen: function () {
                    this.triggerAutofocusInputs()

                    window.addEventListener('keydown', this.closeOnEscHandler.bind(this))
                },

                onClose: function () {
                    window.removeEventListener('keydown', this.closeOnEscHandler.bind(this))
                },

                closeOnEscHandler: function (e) {
                    if (e.keyCode == 27) {
                        this.close()
                    }
                },

                close: function () {
                    window.location.hash = '#'
                },

                urlIsOnModal: function (url) {
                    return url.match(/#modal-{{ $name }}/)
                },

                triggerAutofocusInputs: function () {
                    var el = find('#modal-{{ $name }}').querySelector('[autofocus]')
                    if (el) el.focus()
                },
            }

            modal{{ Illuminate\Support\Str::studly($name) }}.init()
        </script>
    @endpush
</div>
