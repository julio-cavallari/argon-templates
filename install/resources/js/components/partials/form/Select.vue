<!-- New step! Add Multiselect CSS. Can be added as a static asset or inside a component. -->
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<template>
  <div class="form-group">
    <label
      v-if="title"
      :for="realId"
      :class="{'form-control-label': true, 'is-required': required}"
    >
      {{ title }}
    </label>

    <multiselect
      v-model="exchange"
      :options="options"
      :placeholder="placeholder"
      :label="selectLabel"
      :track-by="selectId"
      :required="required"
      :multiple="multiple"
      selectLabel="Enter para selecionar"
      selectedLabel="Selecionado"
      deselectLabel="Enter para remover"
    >
      <span slot="noResult">Nenhum registro encontrado.</span>
    </multiselect>

    <template v-if="multiple">
      <template v-for="item in exchange">
        <input :name="name+'[]'" type="hidden" :value="item[selectId]" />
      </template>
    </template>
    <template v-else>
      <input :name="name" type="hidden" :value="[exchange ? exchange[selectId] : '']" />
    </template>

  </div>
</template>

<script>
import Multiselect from 'vue-multiselect';

export default {
  components: { Multiselect },

  props: {
    value: {
      type: [String, Number, Array],
      default: '',
    },
    options: {
      type: [Array, Object],
      default: () => [],
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
    multiple: {
      type: Boolean,
      default: false,
    },
    iclass: {
      type: String,
      default: '',
    },

    selectLabel: {
      type: String,
      default: 'name',
    },
    selectId: {
      type: String,
      default: 'id',
    },
  },

  data () {
    var value = this.value;
    var selectId = this.selectId;
    var exchange;

    if (this.multiple) {
      exchange = this.options.filter(function (option) {
        return value.includes(option[selectId]);
      });
    } else {
      exchange = this.options.find(function (option) {
        return option[selectId] == value;
      });
    }

    return {
      exchange: exchange,
    }
  },

  computed: {
    realId() {
      return this.id + this._uid;
    },
  },
};
</script>
