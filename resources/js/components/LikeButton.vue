<template>
  <div>
    <div class="middle-wrapper">
      <div @click="likeReceta" class="like-wrapper">
        <a :class="{'liked':this.like>0}" class="like-button">
          <span class="like-icon">
            <div class="heart-animation-1"></div>
            <div class="heart-animation-2"></div>
          </span>
          {{cantidadLikes}} Me Gusta
        </a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props:['recetaId','like','likes'],
  data: function() {
    return {
      totalLikes: JSON.parse(this.likes).length
    }
  },
  mounted(){
    console.log(this.likes)
  },
  methods: {
    likeReceta() {
      axios.post(`/likes/${this.recetaId}`)
        .then((res)=>{
          console.log(res);
          if(res.data === 'like'){
            this.$data.totalLikes++;
          }else{
            this.$data.totalLikes--;
          }
        })
        .catch((err)=>{
          if(err.response.status === 401){
            window.location = '/login';
          }
        })
    }
  },
  computed:{
    cantidadLikes: function(){
      return this.totalLikes;
    }
  }
};
</script>