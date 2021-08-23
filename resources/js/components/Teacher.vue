<template>
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Teacher</h3>

      <div class="card-tools"></div>
      <div class="col-md-12" style="padding: 10px">
        <div class="col-md-6">
          <div class="btn-group">
            <button
              type="button"
              class="btn btn-primary btn-sm"
              data-toggle="modal"
              data-target="#add_group"
            >
              <i class="fa fa-fw fa-plus"></i> Add
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
      <table class="table table-hover text-nowrap">
        <thead>
          <tr>
            <th>User</th>
            <th>Email</th>
            <th>School</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(user, index) in users" :key="index"
          v-on:reloadlist="getList()">
            <td>{{ user.name }}</td>
            <td>{{ user.email }}</td>
            <td>{{ user.schl_name }}</td>
            <td><button @click="removeUser(user.id)" class="trashcan">
                <font-awesome-icon icon="trash"/>
            </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
    <div id="add_group" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
              &times;
            </button>
            <h5 class="modal-title">Add Teacher</h5>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div class="row">
                <div class="col-sm-12">
                  <label>Name</label>
                  <input
                    type="text"
                    name="group_code"
                    placeholder=""
                    v-model="user.name"
                    class="form-control"
                  />
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-12">
                  <label>email</label>
                  <input
                    type="text"
                    placeholder=""
                    v-model="user.email"
                    class="form-control"
                  />
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-12">
                  <label>School Name</label>
                  <input
                    type="text"
                    placeholder=""
                    v-model="user.schl_name"
                    class="form-control"
                  />
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-12">
                  <label>Role</label>
                  <select
                    name="role"
                    tabindex="1"
                    v-model="user.type"
                    class="form-control"
                  >
                    <option value="T">Teacher</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn">
              Close
            </button>
            <button type="submit" id="submit" @click="addUser" class="btn blue">
              Save
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data: function () {
    return {
      user: {
        name: "",
        password: "",
        email: "",
        type: "",
        schl_name:"",
      },
      users: [],
    };
  },
  methods: {
    addUser() {
      if (this.user.name == "") {
        return;
      }

      axios
        .post("api/user/store", {
          user: this.user,
        })
        .then((response) => {
          if (response.status == 201) {
            this.user.name = "";
            this.user.password = "";
            window.location.replace('/student');
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    removeUser(id) {
        axios.delete('api/user/'+ id)
        .then (response =>{
            if (response.status == 200) {
                this.$emit('reloadlist');
            }
        })
        .catch (error =>{
            console.log(error);
        })
        
        
    },
    getList() {
      axios
        .get("api/teacher")
        .then((response) => {
          this.users = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  created() {
    this.getList();
  },
};
</script>