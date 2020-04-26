<style>
  .vdp-datepicker__clear-button {
    position: absolute;
    right: 10px;
    top: 50%;
    margin-top: -11px;
  }
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
    <datepicker
      :id="realId"
      ref="select"
      :ref-name="'select'"
      :value="selectedDate"
      :format="displayValue"
      :parse-typed-date="formatTypedValue"
      :language="locale"
      :monday-first="mondayFirst"
      :input-class="inputClass"
      :typeable="true"
      :clear-button="true"
      :show-calendar-on-focus="showCalendarOnFocus"
      :required="required"
      @input="onInput($event)"
      @selected="onSelected($event)"
      @clearDate="onSelected('')"
    />
    <input :name="name" type="hidden" :value="exchange" />
  </div>
</template>

<script>
import Datepicker from '@hokify/vuejs-datepicker';
import moment from 'moment';

export default {

  components: {
    Datepicker
  },

  model: {
    prop: 'value',
    event: 'input'
  },

  props: {
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
    value: {
      type: String,
      default: '',
    },
    required: {
      type: Boolean,
      default: true,
    },
    defaultDate: {
      type: String,
      default: '',
    },
    locale: {
      type: String,
      default: document.documentElement.lang,
    },
    showCalendarOnFocus: {
      type: Boolean,
      default: false,
    },
    error: {
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

  },

  data() {
    return {
      /**
       * Value of the date in exchange format
       */
      exchange: '',

      selectedDate: '',
      mondayFirst: false
    };
  },

  computed: {
    /**
     * Exchange format with controller (moment format type).
     */
    exchangeFormat() {
      return 'YYYY-MM-DD';
    },

    /**
     * Display format (moment format type).
     */
    displayFormat() {
      return 'L';
    },

    realId() {
      var id = this.id != '' ? this.id : this.name;
      return id + this._uid;
    },

    inputClass() {
      var c = [this.iclass != '' ? this.iclass : 'form-control'];
      c.push({ 'is-invalid': this.error });
      return c;
    },
  },

  watch: {
    value: function (newValue) {
      this.updateExchange(newValue);
    }
  },

  mounted() {
    moment.locale(this.locale);
    this.updateExchange(this.value === '' ? this.defaultDate : this.value);
    this.mondayFirst = moment.localeData().firstDayOfWeek() == 1;
  },

  methods: {
    /**
     * Format date for display it.
     * @param date string in locale format
     * @return string date in display format
     */
    displayValue(date) {
      return date !== '' && date !== null ? moment(date).format(this.displayFormat) : '';
    },

    /**
     * Format date for save it.
     * @param date string in locale format
     * @return string date in exchange format
     */
    exchangeValue(date) {
      return date !== '' && date !== null ? moment(date).format(this.exchangeFormat) : '';
    },

    /**
     * Update the value of hidden input.
     * Store it in exchange format value.
     */
    update(date) {
      if (date === '' || date === null) {
        this.exchange = '';
      } else {
        var mdate = moment(date);
        if (! mdate.isValid()) {
          mdate = moment();
        }
        this.exchange = mdate.format(this.exchangeFormat);
      }
    },

    updateExchange(date) {
      this.exchange = date;
      if (this.exchange !== '') {
        var mdate = moment(this.exchange, this.exchangeFormat);
        if (! mdate.isValid()) {
          mdate = moment();
        }
        this.selectedDate = mdate.toDate();
      }
      this.update(this.selectedDate);
    },

    /**
     * Format the typed value with the locale specification.
     * @param date string in locale format
     * @return date value
     */
    formatTypedValue(date) {
      return date !== '' && date !== null ? moment(date, this.displayFormat).toDate() : '';
    },

    onInput(event) {
      if (this.validator) {
        this.validator.$touch();
      }
      this.$emit('input', this.exchangeValue(event));
    },

    onSelected(event) {
      this.update(event);
      this.onInput(event);
    }
  }
};
</script>
