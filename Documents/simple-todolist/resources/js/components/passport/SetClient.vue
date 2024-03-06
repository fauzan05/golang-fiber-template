<style scoped>
.action-link {
    cursor: pointer;
}
</style>

<template>
    <div>
        <div class="card card-default">
            <div class="card-header">
                <div
                    style="
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                    "
                >
                    <span> Config Client </span>

                    <a
                        class="action-link"
                        tabindex="-1"
                        @click="showCreateClientForm"
                    >
                        Add Client Config
                    </a>
                </div>
            </div>

            <div class="card-body">
                <!-- Current Clients -->
                <p class="mb-0" v-if="clients.length === 0">
                    You have not created any OAuth clients.
                </p>

                <table
                    class="table table-responsive table-borderless mb-0"
                    v-if="clients.length > 0"
                >
                    <thead>
                        <tr>
                            <th>Client ID</th>
                            <th>Name</th>
                            <th>Secret</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="client in clients">
                            <!-- ID -->
                            <td style="vertical-align: middle">
                                {{ client.client_id }}
                            </td>

                            <!-- Name -->
                            <td style="vertical-align: middle">
                                {{ client.name }}
                            </td>

                            <!-- Secret -->
                            <td style="vertical-align: middle">
                                <code>{{
                                    client.secret ? client.secret : "-"
                                }}</code>
                            </td>

                            <!-- Edit Button -->
                            <td style="vertical-align: middle">
                                <a
                                    class="action-link"
                                    tabindex="-1"
                                    @click="edit(client)"
                                >
                                    Edit
                                </a>
                            </td>

                            <!-- Delete Button -->
                            <td style="vertical-align: middle">
                                <a
                                    class="action-link text-danger"
                                    @click="destroy(client)"
                                >
                                    Delete
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Create Client Modal -->
        <div
            class="modal fade"
            id="modal-create-client"
            tabindex="-1"
            role="dialog"
        >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Client</h4>

                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-hidden="true"
                            @click="hiddenCreateClientForm"
                        >
                            &times;
                        </button>
                    </div>

                    <div class="modal-body">
                        <!-- Form Errors -->
                        <div
                            class="alert alert-danger"
                            v-if="createForm.errors.length > 0"
                        >
                            <p class="mb-0">
                                <strong>Whoops!</strong> Something went wrong!
                            </p>
                            <br />
                            <ul>
                                <li v-for="error in createForm.errors">
                                    {{ error }}
                                </li>
                            </ul>
                        </div>

                        <!-- Create Client Form -->
                        <form role="form">

                            <!-- ID -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label"
                                    >Id</label
                                >

                                <div class="col-md-9">
                                    <input
                                        id="create-client-id"
                                        type="text"
                                        class="form-control"
                                        @keyup.enter="store"
                                        v-model="createForm.client_id"
                                    />

                                    <span class="form-text text-muted">
                                        Masukkan id client.
                                    </span>
                                </div>
                            </div>

                            <!-- Name -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label"
                                    >Name</label
                                >

                                <div class="col-md-9">
                                    <input
                                        id="create-client-name"
                                        type="text"
                                        class="form-control"
                                        @keyup.enter="store"
                                        v-model="createForm.name"
                                    />

                                    <span class="form-text text-muted">
                                        Masukkan nama provider.
                                    </span>
                                </div>
                            </div>

                            <!-- Redirect URL -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label"
                                    >Redirect URL</label
                                >

                                <div class="col-md-9">
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="redirect"
                                        @keyup.enter="store"
                                        v-model="createForm.redirect_url"
                                    />

                                    <span class="form-text text-muted">
                                        Masukkan redirect URL.
                                    </span>
                                </div>
                            </div>

                            <!-- Secret Key -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label"
                                    >Secret Key</label
                                >

                                <div class="col-md-9">
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="redirect"
                                        @keyup.enter="store"
                                        v-model="createForm.secret"
                                    />

                                    <span class="form-text text-muted">
                                        Masukkan secret Key.
                                    </span>
                                </div>
                            </div>

                            <!-- Confidential -->
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label"
                                    >Confidential</label
                                >

                                <div class="col-md-9">
                                    <div class="checkbox">
                                        <label>
                                            <input
                                                type="checkbox"
                                                v-model="
                                                    createForm.confidential
                                                "
                                            />
                                        </label>
                                    </div>

                                    <span class="form-text text-muted">
                                        Require the client to authenticate with
                                        a secret. Confidential clients can hold
                                        credentials in a secure way without
                                        exposing them to unauthorized parties.
                                        Public applications, such as native
                                        desktop or JavaScript SPA applications,
                                        are unable to hold secrets securely.
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                            @click="hiddenCreateClientForm"
                        >
                            Close
                        </button>

                        <button
                            type="button"
                            class="btn btn-primary"
                            @click="store"
                        >
                            Create
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Client Modal -->
        <div
            class="modal fade"
            id="modal-edit-client"
            tabindex="-1"
            role="dialog"
        >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Client</h4>

                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-hidden="true"
                             @click="hiddenEditClientForm"
                        >
                            &times;
                        </button>
                    </div>

                    <div class="modal-body">
                        <!-- Form Errors -->
                        <div
                            class="alert alert-danger"
                            v-if="editForm.errors.length > 0"
                        >
                            <p class="mb-0">
                                <strong>Whoops!</strong> Something went wrong!
                            </p>
                            <br />
                            <ul>
                                <li v-for="error in editForm.errors">
                                    {{ error }}
                                </li>
                            </ul>
                        </div>

                        <!-- Edit Client Form -->
                        <form role="form">
                            <!-- Id -->
                            <div class="form-group row my-3">
                                <label class="col-md-3 col-form-label"
                                    >Id</label
                                >

                                <div class="col-md-9">
                                    <input
                                        id="edit-client-name"
                                        type="text"
                                        class="form-control"
                                        @keyup.enter="update"
                                        v-model="editForm.id"
                                    disabled />
                                </div>
                            </div>

                            <!--Client Id -->
                            <div class="form-group row my-3">
                                <label class="col-md-3 col-form-label"
                                    >Client Id</label
                                >

                                <div class="col-md-9">
                                    <input
                                        id="edit-client-name"
                                        type="text"
                                        class="form-control"
                                        @keyup.enter="update"
                                        v-model="editForm.client_id"
                                    />
                                </div>
                            </div>
                            <!-- Name -->
                            <div class="form-group row my-3">
                                <label class="col-md-3 col-form-label"
                                    >Name</label
                                >

                                <div class="col-md-9">
                                    <input
                                        id="edit-client-name"
                                        type="text"
                                        class="form-control"
                                        @keyup.enter="update"
                                        v-model="editForm.name"
                                    />
                                </div>
                            </div>

                            <!-- Redirect URL -->
                            <div class="form-group row my-3">
                                <label class="col-md-3 col-form-label"
                                    >Redirect URL</label
                                >

                                <div class="col-md-9">
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="redirect"
                                        @keyup.enter="update"
                                        v-model="editForm.redirect_url"
                                    />
                                </div>
                            </div>

                            <!-- Edit Secret -->
                            <div class="form-group row my-3">
                                <label class="col-md-3 col-form-label"
                                    >Secret Key</label
                                >

                                <div class="col-md-9">
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="secretKey"
                                        @keyup.enter="update"
                                        v-model="editForm.secret"
                                    />
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                            @click="hiddenEditClientForm"
                        >
                            Close
                        </button>

                        <button
                            type="button"
                            class="btn btn-primary"
                            @click="update"
                        >
                            Save Changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    /*
     * The component's data.
     */
    data() {
        return {
            clients: [],
            clientSecret: null,
            createForm: {
                errors: [],
                client_id: "",
                name: "",
                secret: "",
                redirect_url: "",
                confidential: true,
            },
            editForm: {
                errors: [],
                id: "",
                client_id: "",
                name: "",
                redirect_url: "",
                secret: "",
            },
        };
    },
    /**
     * Prepare the component (Vue 1.x).
     */
    ready() {
        this.prepareComponent();
    },
    /**
     * Prepare the component (Vue 2.x).
     */
    mounted() {
        this.prepareComponent();
    },
    methods: {
        /**
         * Prepare the component.
         */
        prepareComponent() {
            this.getClients();
            $("#modal-create-client").on("shown.bs.modal", () => {
                $("#create-client-name").focus();
            });
            $("#modal-edit-client").on("shown.bs.modal", () => {
                $("#edit-client-name").focus();
            });
        },
        /**
         * Get all of the OAuth clients for the user.
         */
        getClients() {
            axios.get("/api/clients").then((response) => {
                this.clients = response.data.data;
            });
        },
        /**
         * Show the form for creating new clients.
         */
        showCreateClientForm() {
            $("#modal-create-client").modal("show");
        },
        hiddenCreateClientForm() {
            $("#modal-create-client").modal("hide");
        },
        hiddenEditClientForm() {
            $("#modal-edit-client").modal("hide");
        },
        /**
         * Create a new OAuth client for the user.
         */
        store() {
            this.persistClient(
                "post",
                "/api/clients",
                this.createForm,
                "#modal-create-client"
            );
        },
        /**
         * Edit the given client.
         */
        edit(client) {
            this.editForm.id = client.id;
            this.editForm.client_id = client.client_id;
            this.editForm.name = client.name;
            this.editForm.redirect_url = client.redirect_url;
            this.editForm.secret = client.secret;
            $("#modal-edit-client").modal("show");
        },
        /**
         * Update the client being edited.
         */
        update() {
            this.persistClient(
                "put",
                "/api/clients/" + this.editForm.id,
                this.editForm,
                "#modal-edit-client"
            );
        },
        /**
         * Persist the client to storage using the given form.
         */
        persistClient(method, uri, form, modal) {
            form.errors = [];
            axios[method](uri, form)
                .then(() => {
                    this.getClients();
                    form.client_id = "";
                    form.name = "";
                    form.secret = "";
                    form.redirect_url = "";
                    form.errors = [];
                    $(modal).modal("hide");
                })
                .catch((error) => {
                    if (typeof error.response.data === "object") {
                        form.errors = _.flatten(
                            _.toArray(error.response.data.errors)
                        );
                    } else {
                        form.errors = [
                            "Something went wrong. Please try again.",
                        ];
                    }
                });
        },
        
        /**
         * Destroy the given client.
         */
        destroy(client) {
            axios.delete("/api/clients/" + client.id).then(() => {
                this.getClients();
            });
        },
    },
};
</script>