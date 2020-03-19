<template>
  <div>
    <div class="pull-left">
      <h2>Sukurti naują rolę</h2>
    </div>

    <b-button :to="`/roles`" variant="outline-primary" class="mb-2">
      <b-icon icon="arrow-left"></b-icon>
    </b-button>

    <validation-observer ref="observer" v-slot="{ passes }">
      <b-form @submit.stop.prevent="passes(onSubmit)" @reset="onReset" v-if="show">
        <validation-provider
          name="Pavadinimas"
          :rules="{ required: true, min: 3 }"
          v-slot="validationContext"
        >
          <b-form-group id="input-group-1" label="Pavadinimas:" label-for="name">
            <b-form-input
              id="name"
              v-model="form.name"
              :state="getValidationState(validationContext)"
              placeholder="Įveskite pavadinimą"
              aria-describedby="input-1-live-feedback"
            ></b-form-input>
            <b-form-invalid-feedback id="input-1-live-feedback">
              {{
              validationContext.errors[0]
              }}
            </b-form-invalid-feedback>
          </b-form-group>
        </validation-provider>

        <b-form-group>
          <template v-slot:label>
            <b>Pasirinkti leidimus:</b>
            <br />
            <b-form-checkbox
              v-model="form.allSelected"
              :indeterminate="form.indeterminate"
              aria-describedby="permissions"
              aria-controls="permissions"
              @change="toggleAll"
            >{{ allSelected ? 'Atžymėti visus' : 'Pažymėti visus' }}</b-form-checkbox>
          </template>
          <validation-provider
            name="Pasirinkti leidimus"
            :rules="{ required: true }"
            v-slot="validationContext"
          >
            <b-form-checkbox-group
              id="permissions"
              v-model="form.selected"
              :options="form.permissions"
              name="permissions"
              :state="getValidationState(validationContext)"
              class="ml-4"
              aria-label="Individual permissions"
              aria-describedby="input-2-live-feedback"
              stacked
            ></b-form-checkbox-group>

            <b-form-invalid-feedback id="input-2-live-feedback">
              {{
              validationContext.errors[0]
              }}
            </b-form-invalid-feedback>
          </validation-provider>
        </b-form-group>

        <b-button type="submit" variant="outline-success" class="mb-2" size="lg">
          <b-icon icon="check-circle"></b-icon>
        </b-button>
        <b-button type="reset" variant="outline-danger" class="mb-2" size="lg">
          <b-icon icon="alert-circle"></b-icon>
        </b-button>
      </b-form>
    </validation-observer>
    <b-card class="mt-3" header="Form Data Result">
      <pre class="m-0">{{ form }}</pre>
    </b-card>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        name: "",
        permissions: [
          "role-list ",
          "role-create ",
          "role-edit ",
          "role-delete ",
          "invoice-list "
        ],
        selected: [],
        allSelected: false,
        indeterminate: false
      },
      permissions: [
        { text: "Pasirinkite vieną", value: null, disabled: true },
        "Administratorius",
        "Vadybininkas",
        "Darbuotojas",
        "Vairuotojas"
      ],
      show: true
    };
  },
  methods: {
    toggleAll(checked) {
      this.form.selected = checked ? this.form.permissions.slice() : [];
    },
    getValidationState({ dirty, validated, valid = null }) {
      return dirty || validated ? valid : null;
    },

    onReset(evt) {
      evt.preventDefault();
      // Reset our form values
      this.form.name = "";
      this.form.allSelected = false;
      this.form.indeterminate = false;
      this.form.selected = null;
      // Trick to reset/clear native browser form validation state
      this.show = false;
      this.$nextTick(() => {
        this.show = true;
      });
      this.$nextTick(() => {
        this.$refs.observer.reset();
      });
    },
    onSubmit() {
      this.$validator.validateAll().then(result => {
        if (!result) {
          return;
        }

        alert("Form submitted!");
      });
    }
  },
  watch: {
    selected(newVal, oldVal) {
      // Handle changes in individual flavour checkboxes
      if (newVal.length === 0) {
        this.form.indeterminate = false;
        this.form.allSelected = false;
      } else if (newVal.length === this.form.permissions.length) {
        this.form.indeterminate = false;
        this.form.allSelected = true;
      } else {
        this.form.indeterminate = true;
        this.form.allSelected = false;
      }
    }
  }
};
</script>
