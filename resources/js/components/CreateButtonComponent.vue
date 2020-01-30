<template>
  <div>
    <b-button :to="route" variant="outline-success" class="mb-2">
      <b-icon icon="pen"></b-icon>
    </b-button>
  </div>
</template>
<script>
export default {
  props: {
    route: { type: String, required: true }
  }
};
</script>
