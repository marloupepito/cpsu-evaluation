<template>
  <v-parallax
   class="content-bg"
    src="images/background.jpeg"
    scale=0.5
  >
    <div class="bg-text ">
      <center>
        <h1 class="text-h5  font-weight-bold text-white">
         Central Philippine State University
        </h1>
      </center>
      <h4 class="subheading m-5">
           <v-btn
            rounded="pill"
            color="green"
            class="mb-3"
            block
            to="/campuses"
          >
            CAMPUSES
          </v-btn>
        <!--    <v-btn
            rounded="pill"
            color="green"
            class="mb-3"
            block
          >
            HOW TO EVALUATE
          </v-btn> -->
      </h4>
    </div>
  </v-parallax>
</template>