<template>
  <input
    type="submit"
    class="btn btn-danger d-block w-100 mb-2"
    value="Eliminar"
    @click="eliminarReceta"
  />
</template>

<script>
export default {
  props: ["recetaId","type"],
  methods: {
    eliminarReceta() {
      this.$swal({
        title: "Está seguro de que desea eliminar?",
        text: "Una vez Eliminada no se puede recuperar",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, elimínala!",
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.value) {
            //parametros de axios
            const params = {
                id: this.recetaId
            }
            //console.log(this.recetaId);
            //Enviar petición al Servidor
            axios.post(`/${this.type}/${this.recetaId}`,{params,_method:'delete'})
                .then((res)=>{
                  //console.log(res);
                    //Notificación de Eliminación
                    this.$swal({
                        title: 'Receta Eliminada',
                        text: 'Se eliminó la Receta',
                        icon: 'success'
                    });
                    this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode);
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