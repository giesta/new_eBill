<template>
  <div>
    <div class="pull-left">
      <h2>Sukurti naują naudotoją</h2>
    </div>

    <b-button :to="`/users`" variant="outline-primary" class="mb-2">
      <b-icon icon="arrow-left"></b-icon>
    </b-button>

    <validation-observer ref="observer" v-slot="{ passes }">
      <b-form @submit.stop.prevent="passes(onSubmit)" @reset="onReset" v-if="show">
        <validation-provider
          name="Vardas"
          :rules="{ required: true, min: 3 }"
          v-slot="validationContext"
        >
          <b-form-group id="input-group-1" label="Vardas:" label-for="name">
            <b-form-input
              id="name"
              v-model="form.name"
              :state="getValidationState(validationContext)"
              placeholder="Įveskite vardą"
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
          name="E-paštas"
          :rules="{ required: true, email }"
          v-slot="validationContext"
        >
          <b-form-group
            id="input-group-2"
            label="E-pašto adresas:"
            label-for="email"
            description="Mes neatskleisime trečiosioms šalims jūsų e-pašto adreso"
          >
            <b-form-input
              id="email"
              v-model="form.email"
              type="email"
              :state="getValidationState(validationContext)"
              placeholder="E-paštas"
              aria-describedby="input-2-live-feedback"
            ></b-form-input>
            <b-form-invalid-feedback id="input-2-live-feedback">
              {{
              validationContext.errors[0]
              }}
            </b-form-invalid-feedback>
          </b-form-group>
        </validation-provider>
        <validation-provider name="Rolė" :rules="{ required: true }" v-slot="validationContext">
          <b-form-group id="input-group-3" label="Rolė:" label-for="roles">
            <b-form-select
              id="roles"
              v-model="form.roles"
              :options="roles"
              multiple
              :select-size="4"
              :state="getValidationState(validationContext)"
              aria-describedby="input-3-live-feedback"
            ></b-form-select>
            <b-form-invalid-feedback id="input-3-live-feedback">
              {{
              validationContext.errors[0]
              }}
            </b-form-invalid-feedback>
          </b-form-group>
        </validation-provider>
        <validation-provider name="Slaptažodis" rules="required|min:6" v-slot="validationContext">
          <b-form-group>
            <label for="text-password">Slaptažodis:</label>
            <b-form-input
              type="password"
              id="password"
              v-model="form.password"
              :state="getValidationState(validationContext)"
              aria-describedby="password-help-block"
            ></b-form-input>
            <b-form-invalid-feedback id="password-help-block">
              {{
              validationContext.errors[0]
              }}
            </b-form-invalid-feedback>
          </b-form-group>
        </validation-provider>

        <validation-provider
          name="Pakartoti slaptažodį"
          rules="required|password:@Slaptažodis"
          v-slot="validationContext"
        >
          <b-form-group>
            <label for="text-password">Patvirtinti slaptažodį:</label>
            <b-form-input
              type="password"
              id="confirmPassword"
              v-model="form.confirmPassword"
              :state="getValidationState(validationContext)"
              aria-describedby="confirmPassword-help-block"
            ></b-form-input>
            <b-form-invalid-feedback id="confirmPassword-help-block">
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
        email: "",
        name: "",
        password: "",
        confirmPassword: "",
        roles: null
      },
      roles: [
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
    getValidationState({ dirty, validated, valid = null }) {
      return dirty || validated ? valid : null;
    },

    onReset(evt) {
      evt.preventDefault();
      // Reset our form values
      this.form.email = "";
      this.form.name = "";
      this.form.password = "";
      this.form.confirmPassword = "";
      this.form.roles = null;
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
