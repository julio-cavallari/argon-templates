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
    <the-mask
      :mask="mask"
      v-model="exchange"
      :id="realId"
      ref="input"
      :type="inputType"
      :placeholder="placeholder"
      :class="inputClass"
      :style="istyle"
      :required="required"
    />
  </div>
</template>

<script>
import {TheMask} from 'vue-the-mask'

export default {
  components: {TheMask},

  props: {
    value: {
      type: [String, Number],
      default: '',
    },
    title: {
      type: String,
      default: '',
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
    mask: {
      type: [String, Array],
      default: '',
    },
    required: {
      type: Boolean,
      default: true,
    },
    inputType: {
      type: String,
      default: 'tel',
    },
    istyle: {
      type: String,
      default: '',
    },
    iclass: {
      type: [String, Array],
      default: ''
    },
    maxlength: {
      type: Number,
      default: null,
    },
    error: {
      type: String,
      default: '',
    },
  },

  data() {
    return {
      exchange: this.value,
    }
  },

  computed: {
    realId() {
      var id = this.id != '' ? this.id : this.name;
      return id + this._uid;
    },
    inputClass() {
      var c = [this.iclass != '' ? this.iclass : 'form-control'];
      c.push({ 'is-invalid': this.error });
      return c;
    },
    field() {
      return this.label && this.label.length > 0 ? this.label : this.title;
    },
  },

};
</script>
