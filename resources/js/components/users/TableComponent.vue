<template>
<b-container>
  <div v-if="$can('invoice-list')">You can edit posts.</div>

  <div>

      <b-table
      id="table-transition-example"
      :items="users"
      :fields="fields"
      :per-page="perPage"
      :current-page="currentPage"
      striped
      small
      primary-key="id"      
      head-variant="dark"
    >
    <template v-slot:cell(roles)="row" >
        <b-badge class="m-1" variant="success" v-for="role in row.item.roles" v-bind:key="role">{{ role.name }}</b-badge>
        </template>
      <template v-slot:cell(actions)="row">
     <b-button :to="`/users/${row.item.id}`" variant="outline-info" class="mb-2">
          <b-icon icon="info" ></b-icon>
        </b-button>
     <b-button :to="`/users/${row.item.id}/edit`" variant="outline-primary" class="mb-2">
          <b-icon icon="pen" ></b-icon>
        </b-button>
       <b-button :to="`/users/${row.item.id}`" variant="outline-danger" class="mb-2">
          <b-icon icon="trash" ></b-icon>
        </b-button>
     
   </template>
    </b-table>
    <b-pagination
    id ="p-table"
      v-model="currentPage"
      :total-rows="totalRows"
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
        transProps: {
          // Transition name
          name: 'flip-list',
        },
        users: [
        ],
        fields: [
          { key: 'id', sortable: true },
          { key: 'name',label: 'Vardas', sortable: true },
          { key: 'email',label: 'E-pastas', sortable: true },
          {key:'roles', label:'Roles'},
          { key: 'actions', label:'Veiksmai'}
        ]
      }
    },
    mounted(){
        this.getResults();
    },
    methods:{
      info(item, index, button) {
        this.infoModal.title = `Row index: ${index}`
        this.infoModal.content = JSON.stringify(item, null, 2)
        this.$root.$emit('bv::show::modal', this.infoModal.id, button)
      },
        getResults(ctx, callback){
            axios.get("/api/users")
            .then(response=>{
                this.users = response.data;
                this.totalRows = response.data.length;
                return this.users;
            }).catch((error)=>console.log(error));
        }
    }
  }
</script>