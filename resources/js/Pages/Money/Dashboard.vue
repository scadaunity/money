<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Inicio
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <dashboard-balance class="mb-6"/>
                <dashboard-expenses-by-category class="mb-6"/>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Money/AppLayout'
    import DashboardBalance from './DashboardBalance'
    import DashboardExpensesByCategory from './DashboardExpensesByCategory'

    export default {
        components: {
            AppLayout,
            DashboardBalance,
            DashboardExpensesByCategory
        },
        data() {
            return {
                showBalance: false,
                showExpensesByCategory:false
            }
        },
    }
</script>
