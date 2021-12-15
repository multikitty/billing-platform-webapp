<template>
<div>
    <h3>Practice Profile</h3>

    <div>

        <Segment title="LOGO">
            <v-col>
                <v-row justify="center">
                    <v-avatar size="300">
                        <v-img :src="setting.practice_logo_url" aspect-ratio="1" width="300px" content-class="rounded"/>
                    </v-avatar>
                    <v-btn @click="onChangeImageBtnClick" fab>
                        <v-icon dark>
                            mdi-pencil
                        </v-icon>
                    </v-btn>
                </v-row>

                <input ref="logoLocalFileInput" type="file" class="d-none" @change="onChangeImage" accept="image/*"/>

                <v-dialog v-model="showAvatarCropperDialog" max-width="600px">
                    <v-card >
                        <cropper
                            class="cropper"
                            ref="cropper"
                            :src="logoLocalFileUrl"
                            :stencil-component="$options.components.CircleStencil"
                            :stencil-props="{
                                aspectRatio: 1
                            }"
                        />

                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn
                                color="primary"
                                text
                                @click="onChangeLogoConfirm"
                            >
                                Confirm
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-col>
        </Segment>

        <Segment title="PRAXIS ADDRESS">
            <v-row>
                <v-col cols="7">
                    <v-text-field
                        label="Praxis Name*"
                        :rules="[basic_rule.required]"
                        v-model="setting.practice_name"
                    ></v-text-field>
                </v-col>
                <v-col cols="5">
                    <v-text-field
                        label="Ust ID*"
                        :rules="[basic_rule.required]"
                        v-model="setting.practice_tax_num"
                    ></v-text-field>
                </v-col>
                <v-col cols="6">
                    <v-text-field
                        label="Vorname*"
                        :rules="[basic_rule.required]"
                        v-model="setting.practice_firstname"
                    ></v-text-field>
                </v-col>
                <v-col cols="6">
                    <v-text-field
                        label="Nachname*"
                        :rules="[basic_rule.required]"
                        v-model="setting.practice_lastname"
                    ></v-text-field>
                </v-col>
                <v-col cols="12">
                    <v-text-field
                        label="Titel"
                        v-model="setting.practice_degree"
                    ></v-text-field>
                </v-col>
                <v-col cols="7">
                    <v-text-field
                        label="Website"
                        v-model="setting.practice_website"
                    ></v-text-field>
                </v-col>
                <v-col cols="5">
                    <v-text-field
                        label="Telefon"
                        v-model="setting.practice_tel"
                    ></v-text-field>
                </v-col>
                <v-col cols="12">
                    <v-text-field
                        label="Email Address"
                        v-model="setting.practice_email"
                    ></v-text-field>
                </v-col>
                <v-col cols="12">
                    <v-text-field
                        label="Strabe*"
                        :rules="[basic_rule.required]"
                        v-model="setting.practice_street"
                    ></v-text-field>
                </v-col>
                <v-col cols="6">
                    <v-text-field
                        label="PLZ*"
                        :rules="[basic_rule.required]"
                        v-model="setting.practice_postal_code"
                    ></v-text-field>
                </v-col>
                <v-col cols="6">
                    <v-text-field
                        label="Ort*"
                        :rules="[basic_rule.required]"
                        v-model="setting.practice_province"
                    ></v-text-field>
                </v-col>
                <v-col cols="7">
                    <v-text-field
                        label="IBAN*"
                        :rules="[basic_rule.required]"
                        v-model="setting.practice_iban"
                    ></v-text-field>
                </v-col>
                <v-col cols="5">
                    <v-text-field
                        label="BIC"
                        v-model="setting.practice_bic"
                    ></v-text-field>
                </v-col>
                <v-col cols="12">
                    <v-text-field
                        label="Bank"
                        v-model="setting.practice_bank"
                    ></v-text-field>
                </v-col>
            </v-row>
        </Segment>

        <Segment title="ZUSATZLICHE ...">
            <v-row>
                <v-col sm="12" md="10" lg="7">
                    <v-list-item v-for="additionalSetting in setting.practice_additional_setting" :key="additionalSetting['id']">
                        <v-list-item-content>
                            <v-list-item-title>
                                <v-checkbox
                                    :label="additionalSetting['title']"
                                    color="indigo"
                                    v-model="additionalSetting['checked']"
                                    class="shrink m-0"
                                    hide-details
                                ></v-checkbox>
                            </v-list-item-title>
                        </v-list-item-content>
                        <v-list-item-action>
                            <v-list-item-action-text>
                                <v-btn
                                    class="mx-2"
                                    icon
                                    dark
                                    small
                                    color="secondary"
                                    @click="onDeleteAdditionalSettingTriggered(additionalSetting['id'])"
                                >
                                    <v-icon dark>
                                        mdi-delete
                                    </v-icon>
                                </v-btn>
                            </v-list-item-action-text>
                        </v-list-item-action>
                    </v-list-item>
                </v-col>
            </v-row>

            <v-dialog
                max-width="600px"
                v-model="addtionalSettingForm.showDlg"
            >
                <template v-slot:activator="{on, attrs}">
                    <v-btn
                        class="mx-2"
                        fab
                        dark
                        small
                        color="primary"
                        v-bind="attrs"
                        v-on:click="addtionalSettingForm.title=''; addtionalSettingForm.showDlg = true"
                    >
                        <v-icon dark>
                            mdi-plus
                        </v-icon>
                    </v-btn>
                </template>
                <v-card>
                    <v-card-title>
                        <span class="text-h5">Add New</span>
                    </v-card-title>

                    <v-card-text>
                        <v-container>
                            <v-form ref="additionalSettingForm">
                                <v-row>
                                    <v-col>
                                        <v-text-field
                                            label="Title"
                                            :rules="[basic_rule.required]"
                                            v-model="addtionalSettingForm.title"
                                        ></v-text-field>
                                    </v-col>
                                </v-row>
                            </v-form>
                        </v-container>
                    </v-card-text>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn
                            color="blue darken-1"
                            text
                            @click="onCancelAddAdditionalSetting"
                        >
                            Close
                        </v-btn>
                        <v-btn
                            color="blue darken-1"
                            text
                            @click="onConfirmAddAdditionalSetting"
                        >
                            Save
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>

        </Segment>

        <v-row justify="end" class="mt-5">
            <v-btn
                depressed
                color="secondary"

            >
                Cancel
            </v-btn>
            <v-btn
                depressed
                color="primary"
                class="ml-5"
                @click="onSaveSetting"
            >
                Save
            </v-btn>
        </v-row>

    </div>

    <v-dialog
        max-width="600px"
        v-model="deleteAdditionalSettingForm.showDlg"
    >
        <v-card>

            <v-card-text>
                Are you sure to delete additional setting?
            </v-card-text>

            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                    color="blue darken-1"
                    text
                    @click="onDeleteAdditionalSettingCancelled"
                >
                    Close
                </v-btn>
                <v-btn
                    color="blue darken-1"
                    text
                    @click="onDeleteAdditionalSettingConfirmed"
                >
                    Sure
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</div>
</template>

<script>
import { Cropper, CircleStencil } from 'vue-advanced-cropper'
import 'vue-advanced-cropper/dist/style.css';
import {basic_rule} from '@util/validation/rules';
import { mapMutations } from 'vuex';
import ApiService from '@service/ApiService';
import SettingModel from '@model/setting.model';
import CreateAdditionalSettingRequest from '@model/request/create_additional_setting.request';
import AlertUtil from '@util/alert.util';

export default {
    setup() {

    },

    async mounted() {
        this.set_busy({data:true});

        var response = await ApiService.SETTING_GET_INDEX();

        this.handleSettingResponse(response)

        this.set_busy({data:false});
    },

    components: {
        Cropper, CircleStencil
    },

    data: () => ({
        basic_rule: basic_rule,
        logoLocalFileUrl: "",
        showAddAdditionalSettingDlg: false,
        showAvatarCropperDialog: false,

        // add additional setting form
        addtionalSettingForm: {
            showDlg: false,
            title: ""
        },

        // delete additional setting form
        deleteAdditionalSettingForm: {
            showDlg: false,
            id: 0
        },

        // setting data
        setting:new SettingModel
    }),

    methods: {
        ...mapMutations([
            'set_busy',
            'showSnackbar'
        ]),
        handleSettingResponse(response) {
            const code = response['code'];
            if(code == 200) {
                this.setting = response['data']
                console.log(response)
            } else {
                console.log(response)
            }
        },
        onChangeImageBtnClick() {
            this.$refs.logoLocalFileInput.value = "";
            this.$refs.logoLocalFileInput.click();
        },
        onChangeImage(event) {
            this.logoLocalFileUrl = URL.createObjectURL(event.target.files[0])
            if(this.$refs.cropper) this.$refs.cropper.refresh();
            this.showAvatarCropperDialog = true;
        },
        async onChangeLogoConfirm() {
            const {canvas} = this.$refs.cropper.getResult();

            if (canvas) {
                var request = new FormData;

                canvas.toBlob(async (blob) => {
					request.append('practice_logo', blob);

                    var response = await ApiService.SETTING_UPDATE_LOGO(request)

                    console.log(response)

                    this.setting.practice_logo_url = response['data']['practice_logo_url']

                    this.showAvatarCropperDialog = false;
				}, 'image/jpeg');
            } else {

            }

        },

        //add additional setting
        async onConfirmAddAdditionalSetting() {
            if(!this.$refs.additionalSettingForm.validate()) return;

            var request = new CreateAdditionalSettingRequest(this.addtionalSettingForm.title);

            var response = await ApiService.SETTING_CREATE_ADDTIONAL(request);

            if(response['code'] == 200) {
                this.setting.practice_additional_setting.push(response['data'])
                this.onCancelAddAdditionalSetting()

                AlertUtil.SHOW_SUCCESS_ALERT("New additional setting is created")
            } else {
                AlertUtil.SHOW_ERROR_ALERT("Something went wrong. Please try again later")
            }
        },
        onCancelAddAdditionalSetting() {
            this.addtionalSettingForm = {
                showDlg: false,
                title: ""
            }
        },

        // delete additional setting
        onDeleteAdditionalSettingTriggered(id) {
            this.deleteAdditionalSettingForm = {
                showDlg: true,
                id: id
            };
        },
        async onDeleteAdditionalSettingConfirmed() {
            var response = await ApiService.SETTING_DELETE_ADDITIONAL(this.deleteAdditionalSettingForm.id);

            if (response['code'] == 200) {
                this.setting.practice_additional_setting = this.setting.practice_additional_setting.filter(additionalSetting => {
                    return additionalSetting['id'] != this.deleteAdditionalSettingForm.id
                })

                this.onDeleteAdditionalSettingCancelled()

                AlertUtil.SHOW_SUCCESS_ALERT("Additional setting is deleted")
            } else {
                AlertUtil.SHOW_ERROR_ALERT("Something went wrong. Please try again later")
            }
        },
        onDeleteAdditionalSettingCancelled() {
            this.deleteAdditionalSettingForm = {
                showDlg: false,
                id: 0
            };
        },

        /**
         * Save setting, include additional settings' check status
         */
        async onSaveSetting() {
            this.set_busy({data:true})

            var response = await ApiService.SETTING_SAVE(this.setting)

            if(response['code'] == 200) {
                AlertUtil.SHOW_SUCCESS_ALERT("Setting is saved")
            } else {
                AlertUtil.SHOW_ERROR_ALERT("Something went wrong. Please try again later")
            }

            this.set_busy({data:false})
        }
    }
}
</script>


