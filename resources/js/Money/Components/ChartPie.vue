<template>
    <div class="flex items-center mx-auto">
      <apexchart  class="w-full sm:w-3/4" :options="options" :series="series"></apexchart>
    </div>
  </template>

<script>
  export default {
    props:['options','series'],
  }

</script>
