<template>
  <form @submit.prevent="submitForm" class="flex flex-col space-y-2 md:flex-row md:space-y-0 md:space-x-2 md:items-center">
    <input
        type="text"
        name="string"
        v-model="searchParams.string"
        placeholder="Search..."
        class="flex-1 px-4 py-2 border border-gray-300 rounded md:max-w-xs"
    />
    <input
        type="number"
        name="pagesMin"
        v-model.number="searchParams.pagesMin"
        placeholder="Pages from"
        class="flex-1 px-4 py-2 border border-gray-300 rounded md:max-w-xs"
    />
    <input
        type="number"
        name="pagesMax"
        v-model.number="searchParams.pagesMax"
        placeholder="Pages to"
        class="flex-1 px-4 py-2 border border-gray-300 rounded md:max-w-xs"
    />
    <button
        type="submit"
        class="px-4 py-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded md:w-auto"
    >
      Search
    </button>
  </form>
</template>

<script setup>
import { computed, toRefs, watch } from 'vue';

const emit = defineEmits(['update:modelValue', 'search']);

const props = defineProps({
  modelValue: {
    type: Object,
    default: () => ({ string: '', pagesMin: null, pagesMax: null })
  }
});

const searchParams = computed({
  get: () => props.modelValue,
  set: val => emit('update:modelValue', val)
});

const { string, pagesMin, pagesMax } = toRefs(searchParams.value);

watch([string, pagesMin, pagesMax], () => {
  emit('update:modelValue', { string: string.value, pagesMin: pagesMin.value, pagesMax: pagesMax.value });
});

const submitForm = () => {
  emit('search', { string: string.value, pagesMin: pagesMin.value, pagesMax: pagesMax.value });
}
</script>
