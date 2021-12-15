<template>
<v-app id="inspire">
    <v-app-bar
        app
        color="blue"
        flat
    >
        <v-container class="py-0 fill-height">
            <img src="/img/logo.png"/>

            <v-btn text class="ml-auto" @click="onCreateInvoice">
                <b class="text-white text-uppercase">Create Invoice</b>
            </v-btn>

            <v-btn text @click="onCheckList">
                <b class="text-white text-uppercase">Checklist</b>
            </v-btn>

            <v-menu
                bottom
                min-width="200px"
                rounded
                offset-y
            >
                <template v-slot:activator="{ on }">
                    <v-btn
                        icon
                        x-large
                        v-on="on"
                    >
                        <v-avatar
                        color="brown"
                        size="48"
                        >
                            <span class="white--text text-h5">asd</span>
                        </v-avatar>
                    </v-btn>
                </template>
                <v-card>
                    <v-list-item-content class="justify-center">
                        <div class="mx-auto text-center">
                            <v-avatar
                                color="brown"
                            >
                                <span class="white--text text-h5">asd</span>
                            </v-avatar>
                            <h3>Name</h3>
                            <p class="text-caption mt-1">
                                email
                            </p>
                            <v-divider class="my-3"></v-divider>
                            <v-btn
                                depressed
                                rounded
                                text
                            >
                                Edit Account
                            </v-btn>
                            <v-divider class="my-3"></v-divider>
                            <v-btn
                                depressed
                                rounded
                                text
                            >
                                Disconnect
                            </v-btn>
                        </div>
                    </v-list-item-content>
                </v-card>
            </v-menu>
        </v-container>
    </v-app-bar>

    <v-main class="grey lighten-3">
        <v-container>
            <v-row>
                <v-col cols="2">
                    <v-sheet rounded="lg">
                        <v-list color="transparent">
                            <v-list-item link>
                                <router-link to="/admin/practice-profile">
                                    <v-list-item-content>
                                        <v-list-item-title>
                                            Praxis Profil
                                        </v-list-item-title>
                                    </v-list-item-content>
                                </router-link>
                            </v-list-item>

                            <v-list-item link>
                                <router-link to="/admin/member">
                                    <v-list-item-content>
                                        <v-list-item-title>
                                            Team Members
                                        </v-list-item-title>
                                    </v-list-item-content>
                                </router-link>
                            </v-list-item>

                            <v-divider class="my-2"></v-divider>

                            <v-list-item
                                link
                                color="grey lighten-4"
                            >
                                <v-list-item-content>
                                    <v-list-item-title>
                                        Refresh
                                    </v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                        </v-list>
                    </v-sheet>
                </v-col>

                <v-col>
                    <v-sheet min-height="70vh" rounded="lg" class="p-5">
                        <router-view></router-view>
                    </v-sheet>
                </v-col>
            </v-row>
        </v-container>
    </v-main>
  </v-app>
</template>

<script>
  export default {
    data: () => ({
      links: [
        'Dashboard',
        'Messages',
        'Profile',
        'Updates',
      ],
    }),
    methods: {
        onCreateInvoice() {

        },
        onCheckList() {

        }
    }
  }
</script>
