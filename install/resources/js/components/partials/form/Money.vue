<template>
  <div class="form-group">
    <label
      v-if="title"
      :for="realId"
      :class="{'form-control-label': true, 'is-required': required}"
    >
      {{ title }}
    </label>

    <input :id="id" :name="name" type="hidden" :value="exchange" />
    <money
      v-model="exchange"
      v-bind="money"
      :placeholder="placeholder"
      :class="inputClass"
      :style="istyle"
      :id="realId"
      :required="required"
    />
  </div>
</template>

<script>

import {Money} from 'v-money'

export default {
  components: {Money},

  props: {
    value: {
      type: [String, Number],
      default: '',
    },
    title: {
      type: String,
      default: '',
    },
    label: {
      type: String,
      default: null,
    },
    id: {
      type: String,
      default: '',
    },
    name: {
      type: String,
      default: '',
    },
    placeholder: {
      type: String,
      default: '',
    },
    required: {
      type: Boolean,
      default: true,
    },
    istyle: {
      type: [String],
      default: ''
    },
    iclass: {
      type: [String, Array],
      default: ''
    },
    error: {
      type: [String],
      default: ''
    },
  },

  data() {
    return {
      exchange: this.value,
      money: {
        decimal: ',',
        thousands: '.',
        prefix: 'R$ ',
        suffix: '',
        precision: 2,
        masked: false
      }
    }
  },

  computed: {
    realId() {
      return this.id + this._uid;
    },
    inputClass() {
      var c = [this.iclass != '' ? this.iclass : 'form-control'];
      c.push({ 'is-invalid': this.error });
      return c;
    },
  },
};
</script>
