<template>
    <jet-action-section>
        <template #title>
            Saldo geral
        </template>

        <template #description>
            Acompanhe o saldo das suas contas.
        </template>

        <template #content>
            <div class="flex flex-col lg:flex-row w-full lg:space-x-2 space-y-2 lg:space-y-0 mb-2 lg:mb-4">
                <states label="Saldo" :value="balance" percent="8"/>
                <states label="Receitas" :value="incoming" percent="7"/>
                <states label="Despesas" :value="expenses" percent="-5"/>
                <states label="Meus cartões" value="00.00" percent="0"/>
            </div>
        </template>
    </jet-action-section>
</template>

<script>
    import JetActionSection from '@/Jetstream/ActionSection'
    import States from '@/Money/Components/States'

    export default {
      components: {JetActionSection,States},
      data: function() {
        return {
          openingBalance:null,
          expenses:null,
          incoming:null,
          balance:null,

        }
      },
      methods:{
        render(){
          this.getInitialBalance()
          this.getExpenses()
          this.getIncoming()
          this.getBalance()
        },
        getInitialBalance(){
          this.$page.props.money.account.forEach((account, i) => {
            this.openingBalance = this.openingBalance + parseFloat(account.opening_balance)
          });
        },
        getBalance(){
          this.balance = this.openingBalance + this.incoming - this.expenses
        },
        getExpenses(){
          this.$page.props.money.transactions.forEach((transaction, i) => {
            if(transaction.type == 0){
              this.expenses = this.expenses + parseFloat(transaction.amount)
            }
          });
        },
        getIncoming(){
          this.$page.props.money.transactions.forEach((transaction, i) => {
            if(transaction.type == 1){
              this.incoming = this.incoming + parseFloat(transaction.amount)
            }
          });
        }

      },
      beforeMount(){
        this.render()
      },
    }
</script>
