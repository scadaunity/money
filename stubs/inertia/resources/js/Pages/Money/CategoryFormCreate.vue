<template>
    <div>
        <!-- Create account form -->
        <jet-form-section @submitted="createCategory">
            <template #title>
                Criar nova Categoria
            </template>

            <template #description>
                Criar uma nova categoria, para agrupar suas receitas e despesas.
            </template>

            <template #form>
                <!-- Account Name -->
                <div class="col-span-6 sm:col-span-4">
                    <su-select label='Categoria pai:' :list="$page.props.money.category" v-model="createCategoryForm.parent_id"/>
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <jet-label for="name" value="Nome da categoria:" />
                    <jet-input id="name" type="text" class="mt-1 block w-full" v-model="createCategoryForm.name" autofocus />
                    <jet-input-error :message="createCategoryForm.errors.name" class="mt-2" />
                </div>
            </template>

            <template #actions>
                <jet-action-message :on="createCategoryForm.recentlySuccessful" class="mr-3">
                    Categoria criada.
                </jet-action-message>

                <jet-button :class="{ 'opacity-25': createCategoryForm.processing }" :disabled="createCategoryForm.processing">
                    Criar categoria
                </jet-button>
            </template>
        </jet-form-section>

    </div>
</template>

<script>
    import JetActionMessage from '@/Jetstream/ActionMessage'
    import JetButton from '@/Jetstream/Button'
    import JetFormSection from '@/Jetstream/FormSection'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'
    import JetLabel from '@/Jetstream/Label'
    import SuSelect from '@/Money/Components/Select'

    export default {
        components: {
            JetActionMessage,
            JetButton,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
            SuSelect
        },

        data() {
            return {
                createCategoryForm: this.$inertia.form({
                    name: '',
                    parent_id: 0,
                    state:'',
                    type:'',
                    color:'',
                    icon:'',
                }),
                selected:'',
            }
        },

        methods: {
            createCategory() {
                this.createCategoryForm.parent_id = this.selected.id
                this.createCategoryForm.post(route('money.category.store'), {
                    preserveScroll: false,
                    onSuccess: () => {
                        this.createCategoryForm.reset()
                    }
                })
            },
        },
    }
</script>
