<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Inicio
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 space-y-6">
                <div>
                    <dashboard-balance class="mt-10 sm:mt-0"/>
                    <jet-section-border />
                </div>

                <dashboard-balance-by-account class="mt-10 sm:mt-0"/>
                <jet-section-border />

                <dashboard-expenses-by-category class="mt-10 sm:mt-0"/>
                <jet-section-border />

            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Money/AppLayout'
    import JetSectionBorder from '@/Jetstream/SectionBorder'
    import DashboardBalance from './DashboardBalance'
    import DashboardExpensesByCategory from './DashboardExpensesByCategory'
    import DashboardBalanceByAccount from './DashboardBalanceByAccount'

    export default {
        components: {
            AppLayout,
            JetSectionBorder,
            DashboardBalance,
            DashboardExpensesByCategory,
            DashboardBalanceByAccount
        },
        data() {
            return {
                showBalance: false,
                showExpensesByCategory:false
            }
        },
    }
</script>
