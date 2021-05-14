@props(['color'=>'gray','name',"placeholder"=>'Select ...','options'=>[],'value'=>'','display'=>'d','label'=>'l'])
@php
    $classes = $errors->first($name)
    ? "rounded border-red-600"
    : "rounded border-gray-300 ";
@endphp
<div
        x-data="tagInputHandler({ data: {!! $options !!}
                , emptyOptionsMessage: 'No results found.'
                , name: '{{$name}}'
        , value: '{{$value}}'
        , placeholder: '{{$placeholder}}'
        , key: '{{$key??$label}}'
        , label: '{{$label}}'
        , display: '{{$display}}'
         })"
        x-init="init()"
        @click.away="closeListbox()"
        @keydown.escape="closeListbox()"
        {{ $attributes->merge(['class' => 'inline-flex items-start relative '.$classes.' rounded '])}}
>
    <div class="flex justify-items-end w-full">
        <div class="flex flex-wrap max-w-full">
            <template x-for="(item, index) in selected" :key="index">
                <div class="flex justify-center items-center m-1 py-1 px-2 bg-white rounded-lg text-{{$color}}-700 bg-{{$color}}-100 border border-{{$color}}-300 ">
                    <div class=" leading-none max-w-full flex-initial" x-text="item"></div>
                    <div class="flex flex-auto flex-row-reverse">
                        <div @click="removeItem(index)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round"
                                 class="cursor-pointer hover:text-{{$color}}-400 hover:bg-{{$color}}-600 rounded-full text-{{$color}}-700 bg-{{$color}}-400 w-4 h-4 ml-2">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </div>
                    </div>
                </div>
            </template>
        </div>
        <span class="rounded-md shadow-sm h-full w-72">
                      <div
                              x-ref="button"
                              @click="toggleListboxVisibility()"
                              :aria-expanded="open"
                              aria-haspopup="listbox"
                              class="relative z-0 w-full h-full transition duration-150 ease-in-out bg-white cursor-default flex justify-items-end"
                      >
                            <span x-show="! open" x-text="placeholder" class="pl-4 block truncate w-full py-1"></span>
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

                            <span class="inset-y-0 right-0 flex items-center pr-1 cursor-pointer">
                                <svg class="w-5 h-5 text-gray-400" viewBox="0 0 20 20" fill="none"
                                     stroke="currentColor">
                                    <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" stroke-width="1.5" stroke-linecap="round"
                                          stroke-linejoin="round"></path>
                                </svg>
                            </span>
                      </div>
                </span>
    </div>

    <div
            x-show="open"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            x-cloak
            class="absolute mt-12 z-10 w-full bg-white rounded-md shadow-lg"
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
                        class="relative py-2 pl-3 text-gray-900 cursor-default select-none pr-9"
                >
                                <span
                                        x-text="item.{{$display}}"
                                        :class="{ 'font-semibold': index === focusedOptionIndex, 'font-normal': index !== focusedOptionIndex }"
                                        class="block font-normal truncate"
                                ></span>
                </li>
            </template>

            <div
                    x-show="!options.length"
                    x-text="emptyOptionsMessage"
                    class="px-3 py-2 text-gray-900 cursor-default select-none"></div>
        </ul>
    </div>
    <input type="hidden" x-model="selected.join(',')" name="{{$name}}">
</div>