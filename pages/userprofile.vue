<template>
  <div class="row">
    <div class="w3-bar w3-black" style="margin-bottom:20px">
      <button class="w3-bar-item w3-button btn btn-success" @click="openCity('ADD')">ADD USER</button>
      <button class="w3-bar-item w3-button btn btn-success" @click="openCity('VIEW')">VIEW USERS</button>
    </div>
    <div class="row users" id="ADD" style="display:block">
      <div class="card" style="margin:20px">
        <div class="header">
          <h4 class="title">ADD NEW USER</h4>
        </div>
        <div class="content">
          <form>
            <div class="row">
              <div class="col-md-6">
                <fg-input
                  type="text"
                  label="First Name"
                  placeholder="First Name"
                  v-model="user.firstname"
                ></fg-input>
              </div>
              <div class="col-md-6">
                <fg-input
                  type="text"
                  label="Last Name"
                  placeholder="Last Name"
                  v-model="user.lastname"
                ></fg-input>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <fg-input type="email" label="Email" placeholder="Enter Email" v-model="user.email"></fg-input>
              </div>
              <div class="col-md-4">
                <fg-input
                  type="text"
                  label="Username"
                  placeholder="Enter Username"
                  v-model="user.username"
                ></fg-input>
              </div>
              <div class="col-md-4">
                <fg-input
                  type="tel"
                  label="Mobile Number"
                  placeholder="+923xxxxxxxxx"
                  v-model="user.number"
                ></fg-input>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <fg-input
                  type="text"
                  label="Password"
                  placeholder="Password"
                  v-model="user.password"
                ></fg-input>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for>Role</label>
                  <select v-model="user.role" class="form-control border-input">
                    <option
                      v-for="(role,index) in roles"
                      :key="index"
                      :value="role.id"
                    >{{role.name}}</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="text-center">
              <button
                type="submit"
                class="btn btn-info btn-fill btn-wd"
                @click.prevent="createProfile"
              >Create Profile</button>
            </div>
            <div class="clearfix"></div>
          </form>
        </div>
      </div>
    </div>
    <div class="row users" id="VIEW" style="display:none">
      <div class="card" style="margin:20px">
          <div class="header">
            <h4 class="title">VIEW ALL USERS</h4>
          </div>
        <div class="content">
          <table id="myTable">
            <thead>
              <tr>
              <th>ID</th>
              <th>Firstname</th>
              <th>Lastname</th>
              <th>Username</th>
              <th>Number</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(iuser,index) in users" :key="index">
                <td>{{iuser.id}}</td>
                <td>{{iuser.firstname}}</td>
                <td>{{iuser.lastname}}</td>
                <td>{{iuser.username}}</td>
                <td>{{iuser.number}}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- <div class="row">
      <div class="col-lg-4 col-md-5">
        <user-card></user-card>
        <members-card></members-card>
      </div>
      <div class="col-lg-8 col-md-7">
        <edit-profile-form></edit-profile-form>
      </div>
    </div>-->
  </div>
</template>
<script>
import EditProfileForm from "./UserProfile/EditProfileForm.vue";
import UserCard from "./UserProfile/UserCard.vue";
import MembersCard from "./UserProfile/MembersCard.vue";
import axios from "axios";
axios.defaults.headers.post["Content-Type"] = "application/form-data";
// import FormGroupInput from "../components/UIComponents/Inputs/formGroupInput.vue";

export default {
  layout: "dashboard",
  components: {
    EditProfileForm,
    UserCard,
    MembersCard
  },
  data() {
    return {
      user: {
        firstname: "",
        lastname: "",
        username: "",
        email: "",
        number: "",
        cnic: "",
        role: "",
        password: ""
      },
      roles: [],
      users:[]
    };
  },
  methods: {
    createProfile() {
      axios
        .post("http://127.0.0.1:8000/api/register", {
          firstname: this.user.firstname,
          lastname: this.user.lastname,
          username: this.user.username,
          number: this.user.number,
          email: this.user.email,
          role: this.user.role,
          password: this.user.password,
          password_confirmation: this.user.password
        })
        .then(response => console.log(response.data));
      // alert("Your data: " + JSON.stringify(this.user));
    },
    openCity(cityName) {
      var i;
      var x = document.getElementsByClassName("users");
      for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
      }
      document.getElementById(cityName).style.display = "block";
    }
  },
  created() {
    axios
      .get("http://127.0.0.1:8000/api/roles")
      .then(response => {
        console.log("Hi : " + response.data);
        this.roles = response.data;
      })
      .catch(function(err) {
        console.log("Error : " + err);
      });

      axios
      .get("http://127.0.0.1:8000/api/users")
      .then(response => {
        console.log("Hi : " + response.data);
        this.users = response.data;
      })
      .catch(function(err) {
        console.log("Error : " + err);
      });
  },
  mounted(){
            $('#myTable').DataTable();

  }
};
</script>
<style>
</style>
