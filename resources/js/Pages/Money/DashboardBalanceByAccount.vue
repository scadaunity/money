<template>
    <jet-action-section>
        <template #title>
            Meus saldos
        </template>

        <template #description>
            Acompanhe o saldo das suas contas.
            <br>
        </template>

        <template #content>
            <div class="col-span-6 sm:col-span-4">
                <div v-for="account in accounts" :key="account.id" >
                    {{account.name}}
                </div>
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
          accounts:[
            { name: 'Carteira', amount: '150,00' },
            { name: 'Caixa', amount: '150,00' },
            { name: 'Neon', amount: '150,00' },
          ],
          balance:null,
          incoming:null,
          expenses:null,
          cards:null,
          show:{
            balance:true,
            incoming:true,
            expenses:true,
            cards:false
          }
        }
      },
      methods:{
        render(){
          this.balance = this.format(this.getBalance())
        },
        getOpeningBalance(){
          let openingBalance = null
          this.$page.props.money.account.forEach((account, i) => {
            openingBalance = openingBalance + parseFloat(account.opening_balance)
            console.log(account)
          });
          return openingBalance
        },

        getExpenses(){
          let expenses = null
          this.$page.props.money.transactions.forEach((transaction, i) => {
            if(transaction.type == 0){
              expenses = expenses + parseFloat(transaction.amount)
            }
          });
          return expenses
        },
        getIncoming(){
          let incoming = null
          this.$page.props.money.transactions.forEach((transaction, i) => {
            if(transaction.type == 1){
              incoming = incoming + parseFloat(transaction.amount)
            }
          });
          return incoming
        },
        getBalance(){
          return this.getOpeningBalance() + this.getIncoming() - this.getExpenses()
        },
        format(value){
          if(value > 0){
            return 'R$ ' + value.toFixed(2).replace(".", ",")
          } else {
            return 'R$ 00,00'
          }

        }

      },
      beforeMount(){
        this.render()
      },
    }
</script>
