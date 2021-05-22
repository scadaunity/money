<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Transações
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <transaction-form-create/>
            </div>
        </div>
        
    </app-layout>
</template>

<script>
    import AppLayout from '@/Money/AppLayout'
    import TransactionFormCreate from './TransactionFormCreate'

    export default {
        components: {
            AppLayout,
            TransactionFormCreate
        },
    }
</script>
