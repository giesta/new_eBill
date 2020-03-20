<template>
  <div>
    <div class="pull-left">
      <h2>Įtraukti naują produktą</h2>
    </div>

    <b-button :to="`/products`" variant="outline-primary" class="mb-2">
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
        <validation-provider
          name="Aprašymas"
          :rules="{ required: true, min: 3}"
          v-slot="validationContext"
        >
          <b-form-group id="input-group-2" label="Aprašymas:" label-for="description">
            <b-form-textarea
              id="description"
              v-model="form.description"
              :state="getValidationState(validationContext)"
              rows="3"
              placeholder="Trumpas aprašymas"
              aria-describedby="input-2-live-feedback"
            ></b-form-textarea>
            <b-form-invalid-feedback id="input-2-live-feedback">
              {{
              validationContext.errors[0]
              }}
            </b-form-invalid-feedback>
          </b-form-group>
        </validation-provider>

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
        description: "",
        name: ""
      },

      show: true
    };
  },
  methods: {
    getValidationState({ dirty, validated, valid = null }) {
      return dirty || validated ? valid : null;
    },

    onReset(evt) {
      evt.preventDefault();
      // Reset our form values
      this.form.description = "";
      this.form.name = "";
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
  }
};
</script>
