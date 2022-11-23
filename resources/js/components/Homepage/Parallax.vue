<template>
  <v-parallax
   class="content-bg"
    src="images/background.jpeg"
    scale=0.5
  >
    <div class="d-flex flex-column fill-height justify-center align-center text-white">
      <center>
        <h1 class="text-h4  mb-4 font-weight-bold text-dark">
         Central Philippine State University
        </h1>
      </center>
      <h4 class="subheading">
           <v-btn
            rounded="pill"
            color="green"
            class="mb-3"
            block
            to="/campuses"
          >
            CAMPUSES
          </v-btn>
           <v-btn
            rounded="pill"
            color="green"
            class="mb-3"
            block
          >
            HOW TO EVALUATE
          </v-btn>
      </h4>
    </div>
  </v-parallax>
</template>