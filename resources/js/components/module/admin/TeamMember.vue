<template>
<div>
    <h3>Praxis team</h3>

    <v-col class="mt-5">
        <v-row>
            <v-btn
                class="mx-2"
                fab
                dark
                color="indigo"
                v-for="(member, index) in members"
                @click="onEditUser(member['id'])"
                :key="index"
            >
                <span class="white--text text-h5">{{member['name']}}</span>
            </v-btn>
            <v-btn
                class="mx-2"
                fab
                dark
                color="grey lighten-1"
                @click="onCreateMember"
            >
                <v-icon dark>
                    mdi-plus
                </v-icon>
            </v-btn>
        </v-row>
    </v-col>

    <v-card class="mt-5" v-show="memberForm.show">
        <v-card-text>
            <v-form ref="user_create_form">
                <v-row>
                    <v-col cols="12">
                        <v-text-field
                            label="Name"
                            :rules="[rules.required]"
                            v-model="memberForm.name"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="6">
                        <v-text-field
                            label="Password"
                            :rules="[customRules.password_required(this.memberForm.id === 0)]"
                            v-model="memberForm.password"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="6">
                        <v-text-field
                            label="Confirm Password"
                            :rules="[customRules.password_match(memberForm.password)]"
                            v-model="memberForm.confirmPassword"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12">
                        <v-text-field
                            label="E-Mail Address"
                            :rules="[rules.required, rules.email]"
                            v-model="memberForm.email"
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12">
                        <v-select
                            :items="roles"
                            label="Role"
                            :rules="[rules.required]"
                            v-model="memberForm.role"
                        ></v-select>
                    </v-col>
                </v-row>
            </v-form>
        </v-card-text>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
                @click="onCreateMemberCancel"
            >
                Cancel
            </v-btn>
            <v-btn
                @click="onCreateOrUpdateMemberConfirm"
            >
                Save
            </v-btn>
        </v-card-actions>
    </v-card>
</div>
</template>

<script>
import ApiService from '@service/ApiService';
import {basic_rule, custom_rule} from '@util/validation/rules';
import MemberRequest from '@model/request/member.request';

export default {
    setup() {

    },
    async mounted() {
        var response = await ApiService.MEMBER_GET_INDEX();

        if (response['code'] == 200) {
            this.members = response['data']['members']
            console.log(this.members)
        } else {

        }
    },
    methods: {
        // user creation
        onCreateMember() {
            this.memberForm= {
                show: true,
                id: 0,
                name: "",
                password: "",
                confirmPassword: "",
                email: "",
                role: ""
            }
            this.$refs.user_create_form.resetValidation()
        },
        onCreateMemberCancel() {
            this.memberForm.show = false
        },
        onEditUser(id) {
            var member = this.members.find((_member) => (_member['id'] == id))
            this.memberForm = {
                show:true,
                id: member['id'],
                name: member['name'],
                email: member['email'],
                role: member['role'],
            }
            this.$refs.user_create_form.resetValidation()
        },
        async onCreateOrUpdateMemberConfirm() {
            if(!this.$refs.user_create_form.validate()) return;

            var request = new MemberRequest;
            request = this.memberForm

            var response;

            if(this.memberForm.id == 0) {
                response = await ApiService.MEMBER_ADD(request);
            } else {
                response = await ApiService.MEMBER_UPDATE(this.memberForm.id ,request);
            }


            if(response['code'] == 200) {
                var newMember = response['data'];
                if(this.memberForm.id == 0) {
                    this.members.push(response['data'])
                } else {
                    this.members = this.members.map((member) => {
                        return member['id'] == newMember['id'] ? newMember : member;
                    })
                }
            } else {

            }

            console.log(response);
        },
    },
    data() {
        return {
            roles: [
                {text:"Member", value:"Member"}
            ],
            rules: basic_rule,
            customRules: custom_rule,

            members: [],

            memberForm: {
                show: false,
                id: 0,
                name: "",
                password: "",
                confirmPassword: "",
                email: "",
                role: ""
            }
        }
    }
}
</script>
