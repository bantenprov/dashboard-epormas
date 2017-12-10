<template>
    <div class="row">
        <div class="col-lg-12">
            <b-card header="Tambah Jumlah Laporan" header-tag="h4" class="bg-success-card">
                <div class="row">
                    <div class="col-lg-7  mb-3 col-12">
                        <vue-form class="form-horizontal form-validation" :state="formstate" @submit.prevent="onSubmit">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <validate tag="div">
                                        <label for="tanggal">Tanggal</label>
                                        <input name="tanggal" type="date" required autofocus placeholder="Tanggal" class="form-control" v-model="model.tanggal" />
                                        <field-messages name="tanggal" show="$invalid && $submitted" class="text-danger">
                                            <div slot="required">Tanggal Harus di isi</div>
                                        </field-messages>
                                    </validate>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <validate tag="div">
                                        <label for="category_id"> Kategori</label>
                                        <select v-model="model.category_id" name="category_id" required autofocus class="form-control">
                                          <option disabled value="">Please select one</option>
                                          <option v-for="datacategory in category" :value="datacategory.id">{{datacategory.name}}</option>
                                        </select>
                                        <field-messages name="category_id" show="$invalid && $submitted" class="text-danger">
                                            <div slot="required">Kategori Harus diisi</div>
                                        </field-messages>
                                    </validate>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <validate tag="div">
                                        <label for="city_id"> Kota</label>
                                        <select v-model="model.city_id" name="city_id" required autofocus class="form-control">
                                          <option disabled value="">Please select one</option>
                                          <option v-for="datacity in city" :value="datacity.id">{{datacity.name}}</option>
                                        </select>
                                        <field-messages name="city_id" show="$invalid && $submitted" class="text-danger">
                                            <div slot="required">Kategori Harus diisi</div>
                                        </field-messages>
                                    </validate>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <validate tag="div">
                                        <label for="count">Jumlah</label>
                                        <input v-model="model.count" name="count" type="number" required autofocus placeholder="Jumlah" class="form-control" />
                                        <field-messages name="count" show="$invalid && $submitted" class="text-danger">
                                            <div slot="required">Jumlah Harus diisi</div>
                                        </field-messages>
                                    </validate>
                                </div>
                            </div>
                            <div class="col-md-offset-4 col-md-8 m-t-25">
                                <button type="submit" class="btn btn-primary">Submit
                                </button>
                                <button type="reset" class="btn btn-effect-ripple btn-secondary  reset_btn1" @click="form_reset">
                                    Reset
                                </button>
                                <button type="reset" class="btn btn-danger" @click="back">
                                    Back
                                </button>
                            </div>
                        </vue-form>
                    </div>
                </div>
            </b-card>
        </div>
    </div>
</template>
<script>
import Vue from 'vue';
import VueForm from "vue-form";
import options from "../validations/validations.js";
Vue.use(VueForm, options);
import Datepicker from 'vuejs-datepicker';
import miniToastr from 'mini-toastr';
miniToastr.init();
export default {
    name: "add_epormas",
    components: {
        Datepicker
    },
    data() {
        return {
            category: [],
            city: [],
            formstate: {},
            model: {
                tanggal: "",
                category_id: "",
                city_id: "",
                count: ""
            },
            old_file: ""
        }
    },
    methods: {
        onSubmit: function() {
            if (this.formstate.$invalid) {
                return;
            } else {
              axios.post("/store/epormas", {
                  tanggal: this.model.tanggal,
                  category_id: this.model.category_id,
                  city_id: this.model.city_id,
                  count: this.model.count,
                  user_id: '1'
              })
              .then(response => {
                  if(response.data.type == 'success'){
                    miniToastr.success(response.data.message, response.data.title)
                  }
                  else{
                    miniToastr.error(response.data.message, response.data.title)
                  }
                },window.location = '#/epormas')
              .catch((error) => miniToastr.error(error, "Error"));
            }
        },
        form_reset() {
            this.model = {
                tanggal: "",
                category_id: "",
                city_id: "",
                count: ""
            };
        },
        back() {
            window.location = '#/epormas';
        }
    },
    mounted: function() {
        axios.get("/api/epormas/create").then(response => {
            this.category = response.data.category;
            this.city = response.data.city;
        })
        .catch(function(error) {miniToastr.error(error, "Error")});
    },
    destroyed: function() {

    }
}
</script>
<style scoped>
.dropzone_wrapper {
    width: 100%;
    height: 300px;
}
input {
    cursor: pointer;
}

.cur {
    cursor: not-allowed;
}
</style>
