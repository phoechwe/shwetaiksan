@props([
    'disabled' => false,
    'error' => false,
    'list' => [],
    'selectedValue' => [],
    'selectedLabels' => [],
    'placeholder' => 'Please Select',
])

<div>
    <div class="relative text-black" x-data="{
        state: false,
        filter: '',
        list: {{ json_encode($list) }},
        selectedKeys: @entangle($selectedValue),
        selectedLabels: [],

        init() {
            // Ensure keys are strings
            this.selectedKeys = this.selectedKeys.map(k => String(k));
            this.updateSelectedLabels();
        },

        updateSelectedLabels() {
            this.selectedLabels = this.selectedKeys
                .map(id => this.list[id])
                .filter(label => label !== undefined);
        },

        select(value, key) {
            key = String(key);
            let index = this.selectedKeys.indexOf(key);
            if (index === -1) {
                this.selectedKeys.push(key);
                this.selectedLabels.push(value);
            } else {
                this.selectedKeys.splice(index, 1);
                this.selectedLabels.splice(index, 1);
            }
        },

        isSelected(key) {
            return this.selectedKeys.includes(String(key));
        },

        toggle() {
            this.state = !this.state;
            this.filter = '';
        },

        close() {
            this.state = false;
        },

        getFilteredList() {
            if (this.filter === '') return this.list;
            return Object.fromEntries(
                Object.entries(this.list).filter(([_, value]) =>
                    value.toLowerCase().includes(this.filter.toLowerCase())
                )
            );
        }
    }" @click.away="close()">

        <input type="hidden" x-model="selectedKeys" name="selectfield" id="selectfield">

        <span class="inline-block w-full rounded-md shadow-sm" @click="toggle()">
            <div {!! $attributes->merge([
                'class' =>
                    'bg-gray-50 border text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 ' .
                    ($error
                        ? 'border-red-500 focus:ring-red-500 dark:border-red-500 focus:border-red-500'
                        : 'border-gray-300 focus:ring-primary-500 focus:border-primary-500') .
                    ' dark:bg-gray-700 dark:border-gray-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500',
            ]) !!}>
                <span class="block truncate"
                    x-text="selectedLabels.length ? selectedLabels.join(', ') : '{{ $placeholder }}'"></span>
                <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" viewBox="0 0 20 20" fill="none" stroke="currentColor">
                        <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </span>
            </div>
        </span>

        <div x-show="state" class="absolute z-10 w-full mt-1 bg-white rounded-md shadow-lg p-2">
            <input type="text" class="w-full rounded-md py-1 px-2 mb-1 border border-gray-400" x-model="filter"
                x-ref="filterinput">

            <ul class="py-1 overflow-auto text-base leading-6 rounded-md shadow-xs max-h-60 focus:outline-none">
                <template x-for="(value, key) in getFilteredList()" :key="key">
                    <li @click="select(value, key)" :class="{ 'bg-gray-100': isSelected(key) }"
                        class="relative py-1 pl-3 pr-9 mb-1 text-gray-900 select-none cursor-pointer rounded-md">
                        <span x-text="value" class="block font-normal truncate"></span>
                        <span x-show="isSelected(key)"
                            class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-700">
                            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                    </li>
                </template>
            </ul>
        </div>
    </div>
</div>
