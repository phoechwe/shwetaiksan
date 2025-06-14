@props([
    'disabled' => false,
    'error' => false,
    'list' => [],
    'selectedValue' => null,
    'placeholder' => 'Please Select',
])

<div>
    <div class="relative" x-data="{
        state: false,
        filter: '',
        list: {{ json_encode($list) }},
        selectedKey: @entangle($selectedValue),
        selectedLabel: '',
    
        init() {
            this.selectedKey = this.selectedKey ? String(this.selectedKey) : '';
            this.updateSelectedLabel();
        },
    
        updateSelectedLabel() {
            this.selectedLabel = this.list[this.selectedKey] ?? '';
        },
    
        select(value, key) {
            this.selectedKey = String(key);
            this.selectedLabel = value;
            this.close();
        },
    
        isSelected(key) {
            return this.selectedKey === String(key);
        },
    
        toggle() {
            this.state = !this.state;
            this.filter = '';
            this.$nextTick(() => this.$refs.filterinput?.focus());
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
        <input type="hidden" x-model="selectedKey" name="selectfield" id="selectfield">

        <span class="inline-block w-full rounded-md shadow-sm" @click="toggle()">
            <div {!! $attributes->merge([
                'class' =>
                    'block w-full p-2.5 rounded-lg border sm:text-sm cursor-pointer ' .
                    ($error
                        ? 'border-red-500 dark:border-red-500 focus:ring-red-500 focus:border-red-500'
                        : 'border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:border-gray-600 dark:focus:ring-primary-500 dark:focus:border-primary-500') .
                    ' bg-white text-black placeholder-gray-500 dark:bg-gray-800 dark:text-white dark:placeholder-gray-400',
            ]) !!}>
                <span class="block truncate" x-text="selectedLabel ? selectedLabel : '{{ $placeholder }}'"></span>
                <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400 dark:text-gray-300" viewBox="0 0 20 20" fill="none" stroke="currentColor">
                        <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </span>
            </div>
        </span>

        <div x-show="state"
            class="absolute z-10 w-full mt-1 rounded-md shadow-lg p-2 bg-white border border-gray-300 dark:bg-gray-800 dark:border-gray-600">
            <input type="text"
                class="w-full rounded-md py-1 px-2 mb-2 border border-gray-300 bg-white text-black placeholder-gray-500 focus:outline-none focus:ring focus:ring-primary-500 dark:bg-gray-900 dark:text-white dark:placeholder-gray-400 dark:border-gray-600"
                x-model="filter" x-ref="filterinput">

            <ul class="py-1 overflow-auto text-base leading-6 rounded-md max-h-60 focus:outline-none">
                <template x-for="(value, key) in getFilteredList()" :key="key">
                    <li @click="select(value, key)" :class="{ 'bg-gray-200 dark:bg-gray-700': isSelected(key) }"
                        class="relative py-1 pl-3 pr-9 mb-1 select-none cursor-pointer rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 text-black dark:text-white">
                        <span x-text="value" class="block font-normal truncate"></span>
                        <span x-show="isSelected(key)"
                            class="absolute inset-y-0 right-0 flex items-center pr-4 text-green-500">
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
