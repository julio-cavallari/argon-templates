<template>
  <div class="form-group">
    <label
      v-if="title"
      :for="realId"
      :class="{'form-control-label': true, 'is-required': required}"
    >
      {{ title }}
    </label>
    <input
      :id="realId"
      ref="input"
      :type="inputType"
      :name="name"
      :placeholder="placeholder"
      :class="inputClass"
      :style="istyle"
      :value="value"
      :maxlength="maxlength"
      :required="required"
    />
  </div>
</template>

<script>
export default {

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
    required: {
      type: Boolean,
      default: true,
    },
    inputType: {
      type: String,
      default: '',
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
