<template>
  <b-container>
    <div v-if="$can('invoice-list')">You can edit posts.</div>
    <b-row class="justify-content-md-center">
      <b-col md="8">
        <div>
          <b-row>
            <b-col lg="6" class="my-1">
              <b-form-group>
                <b-input-group size="sm">
                  <b-form-input
                    v-model="filter"
                    type="search"
                    id="filterInput"
                    placeholder="Ieškoti"
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
            :items="roles"
            :fields="fields"
            :per-page="perPage"
            :current-page="currentPage"
            striped
            small
            stacked="md"
            primary-key="id"
            head-variant="dark"
            :filter="filter"
            :busy="isBusy"
            show-empty
            empty-text="Įrašų nėra"
            empty-filtered-text="Susijusių įrašų nerasta"
          >
            <template v-slot:table-busy>
              <div v-if="isBusy" class="text-center">
                <div>
                  <b-spinner type="grow" label="Loading..."></b-spinner>
                </div>
              </div>
            </template>
            <template v-slot:cell(actions)="row">
              <b-button :to="`/roles/${row.item.id}`" variant="outline-info" class="mb-2">
                <b-icon icon="info"></b-icon>
              </b-button>
              <b-button :to="`/roles/${row.item.id}/edit`" variant="outline-primary" class="mb-2">
                <b-icon icon="arrow-counterclockwise"></b-icon>
              </b-button>
              <b-button :to="`/roles/${row.item.id}`" variant="outline-danger" class="mb-2">
                <b-icon icon="trash"></b-icon>
              </b-button>
            </template>
          </b-table>
          <b-pagination
            id="p-table"
            v-model="currentPage"
            :total-rows="totalRows"
            :per-page="perPage"
            aria-controls="table-transition-example"
            align="center"
          ></b-pagination>
        </div>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
export default {
  data() {
    return {
      perPage: 3,
      currentPage: 1,
      fetchTime: 0,
      isBusy: true,
      filter: null,
      transProps: {
        // Transition name
        name: "flip-list"
      },
      roles: [],
      fields: [
        { key: "id", sortable: true },
        { key: "name", label: "Vardas", sortable: true },
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
      this.isBusy = true;
      axios
        .get("/api/roles")
        .then(response => {
          this.roles = response.data;
          this.totalRows = response.data.length;
          this.isBusy = false;
        })
        .catch(error => console.log(error));
    },
    onFiltered(filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.totalRows = filteredItems.length;
      this.currentPage = 1;
    }
  }
};
</script>
