@props(['color'=>'gray','name',"placeholder"=>'Select ...','options'=>[],'value'=>''])

<div
        x-data="tagInputHandler({ data: { @foreach ($options as $k=>$item) {{$k}}:'{{$item}}', @endforeach }
        , emptyOptionsMessage: 'No results found.'
        , name: '{{$name}}'
        , value: '{{$value}}'
        , placeholder: '{{$placeholder}}' })"
        x-init="init()"
        @click.away="closeListbox()"
        @keydown.escape="closeListbox()"
        class="relative"
>
    <div class="flex justify-start">
        <div class="flex flex-wrap border-top border border-gray-300 rounded">
            <template x-for="(item, index) in selected" :key="index">
                <div class="flex justify-center items-center m-1 font-medium py-1 px-2 bg-white rounded-full text-{{$color}}-700 bg-{{$color}}-100 border border-{{$color}}-300 ">
                    <div class="text-xs font-normal leading-none max-w-full flex-initial" x-text="item"></div>
                    <div class="flex flex-auto flex-row-reverse">
                        <div @click="removeItem(index)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round"
                                 class="feather feather-x cursor-pointer hover:text-teal-400 rounded-full w-4 h-4 ml-2">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </div>
                    </div>
                </div>
            </template>
        </div>
        <div>
    <span class="rounded-md shadow-sm">
                      <button
                              x-ref="button"
                              @click="toggleListboxVisibility()"
                              :aria-expanded="open"
                              aria-haspopup="listbox"
                              class="relative z-0 w-full py-2 pl-3 pr-10 text-left transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md cursor-default focus:outline-none focus:shadow-outline-blue focus:border-blue-300 sm:text-sm sm:leading-5"
                      >
                            <span x-show="! open" x-text="placeholder" class="block truncate"></span>
                            <input
                                    x-ref="search"
                                    x-show="open"
                                    x-model="search"
                                    @keydown.enter.stop.prevent="selectOption()"
                                    @keydown.arrow-up.prevent="focusPreviousOption()"
                                    @keydown.arrow-down.prevent="focusNextOption()"
                                    type="search"
                                    class="w-full h-full focus:outline-none"
                            />

                            <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" viewBox="0 0 20 20" fill="none"
                                     stroke="currentColor">
                                    <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" stroke-width="1.5" stroke-linecap="round"
                                          stroke-linejoin="round"></path>
                                </svg>
                            </span>
                      </button>
                </span>
        </div>
    </div>
    <div
            x-show="open"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            x-cloak
            class="absolute z-10 w-full mt-1 bg-white rounded-md shadow-lg"
    >
        <ul
                x-ref="listbox"
                @keydown.enter.stop.prevent="selectOption()"
                @keydown.arrow-up.prevent="focusPreviousOption()"
                @keydown.arrow-down.prevent="focusNextOption()"
                role="listbox"
                :aria-activedescendant="focusedOptionIndex ? name + 'Option' + focusedOptionIndex : null"
                tabindex="-1"
                class="py-1 overflow-auto text-base leading-6 rounded-md shadow-xs max-h-60 focus:outline-none sm:text-sm sm:leading-5"
        >
            <template x-for="(key, index) in Object.keys(options)" :key="index">
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
                                <span x-text="Object.keys(options)[index]+' '+Object.values(options)[index]"
                                      :class="{ 'font-semibold': index === focusedOptionIndex, 'font-normal': index !== focusedOptionIndex }"
                                      class="block font-normal truncate"
                                ></span>
                </li>
            </template>

            <div
                    x-show="! Object.keys(options).length"
                    x-text="emptyOptionsMessage"
                    class="px-3 py-2 text-gray-900 cursor-default select-none"></div>
        </ul>
    </div>
    <input type="hidden" x-model="selected.join(',')" name="{{$name}}">
</div>
