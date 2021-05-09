<template>
    <div>

        <div v-if="$page.props.money.category.length > 0">
            <jet-section-border />

            <!-- Manage Categorys -->
            <div class="mt-10 sm:mt-0">
                <jet-action-section>
                    <template #title>
                        Gerenciar Categorias <span class="inline-flex items-center justify-center px-2 py-1 ml-2 text-sm font-bold leading-none text-gray-600 bg-blue-200 rounded-full">{{$page.props.money.category.length}}</span>
                    </template>

                    <template #description>
                        Gerencie suas categorias de forma facil e descomplicada.
                    </template>

                    <!-- Categorys List -->
                    <template #content>
                        <div class="space-y-6">
                            <div class="flex items-center justify-between" v-for="category in $page.props.money.category" :key="category.id">
                                <div>
                                    {{ category.name }}
                                </div>

                                <div class="flex items-center">
                                    <div class="text-sm text-gray-400" v-if="category.opening_balance">
                                        R$ {{ category.opening_balance }}
                                    </div>


                                    <button class="cursor-pointer ml-6 text-sm text-gray-400 underline"
                                        @click="manageCategory(category)"
                                    >
                                        Editar
                                    </button>

                                    <button class="cursor-pointer ml-6 text-sm text-red-500" @click="confirmCategoryDeletion(category)">
                                        Excluir
                                    </button>
                                </div>
                            </div>
                        </div>
                    </template>
                </jet-action-section>
            </div>
        </div>

        <!-- Token Value Modal -->
        <jet-dialog-modal :show="displayingToken" @close="displayingToken = false">
            <template #title>
                API Token
            </template>

            <template #content>
                <div>
                    Please copy your new API token. For your security, it won't be shown again.
                </div>

                <div class="mt-4 bg-gray-100 px-4 py-2 rounded font-mono text-sm text-gray-500" v-if="$page.props.jetstream.flash.token">
                    {{ $page.props.jetstream.flash.token }}
                </div>
            </template>

            <template #footer>
                <jet-secondary-button @click="displayingToken = false">
                    Close
                </jet-secondary-button>
            </template>
        </jet-dialog-modal>

        <!-- API Token Permissions Modal -->
        <jet-dialog-modal :show="manageCategoryFor" @close="manageCategoryFor = null">
            <template #title>
                Editar conta
            </template>

            <template #content>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div class="col-span-6 sm:col-span-3">
                      <jet-label for="name" value="Nome da conta:" />
                      <jet-input id="name" type="text" class="mt-1 block w-full" v-model="updateCategoryForm.name" autofocus />
                      <jet-input-error :message="updateCategoryForm.errors.name" class="mt-2" />
                  </div>
                  <!-- Category Balance -->
                  <div class="col-span-1 sm:col-span-1">
                      <jet-label for="opening_balance" value="Saldo inicial:" />
                      <jet-input id="opening_balance" type="text" class="mt-1 block w-full" v-model="updateCategoryForm.opening_balance"/>
                      <jet-input-error :message="updateCategoryForm.errors.opening_balance" class="mt-2" />
                  </div>
                </div>
            </template>

            <template #footer>
                <jet-secondary-button @click="manageCategoryFor = null">
                    Cancel
                </jet-secondary-button>

                <jet-button class="ml-2" @click="updateCategory" :class="{ 'opacity-25': updateCategoryForm.processing }" :disabled="updateCategoryForm.processing">
                    Save
                </jet-button>
            </template>
        </jet-dialog-modal>

        <!-- Delete Token Confirmation Modal -->
        <jet-confirmation-modal :show="categoryBeingDeleted" @close="categoryBeingDeleted = null">
            <template #title>
                Excluir conta
            </template>

            <template #content>
                Tem certeza que quer excluir esta conta?
            </template>

            <template #footer>
                <jet-secondary-button @click="categoryBeingDeleted = null">
                    Cancelar
                </jet-secondary-button>

                <jet-danger-button class="ml-2" @click="deleteCategory" :class="{ 'opacity-25': deleteCategoryForm.processing }" :disabled="deleteCategoryForm.processing">
                    Excluir
                </jet-danger-button>
            </template>
        </jet-confirmation-modal>
    </div>
</template>

<script>
    import JetActionMessage from '@/Jetstream/ActionMessage'
    import JetActionSection from '@/Jetstream/ActionSection'
    import JetButton from '@/Jetstream/Button'
    import JetConfirmationModal from '@/Jetstream/ConfirmationModal'
    import JetDangerButton from '@/Jetstream/DangerButton'
    import JetDialogModal from '@/Jetstream/DialogModal'
    import JetFormSection from '@/Jetstream/FormSection'
    import JetInput from '@/Jetstream/Input'
    import JetCheckbox from '@/Jetstream/Checkbox'
    import JetInputError from '@/Jetstream/InputError'
    import JetLabel from '@/Jetstream/Label'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton'
    import JetSectionBorder from '@/Jetstream/SectionBorder'

    export default {
        components: {
            JetActionMessage,
            JetActionSection,
            JetButton,
            JetConfirmationModal,
            JetDangerButton,
            JetDialogModal,
            JetFormSection,
            JetInput,
            JetCheckbox,
            JetInputError,
            JetLabel,
            JetSecondaryButton,
            JetSectionBorder,
        },

        props: [
            'tokens',
            'availablePermissions',
            'defaultPermissions',
        ],

        data() {
            return {
                createCategoryForm: this.$inertia.form({
                    name: '',
                    opening_balance:'',
                }),

                updateCategoryForm: this.$inertia.form({
                  id:'',
                  name: '',
                  opening_balance:'',
                }),

                deleteCategoryForm: this.$inertia.form(),

                displayingToken: false,
                manageCategoryFor: null,
                categoryBeingDeleted: null,
            }
        },

        methods: {
            createCategory() {
                this.createCategoryForm.post(route('money.category.store'), {
                    preserveScroll: false
                    ,
                    onSuccess: () => {
                        console.log('Conta criada com sucesso')
                        this.createCategoryForm.reset()
                    }
                })
            },

            manageCategory(category) {
                this.updateCategoryForm.id = category.id,
                this.updateCategoryForm.name = category.name,
                this.updateCategoryForm.opening_balance = category.opening_balance
                this.manageCategoryFor = category
            },

            updateCategory() {
                this.updateCategoryForm.put(route('money.category.update', this.manageCategoryFor), {
                    preserveScroll: true,
                    preserveState: true,
                    onSuccess: () => (this.manageCategoryFor = null),
                })
            },

            confirmCategoryDeletion(category) {
                this.categoryBeingDeleted = category
            },

            deleteCategory() {
                this.deleteCategoryForm.delete(route('money.category.destroy', this.categoryBeingDeleted), {
                    preserveScroll: true,
                    preserveState: true,
                    onSuccess: () => (this.categoryBeingDeleted = null),
                })
            },
        },
    }
</script>
