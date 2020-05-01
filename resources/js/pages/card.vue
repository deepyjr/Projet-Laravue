<template>
    <div>
    <CRow>
      <CCol >
        <CCard class="">
          <CCardHeader>
            {{status}}
          </CCardHeader>
          <CCardBody>
            Crée le {{date_commande}}
            Commandé pour le {{date_debut}}
          </CCardBody>
        </CCard>
      </CCol>
    </CRow>
  <br>
  </div>
</template>

<script>
export default {
  props:['status','date_debut','date_commande'],
  data(){
    return{

    }
  }
  
}
</script>
<style >

</style>