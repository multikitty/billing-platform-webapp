<template>
    <v-container class="guest-container">
        <div class="card w-50">
            <div class="card-header">
                Bill fox
            </div>

            <div class="card-body">
                <v-form ref="login_form_ref">
                    <v-text-field v-model="login_form.email" label="Email" :rules="[rules.required, rules.email]" clearable></v-text-field>
                    <v-text-field v-model="login_form.password" label="Password" :rules="[rules.required]" clearable type="password"></v-text-field>

                    <button type="button" class="form-control btn btn-primary mt-3" v-on:click="on_login">Login</button>
                </v-form>
            </div>

            <div class="card-footer text-center">
                <router-link to="/">
                    Forgot Password?
                </router-link>
            </div>
        </div>
    </v-container>
</template>

<script>
import {basic_rule} from '@util/validation/rules';
import LoginRequest from '@model/request/login.request';
import ApiService from '@service/ApiService';
import { mapMutations } from 'vuex';
import JwtTokenService from "@service/JwtTokenService";

export default {
    data() {
        return {
            login_form :{
                email: "",
                password: ""
            },

            rules: basic_rule
        }
    },

    methods: {
        async on_login()  {
            var is_valid = this.$refs.login_form_ref.validate();

            if(is_valid) {
                var request = new LoginRequest;
                request.email = this.login_form.email;
                request.password = this.login_form.password;

                this.set_busy({data:true});

                var result = await ApiService.LOGIN(request)

                if(result['code'] != 200) {
                    console.log('Login failed')
                } else {
                    JwtTokenService.setToken(result['data']['access_token']);
                    this.$router.push('/admin')
                }

                this.set_busy({data:false});
            }
        },
        ...mapMutations([
            'set_busy'
        ])
    }
}
</script>

<style lang="scss">

</style>
