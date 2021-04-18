<template>
  <app-layout>
    <template #header>
      <h1 class="font-semibold text-xl text-gray-800 leading-tight ">
        Visão Geral
      </h1>
    </template>

    
    
  </app-layout>
</template>

<script>
import AppLayout from './Layouts/AppLayout'


/** Money import */
import NavBottom from '@/Pages/Money/Import/NavBottom'
import CardSaldoAtual from '@/Pages/Money/Import/CardSaldoAtual'
import JetNavLink from '@/Jetstream/NavLink'
export default {
  components: {
      AppLayout,
      NavBottom,
      CardSaldoAtual,
      JetNavLink
  },
}
</script>

<style>
    
</style>