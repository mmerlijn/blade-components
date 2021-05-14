@props(['name','options'=>[],'value'=>'','placeholder'=>'Select item','key'=>'k','display'=>'d'])
@php
    $classes = $errors->first($name)
    ? "rounded border-red-600"
    : "rounded border-gray-300 ";
@endphp
<div
        x-data="autocompleteHandler2({ data: {{ $options }}
                ,emptyOptionsMessage: 'No results found.'
                , name: '{{$name}}'
                    , key: '{{$key}}'
             , display: '{{$display}}'
            , placeholder: '{{$placeholder}}'
             , value: '{{$value}}'})"
        x-init="init()"
        @click.away="closeListbox()"
        @keydown.escape="closeListbox()"
        {{ $attributes->merge(['class' => 'inline-flex items-start relative rounded border rounded '.$classes])->only('class')}}
>
    <div class="flex justify-items-end">
                <span class="rounded-md shadow-sm h-full w-72">
                      <div
                              x-ref="button"
                              @click="toggleListboxVisibility()"
                              :aria-expanded="open"
                              aria-haspopup="listbox"
                              class="relative z-0 w-full h-full  transition duration-150 ease-in-out bg-white cursor-default flex justify-items-end"
                      >
                            <span
                                    x-show="! open"
                                    x-text="(value!=='') ? show.{{$display}} : placeholder"
                                    :class="{ 'text-gray-500': ! (value in options) }"
                                    class="block truncate pl-4 w-full py-1"
                            ></span>

                            <input
                                    x-ref="search"
                                    x-show="open"
                                    x-model="search"
                                    @keydown.enter.stop.prevent="selectOption()"
                                    @keydown.arrow-up.prevent="focusPreviousOption()"
                                    @keydown.arrow-down.prevent="focusNextOption()"
                                    type="search"
                                    class="rounded h-full w-full pl-4"
                            />

                            <span class="absolute inset-y-0 right-0 flex items-center pr-1 cursor-pointer">
                                <svg class="w-5 h-5 text-gray-400" viewBox="0 0 20 20" fill="none"
                                     stroke="currentColor">
                                    <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" stroke-width="1.5" stroke-linecap="round"
                                          stroke-linejoin="round"></path>
                                </svg>
                            </span>
                      </div>
                </span>

        <div
                x-show="open"
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                x-cloak
                class="absolute z-10 mt-12 w-full bg-white rounded-md shadow-lg"
        >
            <ul
                    x-ref="listbox"
                    @keydown.enter.stop.prevent="selectOption()"
                    @keydown.arrow-up.prevent="focusPreviousOption()"
                    @keydown.arrow-down.prevent="focusNextOption()"
                    role="listbox"
                    :aria-activedescendant="focusedOptionIndex ? name + 'Option' + focusedOptionIndex : null"
                    tabindex="-1"
                    class="py-1 overflow-auto text-base leading-6 rounded-md shadow-xs max-h-60 focus:outline-none leading-5"
            >
                <template x-for="(item, index) in options" :key="index">
                    <li
                            :id="name + 'Option' + focusedOptionIndex"
                            @click="selectOption()"
                            @mouseenter="focusedOptionIndex = index"
                            @mouseleave="focusedOptionIndex = null"
                            role="option"
                            :aria-selected="focusedOptionIndex === index"
                            :class="{ 'text-white bg-indigo-600': index === focusedOptionIndex, 'text-gray-900': index !== focusedOptionIndex }"
                            class="relative py-2 pl-3 text-gray-900 cursor-default select-none pr-8"
                    >
                                <span x-text="item.{{$display}}"
                                      :class="{ 'font-semibold': index === focusedOptionIndex, 'font-normal': index !== focusedOptionIndex }"
                                      class="block font-normal truncate"
                                ></span>

                        <span
                                x-show="item.{{$key}} === value"
                                :class="{ 'text-white': index === focusedOptionIndex, 'text-indigo-600': index !== focusedOptionIndex }"
                                class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600"
                        >
                                    <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                              d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </span>
                    </li>
                </template>

                <div
                        x-show="! Object.keys(options).length"
                        x-text="emptyOptionsMessage"
                        class="px-3 py-2 text-gray-900 cursor-default select-none"></div>
            </ul>
        </div>
        <input type="hidden" x-model="value" name="{{$name}}" {{ $attributes->except('class')}}>
    </div>
</div>

<script>
    window.autocompleteHandler2 =     function(config) {
        return {
            data: config.data,

            emptyOptionsMessage: config.emptyOptionsMessage ?? 'No results found.',

            focusedOptionIndex: null,

            name: config.name,

            open: false,

            options: [],

            placeholder: config.placeholder ?? 'Select an option',

            search: '',

            value: config.value,
            show: {},
            k: config.key??'k',
            d: config.display ??'d',

            closeListbox: function () {
                this.open = false

                this.focusedOptionIndex = null

                this.search = ''
            },

            focusNextOption: function () {
                if (this.focusedOptionIndex === null) return this.focusedOptionIndex = 0

                if (this.focusedOptionIndex + 1 >= Object.keys(this.options).length) return

                this.focusedOptionIndex++

                this.$refs.listbox.children[this.focusedOptionIndex].scrollIntoView({
                    block: "center",
                })
            },

            focusPreviousOption: function () {
                if (this.focusedOptionIndex === null) return this.focusedOptionIndex = Object.keys(this.options).length - 1

                if (this.focusedOptionIndex <= 0) return

                this.focusedOptionIndex--

                this.$refs.listbox.children[this.focusedOptionIndex].scrollIntoView({
                    block: "center",
                })
            },

            init: function () {
                this.data = _.sortBy(this.data,this.d)
                this.options = this.data

                if(this.value) {
                    if (!this.data.some(item => item[this.k] === this.value)) {
                        this.value = '';
                    } else {
                        this.show = this.data.find(item => item.k === this.value)
                    }
                }
                this.$watch('search', ((value) => {
                    if (!this.open || !value) return this.options = this.data

                    this.options = this.data
                        .reduce((result=[],dataItem) => {
                            if(dataItem[this.d].toLowerCase().includes(value.toLowerCase())){
                                result.push(dataItem)
                            }
                            return result
                        }, [])
                }))
            },

            selectOption: function () {
                if (!this.open) return this.toggleListboxVisibility()

                this.value = this.options[this.focusedOptionIndex][this.k]
                this.show = this.options[this.focusedOptionIndex];
                this.closeListbox()
            },

            toggleListboxVisibility: function () {
                if (this.open) return this.closeListbox()

                this.focusedOptionIndex = Object.keys(this.options).indexOf(this.value)

                if (this.focusedOptionIndex < 0) this.focusedOptionIndex = 0

                this.open = true

                this.$nextTick(() => {
                    this.$refs.search.focus()

                    this.$refs.listbox.children[this.focusedOptionIndex+1].scrollIntoView({
                        block: "nearest"
                    })
                })
            },
        }
    }


</script>