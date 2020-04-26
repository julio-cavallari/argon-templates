<style scoped>
</style>

<template>
  <div class="form-group">
    <label
      v-if="title"
      :for="realId"
      :class="{'form-control-label': true, 'is-required': required}"
    >
      {{ title }}
    </label>
    <toggle-button
      :id="realId"
      :name="name"
      :class="inputClass"
      :labels="labels"
      :value="value"
      @input="event => { $emit('input', event) }"
    />
  </div>
</template>

<script>
import { ToggleButton } from 'vue-js-toggle-button';

export default {

  components: {
    ToggleButton
  },

  props: {
    value: {
      type: Boolean,
      default: false,
    },
    title: {
      type: String,
      default: '',
    },
    labels: {
      type: [Boolean, Object],
      default: false,
    },
    id: {
      type: String,
      default: '',
    },
    name: {
      type: String,
      default: '',
    },
    required: {
      type: Boolean,
      default: true,
    },
    iclass: {
      type: String,
      default: ''
    },
  },

  computed: {
    realId() {
      return this.id + this._uid;
    },
    inputClass() {
      return this.iclass != '' ? this.iclass : '';
    },
  },
};
</script>
