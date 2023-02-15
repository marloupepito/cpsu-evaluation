<template>
  <div class="text-center">
    <v-menu :location="location">
      <template v-slot:activator="{ props }">
        <v-btn
          color="success"
          dark
          v-bind="props"
        >
          ACTION
        </v-btn>
      </template>

      <v-list>
        <v-list-item
          v-for="(item, index) in items"
          :key="index"
          href="#"
          @click="handlerInfo(item.title,item.id)"
        >

          <v-list-item-title>{{ item.title }}</v-list-item-title>
        </v-list-item>
      </v-list>
    </v-menu>


       <v-dialog
      v-model="dialog"
      persistent
      width="500"
    >
      <v-card>
        <v-card-title>
          <span class="text-h5">EDIT FACULTY</span>
        </v-card-title>
        <v-card-text>
          <v-container>
      <v-form
          ref="form"
          v-model="valid"
          lazy-validation
        >
            <v-row>

              <v-col cols="12" sm="12">
                <v-text-field
                  label="ID Number"
                  required
                  v-model="data.id_number"
                  :rules="idNumberRules"
                ></v-text-field>
              </v-col>

              <v-col cols="12" sm="12">
                <v-text-field
                  label="Fullname"
                  required
                  v-model="data.name"
                  :rules="nameRules"
                ></v-text-field>
              </v-col>

                 <v-col cols="12" sm="12">
                <v-select
                  :items="['Peer','Supervisor']"
                  label="Evaluator Type"
                  required
                  :rules="typeRules"
                  v-model="type"
                ></v-select>
              </v-col> 
             

              <v-col cols="12" sm="12">
                <v-select
                  :items="['College of Computer Studies','College of Business Management','College of Teachers Education', 'College of Agriculture and Forestry','College of Criminal Justice Education']"
                  label="Department"
                  required
                  :rules="departmentRules"
                  v-model="data.department"
                ></v-select>
              </v-col>

              <v-col cols="12" sm="12">
                <v-text-field
                  label="Academic Rank"
                  required
                  v-model="data.academic_rank"
                  :rules="rankRules"
                ></v-text-field>
              </v-col>
           
            </v-row>

          </v-form>
          </v-container>
          <small>*indicates required field</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="error"
            depressed
            @click="dialog = false"
            variant="outlined"
          >
            Close
          </v-btn>
          <v-btn
            color="green"
            depressed
            variant="outlined"
            @click="editCPSUFaculty"
          >
            Save
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
  export default {
    props: ['id'],
    data: () => ({
      items: [
        { title: 'EDIT',id: 'EDIT' },
        { title: 'DELETE',id: 'delete' },
      ],
      locations: [
        'top',
        'bottom',
        'start',
        'end',
        'center',
      ],
      location: 'end',
       valid: true,
        dialog: false,
        idNumber:'',
        department:'',
        name:'',
        rank:'',
        departmentRules: [
        v => !!v || 'Department is required',
        ],
        idNumberRules: [
          v => !!v || 'ID Number is required',
        ],
        nameRules: [
          v => !!v || 'Fullname is required',
        ],
        rankRules: [
          v => !!v || 'Department Rank is required',
        ],
        type:'',
        typeRules:[
          v => !!v || 'Type is required',
        ],
        campusid:'',
        campus:'',
        loadingLocation:'',
        syList:[],
        sy:'',
        data:[]

    }),
    methods:{
      editCPSUFaculty(){
             axios.post('/option_evaluator',{
                option:'edit',
                type:'faculty',
                id:this.data.id, 
                name:this.data.name,
                department:this.data.department,
                academic_rank:this.data.academic_rank,
                id_number:this.data.id_number,
                types:this.data.type,
              })
            .then(res=>{

               this.dialog = false
                 this.$swal({
                  icon: 'success',
                  title: 'Saved!',
                  showConfirmButton: false,
                  timer: 1500
                })

                 if(this.loadingLocation === 'cpsu_campus'){
                  this.$router.push({ path: '/cpsu_campus/faculty/campus/view/loading'})
                  }else{
                    this.$router.push({ path: '/administrator/faculty/campus/view/loading'})
                  }
            })
        },
     handlerInfo(e,id){
        if(e === 'EDIT'){
          this.dialog = true
            axios.post('/get_every_faculty',{
                type:'faculty',
                id:this.id,
            })
          .then(res=>{
            this.data = res.data.status
            })
          }else{

            this.$swal({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.isConfirmed) {
                 axios.post('/option_evaluator',{
                  option:'delete',
                  type:'faculty',
                  id:this.id
                  })
                .then(res=>{
                      this.dialog = false
                       this.$swal({
                        icon: 'success',
                        title: 'Saved!',
                        showConfirmButton: false,
                        timer: 1500
                      })

                       if(this.loadingLocation === 'cpsu_campus'){
                        this.$router.push({ path: '/cpsu_campus/faculty/campus/view/loading'})
                        }else{
                         this.$router.push({ path: '/administrator/faculty/campus/view/loading'})
                      }
                 })
              }
            })
           
          }
     }
    }
    ,
    
  }
</script>