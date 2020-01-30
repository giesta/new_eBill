<template>
  <b-container>
    <div v-if="$can('invoice-list')">You can edit posts.</div>

    <div>
      <b-row>
        <b-col lg="4" class="my-1">
          <b-form-group>
            <b-input-group size="sm">
              <b-form-input
                v-model="filter"
                type="search"
                id="filterInput"
                placeholder="Įveskite paieškai"
              ></b-form-input>
              <b-input-group-append>
                <b-button :disabled="!filter" @click="filter = ''">Išvalyti</b-button>
              </b-input-group-append>
            </b-input-group>
          </b-form-group>
        </b-col>
      </b-row>
      <b-table
        id="table-transition-example"
        :items="users"
        :fields="fields"
        :per-page="perPage"
        :current-page="currentPage"
        striped
        small
        stacked="md"
        primary-key="id"
        head-variant="dark"
        :filter="filter"
      >
        <template v-slot:cell(roles)="row">
          <b-badge
            class="m-1"
            variant="success"
            v-for="role in row.item.roles"
            v-bind:key="role.id"
          >{{ role.name }}</b-badge>
        </template>
        <template v-slot:cell(actions)="row">
          <b-button :to="`/users/${row.item.id}`" variant="outline-info" class="mb-2">
            <b-icon icon="info"></b-icon>
          </b-button>
          <b-button :to="`/users/${row.item.id}/edit`" variant="outline-primary" class="mb-2">
            <b-icon icon="arrow-counterclockwise"></b-icon>
          </b-button>
          <b-button :to="`/users/${row.item.id}`" variant="outline-danger" class="mb-2">
            <b-icon icon="trash"></b-icon>
          </b-button>
        </template>
      </b-table>
      <b-pagination
        id="p-table"
        v-model="currentPage"
        :per-page="perPage"
        aria-controls="table-transition-example"
        align="center"
      ></b-pagination>
    </div>
  </b-container>
</template>

<script>
export default {
  data() {
    return {
      perPage: 3,
      currentPage: 1,
      fetchTime: 0,
      busy: false,
      filter: null,
      transProps: {
        // Transition name
        name: "flip-list"
      },
      users: [],
      fields: [
        { key: "id", sortable: true },
        { key: "name", label: "Vardas", sortable: true },
        { key: "email", label: "E-paštas", sortable: true },
        { key: "roles", label: "Rolės" },
        { key: "actions", label: "Veiksmai" }
      ]
    };
  },
  mounted() {
    this.getResults();
  },
  methods: {
    info(item, index, button) {
      this.infoModal.title = `Row index: ${index}`;
      this.infoModal.content = JSON.stringify(item, null, 2);
      this.$root.$emit("bv::show::modal", this.infoModal.id, button);
    },
    getResults(ctx, callback) {
      axios
        .get("/api/users")
        .then(response => {
          this.users = response.data;
          this.totalRows = response.data.length;
          return this.users;
        })
        .catch(error => console.log(error));
    }
  }
};
</script>
