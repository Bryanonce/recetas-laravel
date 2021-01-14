<template>
    <div class="btn btn-danger">
        <input
            type="submit"
            class="btn btn-warning"
            value="Eliminar Perfil"
            @click="eliminarReceta"
        />
        <img style="height: 50px;margin-left:10px;" src="/images/user.svg" alt="">
        
    </div>
  

</template>

<script>
export default {
  props: ["recetaId","type"],
  methods: {
    eliminarReceta() {
      this.$swal({
        title: "Está seguro de que desea eliminar?",
        text: "Una vez Eliminado no se puede recuperar",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, elimínalo!",
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.value) {
            //parametros de axios
            const params = {
                id: this.recetaId
            }
            console.log(this.recetaId);
            //Enviar petición al Servidor
            axios.post(`/${this.type}/${this.recetaId}`,{params,_method:'delete'})
                .then((res)=>{
                  console.log(res);
                    //Notificación de Eliminación
                    this.$swal({
                        title: 'Perfil Eliminado',
                        text: 'Se eliminó su cuenta',
                        icon: 'success'
                    });
                    //this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode);
                })
                .catch((err)=>{
                    console.log(err);
                })
        }
      });
    },
  },
};
</script>